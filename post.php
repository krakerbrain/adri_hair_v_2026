<?php
// Load posts database
$posts_file = __DIR__ . '/posts.json';
$posts = [];

if (file_exists($posts_file)) {
    $posts_json = file_get_contents($posts_file);
    $posts = json_decode($posts_json, true) ?: [];
}

$post_id = isset($_GET['id']) ? $_GET['id'] : '';
$current_post = null;

if (!empty($post_id) && is_array($posts)) {
    foreach ($posts as $post) {
        if ($post['id'] === $post_id) {
            $current_post = $post;
            break;
        }
    }
}

$post_found = ($current_post !== null);

// Dynamic SEO tags
if ($post_found) {
    $page_title = $current_post['titulo'] . " | Adri Hair Style";

    // Create description from text
    $clean_text = strip_tags($current_post['texto']);
    $clean_text = preg_replace('/[*#_`~\[\]]/', '', $clean_text);
    $page_desc = mb_substr($clean_text, 0, 155) . '...';

    $page_image = $current_post['imagen_url'];
    $og_type = "article";
} else {
    $page_title = "Publicación no encontrada | Adri Hair Style";
    $page_desc = "Lo sentimos, el artículo solicitado no se encuentra disponible o ha sido eliminado.";
    $page_image = "https://adrihairstyle.cl/img/bio_Adri_editada_web_optimo.jpg";
    $og_type = "website";
}

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$canonical_url = $protocol . ($_SERVER['HTTP_HOST'] ?? 'adrihairstyle.cl') . ($_SERVER['REQUEST_URI'] ?? '/post.php');
$is_inner_page = true;
$is_blog_page = true;

// Format date helper
function format_date_es($date_str)
{
    $timestamp = strtotime(str_replace('-', '/', $date_str));
    if (!$timestamp)
        return $date_str;

    $months = array("", "enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");

    $day_num = date("j", $timestamp);
    $month_num = date("n", $timestamp);
    $year = date("Y", $timestamp);

    return "$day_num de " . $months[$month_num] . " de $year";
}

// Parse markdown bold/italic & paragraphs helper
function format_post_text($text)
{
    // Normalizar saltos de línea (eliminar \r y estandarizar a \n)
    $text = str_replace("\r\n", "\n", $text);
    $text = str_replace("\r", "\n", $text);

    // Separar por dos o más saltos de línea (párrafos)
    $paras = preg_split('/\n{2,}/', $text);
    $formatted = '';

    foreach ($paras as $para) {
        $para = trim($para);
        if (empty($para))
            continue;

        // Reemplazos de Markdown (negrita y cursiva)
        $para = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $para);
        $para = preg_replace('/\*(.*?)\*/', '<em>$1</em>', $para);

        // Convertir saltos de línea simples dentro del párrafo a <br>
        $para = nl2br($para);

        $formatted .= "<p>$para</p>\n";
    }

    return $formatted;
}

// Include unified header
include __DIR__ . '/includes/header.php';
?>

    <main id="main-content">
        <!-- Blog Reader Section -->
        <section id="blog-reader-section" class="section-padding">
            <div class="container">
                <!-- Back Button -->
                <a href="index.php#blog" class="btn btn-outline"
                    style="margin-bottom: 30px; display: inline-flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-arrow-left"></i> Volver a todas las entradas
                </a>

                <?php if ($post_found): ?>
                    <div class="blog-reader-layout">
                        <!-- Left Side: Sidebar Index of other posts -->
                        <aside class="blog-reader-sidebar">
                            <h3
                                style="<?php echo !empty($current_post['color_primario']) ? 'border-bottom-color: ' . htmlspecialchars($current_post['color_primario']) : ''; ?>">
                                Otras Entradas</h3>
                            <ul>
                                <?php foreach ($posts as $post_item): ?>
                                    <?php
                                    $is_active = ($post_item['id'] === $current_post['id']);
                                    $li_style = '';
                                    if ($is_active && !empty($current_post['color_primario'])) {
                                        $li_style = 'style="background-color: ' . htmlspecialchars($current_post['color_primario']) . '; border-color: ' . htmlspecialchars($current_post['color_primario']) . '; color: #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1);"';
                                    }
                                    ?>
                                    <li>
                                        <a href="post.php?id=<?php echo urlencode($post_item['id']); ?>" <?php echo $is_active ? 'class="active"' : ''; ?>
                                            style="color: inherit; text-decoration: none; display: block;">
                                            <div <?php echo $li_style; ?> class="sidebar-li-inner"
                                                style="padding: 12px 15px; border-radius: 8px; border: 1px solid #f0f0f0; background-color: <?php echo $is_active && empty($current_post['color_primario']) ? 'var(--primary-color)' : ($is_active ? 'transparent' : 'var(--white)'); ?>; color: <?php echo $is_active ? '#fff' : 'var(--text-color)'; ?>;">
                                                <?php echo htmlspecialchars($post_item['titulo']); ?>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </aside>

                        <!-- Right Side: Post Content -->
                        <article class="blog-reader-content">
                            <div id="reader-post-body">
                                <div class="reader-post-img-container">
                                    <img src="<?php echo htmlspecialchars($current_post['imagen_url']); ?>"
                                        alt="<?php echo htmlspecialchars($current_post['titulo']); ?>">
                                </div>

                                <div class="reader-post-meta">
                                    <div class="reader-post-author">
                                        <img src="<?php echo htmlspecialchars($current_post['foto_autor_url'] ?: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=256&h=256&q=80'); ?>"
                                            alt="<?php echo htmlspecialchars($current_post['nombre_autor']); ?>">
                                        <div class="reader-post-author-info">
                                            <span
                                                class="name"><?php echo htmlspecialchars($current_post['nombre_autor']); ?></span>
                                            <span class="role">Autor / Especialista</span>
                                        </div>
                                    </div>
                                    <div class="reader-post-date">
                                        <i class="fa-regular fa-calendar"></i>
                                        <?php echo format_date_es($current_post['fecha_publicacion']); ?>
                                    </div>
                                </div>

                                <h1 class="reader-post-title"
                                    style="font-family: <?php echo htmlspecialchars($current_post['fuente_titulo'] ?: 'inherit'); ?>;">
                                    <?php echo htmlspecialchars($current_post['titulo']); ?></h1>
                                <div class="reader-post-text"
                                    style="font-family: <?php echo htmlspecialchars($current_post['fuente_texto'] ?: 'inherit'); ?>; color: <?php echo htmlspecialchars($current_post['color_texto'] ?: 'inherit'); ?>;">
                                    <?php echo format_post_text($current_post['texto']); ?>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php else: ?>
                    <div class="blog-loading" style="padding: 100px 0;">
                        <i class="fa-solid fa-triangle-exclamation"
                            style="font-size: 3rem; color: var(--primary-color); margin-bottom: 20px;"></i>
                        <h2>Publicación no encontrada</h2>
                        <p>El artículo que estás buscando no existe o ha sido trasladado.</p>
                        <a href="index.php#blog" class="btn" style="margin-top: 20px;">Volver al Blog</a>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

<?php
include __DIR__ . '/includes/footer.php';
?>