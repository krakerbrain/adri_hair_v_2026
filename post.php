<?php
// Load posts database
$posts_json = file_get_contents('posts.json');
$posts = json_decode($posts_json, true);

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
    $seo_title = $current_post['titulo'] . " | Adri Hair Style";

    // Create description from text
    $clean_text = strip_tags($current_post['texto']);
    $clean_text = preg_replace('/[*#_`~\[\]]/', '', $clean_text);
    $seo_desc = mb_substr($clean_text, 0, 155) . '...';

    $seo_image = $current_post['imagen_url'];
} else {
    $seo_title = "Publicación no encontrada | Adri Hair Style";
    $seo_desc = "Lo sentimos, el artículo solicitado no se encuentra disponible o ha sido eliminado.";
    $seo_image = "https://adrihairstyle.cl/img/bio_Adri_editada_web_optimo.jpg";
}

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
?>
<!DOCTYPE html>
<html lang="es-CL">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== PRIMARY SEO ===== -->
    <title><?php echo htmlspecialchars($seo_title); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($seo_desc); ?>">
    <meta name="author" content="Adri Hair Style">
    <meta name="robots" content="index, follow">

    <!-- ===== OPEN GRAPH (Facebook / LinkedIn / WhatsApp) ===== -->
    <meta property="og:type" content="article">
    <meta property="og:locale" content="es_CL">
    <meta property="og:site_name" content="Adri Hair Style">
    <meta property="og:url" content="http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($seo_title); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($seo_desc); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($seo_image); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- ===== TWITTER CARD ===== -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($seo_title); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($seo_desc); ?>">
    <meta name="twitter:image" content="<?php echo htmlspecialchars($seo_image); ?>">

    <!-- ===== FONTS ===== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap"
        rel="stylesheet">

    <!-- ===== STYLES ===== -->
    <link rel="stylesheet" href="css/styles.css?v=<?php echo filemtime('css/styles.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom style for post.php navbar to ensure high readability -->
    <style>
        .navbar {
            background-color: #111111 !important;
            /* Dark background for readability */
            position: fixed !important;
            top: 0 !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.4) !important;
            padding: 10px 0 !important;
        }

        .navbar .logo img {
            height: 55px !important;
            filter: drop-shadow(0 0 0 transparent) !important;
        }

        .top-bar {
            display: none !important;
            /* Hide top bar to avoid overlap with fixed navbar */
        }

        main#main-content {
            margin-top: 100px !important;
            /* Align content below fixed navbar */
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 15px 0 !important;
            }
        }
    </style>
</head>

<body>

    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-info">
                <span><i class="fa-solid fa-phone"></i> +56 9 5244 2965</span>
                <span><i class="fa-solid fa-envelope"></i> contacto@adrihairstyle.cl</span>
                <span><i class="fa-regular fa-clock"></i> Lun - Sab 9:00 - 20:00</span>
                <span><i class="fa-solid fa-location-dot"></i> Viña del Mar, Chile</span>
            </div>
            <div class="top-bar-social">
                <a href="https://www.facebook.com/Adrihairstyle.cl" target="_blank" aria-label="Facebook"><i
                        class="fa-brands fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/adrihair.style/" target="_blank" aria-label="Instagram"><i
                        class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar scrolled" id="main-nav" aria-label="Navegación principal">
        <div class="container">
            <a href="index.html" class="logo" aria-label="Adri Hair Style - Inicio">
                <img src="img/logo_15042021LOGO_1.png" alt="Adri Hair Style - Peluquería en Viña del Mar" height="90">
            </a>

            <button class="menu-toggle" aria-label="Abrir menú" aria-expanded="false" aria-controls="nav-links">
                <i class="fa-solid fa-bars" aria-hidden="true"></i>
            </button>

            <div class="nav-links" id="nav-links" role="menubar">
                <a href="index.html#" role="menuitem">Inicio</a>
                <a href="index.html#conoceme" role="menuitem">Conóceme</a>
                <a href="index.html#servicios" role="menuitem">Servicios</a>
                <a href="index.html#blog" role="menuitem" class="active">Blog</a>
                <a href="index.html#" role="menuitem">Cursos</a>
                <a href="https://agendarium.com/reservas/adri-hair-style" target="_blank" rel="noopener noreferrer"
                    class="btn" role="menuitem">Agenda</a>
            </div>
        </div>
    </nav>

    <main id="main-content" style="margin-top: 130px;">
        <!-- Blog Reader Section -->
        <section id="blog-reader-section" class="section-padding">
            <div class="container">
                <!-- Back Button -->
                <a href="index.html#blog" class="btn btn-outline"
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
                        <a href="index.html#blog" class="btn" style="margin-top: 20px;">Volver al Blog</a>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h3>Adri Hair Style</h3>
                    <p>Espacio de atención personalizada para tu cabello.</p>
                    <div class="footer-social">
                        <a href="https://www.facebook.com/Adrihairstyle.cl" target="_blank" rel="noopener noreferrer"
                            aria-label="Visitar página de Facebook de Adri Hair Style"><i
                                class="fa-brands fa-facebook-f" aria-hidden="true"></i></a>
                        <a href="https://www.instagram.com/adrihair.style/" target="_blank" rel="noopener noreferrer"
                            aria-label="Visitar perfil de Instagram de Adri Hair Style"><i
                                class="fa-brands fa-instagram" aria-hidden="true"></i></a>
                    </div>
                </div>

                <div class="footer-col">
                    <h3>Contáctanos</h3>
                    <ul>
                        <li>
                            <a href="https://www.google.com/maps/search/?api=1&query=Eduardo+Groove+325+Oficina+7+Viña+del+Mar+Chile"
                                target="_blank" style="color: inherit; display: flex; align-items: center; gap: 10px;">
                                <i class="fa-solid fa-location-dot" style="color: var(--primary-color);"></i> Eduardo
                                Groove 325, Ofc. 7. Viña del Mar, Chile
                            </a>
                        </li>
                        <li><i class="fa-solid fa-phone"></i> Cel: +56 9 5244 2965</li>
                        <li><i class="fa-solid fa-envelope"></i> Email: contacto@adrihairstyle.cl</li>
                        <li><i class="fa-regular fa-clock"></i> LUN-SAB 09:00 – 19:00</li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2026 Adri Hair Style. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Button & Popup -->
    <div class="whatsapp-container">
        <!-- Popup -->
        <div class="whatsapp-popup">
            <a href="https://wa.me/56952442965" target="_blank" class="whatsapp-popup-content">
                <img src="img/bio_Adri_editada_web_optimo.jpg" alt="Adri">
                <div class="whatsapp-text">
                    <strong>Chatea con Adri</strong>
                    <span>¡Hola! ¿En qué te ayudo?</span>
                </div>
            </a>
        </div>
        <!-- Button -->
        <button class="whatsapp-float-btn" aria-label="Abrir chat de WhatsApp">
            <i class="fa-brands fa-whatsapp"></i>
        </button>
    </div>

    <!-- Scripts -->
    <script src="js/main.js?v=<?php echo filemtime('js/main.js'); ?>"></script>
</body>

</html>