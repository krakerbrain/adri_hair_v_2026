<?php
/**
 * Header unificado - Adri Hair Style
 * Variables disponibles para personalización:
 * - $page_title: Título de la pestaña y SEO (string)
 * - $page_desc: Meta descripción (string)
 * - $page_image: Imagen para Open Graph / Twitter Card (string URL)
 * - $og_type: Tipo de Open Graph ('website' o 'article')
 * - $canonical_url: URL canónica (string)
 * - $is_inner_page: Boolean indicando si es una subpágina (ej: post.php)
 * - $is_blog_page: Boolean indicando si la pestaña activa es blog
 */

$default_title = "Adri Hair Style | Alisados Naturales sin Formol, Balayage y Coloración en Viña del Mar";
$default_desc  = "Adri Hair Style en Viña del Mar ofrece alisados naturales sin formol, balayage, coloración e hidrataciones capilares. Atención personalizada. ¡Agenda tu cita hoy!";
$default_image = "https://adrihairstyle.cl/img/bio_Adri_editada_web_optimo.jpg";

$title       = !empty($page_title) ? $page_title : $default_title;
$desc        = !empty($page_desc) ? $page_desc : $default_desc;
$image       = !empty($page_image) ? $page_image : $default_image;
$type        = !empty($og_type) ? $og_type : "website";
$canonical   = !empty($canonical_url) ? $canonical_url : "https://adrihairstyle.cl/";
$is_inner    = !empty($is_inner_page);
$base_nav    = $is_inner ? 'index.php' : '';
$css_version = file_exists(__DIR__ . '/../css/styles.css') ? filemtime(__DIR__ . '/../css/styles.css') : '20260820';
?>
<!DOCTYPE html>
<html lang="es-CL">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== FAVICON ===== -->
    <link rel="icon" type="image/png" sizes="512x512" href="img/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="img/favicon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png">
    <link rel="apple-touch-icon" href="img/favicon.png">
    <meta name="theme-color" content="#e91e8c">
    <meta name="msapplication-TileColor" content="#e91e8c">
    <meta name="msapplication-TileImage" content="img/favicon.png">

    <!-- ===== PRIMARY SEO ===== -->
    <title><?php echo htmlspecialchars($title); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($desc); ?>">
    <meta name="keywords" content="peluquería Viña del Mar, alisados sin formol, balayage Viña del Mar, coloración cabello, hidratación capilar, Adri Hair Style, peluquería personalizada Chile">
    <meta name="author" content="Adri Hair Style">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo htmlspecialchars($canonical); ?>">

    <!-- ===== GEO TAGS ===== -->
    <meta name="geo.region" content="CL-VS">
    <meta name="geo.placename" content="Viña del Mar, Chile">
    <meta name="geo.position" content="-33.0245;-71.5518">
    <meta name="ICBM" content="-33.0245, -71.5518">

    <!-- ===== OPEN GRAPH (Facebook / WhatsApp / LinkedIn) ===== -->
    <meta property="og:type" content="<?php echo htmlspecialchars($type); ?>">
    <meta property="og:locale" content="es_CL">
    <meta property="og:site_name" content="Adri Hair Style">
    <meta property="og:url" content="<?php echo htmlspecialchars($canonical); ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($title); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($desc); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($image); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- ===== TWITTER CARD ===== -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($title); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($desc); ?>">
    <meta name="twitter:image" content="<?php echo htmlspecialchars($image); ?>">

    <!-- ===== FONTS ===== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <!-- ===== STYLES ===== -->
    <link rel="stylesheet" href="css/styles.css?v=<?php echo $css_version; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <?php if (!$is_inner): ?>
    <!-- ===== SCHEMA.ORG (LocalBusiness / HairSalon) ===== -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "HairSalon",
      "name": "Adri Hair Style",
      "description": "Espacio de atención personalizada para tu cabello en Viña del Mar. Especialistas en alisados naturales sin formol, balayage, coloración e hidrataciones capilares.",
      "url": "https://adrihairstyle.cl",
      "telephone": "+56952442965",
      "email": "contacto@adrihairstyle.cl",
      "image": "https://adrihairstyle.cl/img/bio_Adri_editada_web_optimo.jpg",
      "priceRange": "$$",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Eduardo Groove 325, Oficina 7",
        "addressLocality": "Viña del Mar",
        "addressRegion": "Valparaíso",
        "addressCountry": "CL"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": "-33.0245",
        "longitude": "-71.5518"
      },
      "openingHoursSpecification": [
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
          "opens": "09:00",
          "closes": "19:00"
        }
      ],
      "sameAs": [
        "https://www.facebook.com/Adrihairstyle.cl",
        "https://www.instagram.com/adrihair.style/"
      ],
      "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "Servicios de Peluquería",
        "itemListElement": [
          { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Balayage" } },
          { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Alisados Naturales sin Formol" } },
          { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Coloración" } },
          { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Hidrataciones Capilares" } }
        ]
      }
    }
    </script>
    <?php endif; ?>
</head>

<body<?php echo $is_inner ? ' class="inner-page"' : ''; ?>>

    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-carousel-wrapper">
                <button class="top-bar-nav-btn top-bar-prev" aria-label="Información anterior">
                    <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                </button>
                <div class="top-bar-info" id="top-bar-info">
                    <span class="top-bar-item active"><i class="fa-solid fa-phone"></i> <a href="tel:+56952442965">+56 9 5244 2965</a></span>
                    <span class="top-bar-item"><i class="fa-solid fa-envelope"></i> <a href="mailto:contacto@adrihairstyle.cl">contacto@adrihairstyle.cl</a></span>
                    <span class="top-bar-item"><i class="fa-regular fa-clock"></i> Lun - Sab 9:00 - 20:00</span>
                    <span class="top-bar-item"><i class="fa-solid fa-location-dot"></i> Viña del Mar, Chile</span>
                </div>
                <button class="top-bar-nav-btn top-bar-next" aria-label="Información siguiente">
                    <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                </button>
            </div>
            <div class="top-bar-social">
                <a href="https://www.facebook.com/Adrihairstyle.cl" target="_blank" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/adrihair.style/" target="_blank" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar<?php echo $is_inner ? ' scrolled inner-navbar' : ''; ?>" id="main-nav" aria-label="Navegación principal">
        <div class="container">
            <a href="<?php echo $is_inner ? 'index.php' : '/'; ?>" class="logo" aria-label="Adri Hair Style - Inicio">
                <img src="img/logo_15042021LOGO_1.png" alt="Adri Hair Style - Peluquería en Viña del Mar" height="90">
            </a>

            <button class="menu-toggle" aria-label="Abrir menú" aria-expanded="false" aria-controls="nav-links">
                <i class="fa-solid fa-bars" aria-hidden="true"></i>
            </button>

            <div class="nav-links" id="nav-links" role="menubar">
                <button class="menu-close-btn" id="menu-close-btn" aria-label="Cerrar menú">
                    <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                </button>
                <a href="<?php echo $base_nav; ?>#" role="menuitem">Inicio</a>
                <a href="<?php echo $base_nav; ?>#conoceme" role="menuitem">Conóceme</a>
                <a href="<?php echo $base_nav; ?>#servicios" role="menuitem">Servicios</a>
                <a href="<?php echo $base_nav; ?>#blog" role="menuitem" class="<?php echo (!empty($is_blog_page)) ? 'active' : ''; ?>">Blog</a>
                <a href="<?php echo $base_nav; ?>#" role="menuitem">Cursos</a>
                <a href="https://agendarium.com/reservas/adri-hair-style" target="_blank" rel="noopener noreferrer" class="btn" role="menuitem">Agenda</a>
            </div>
        </div>
    </nav>
