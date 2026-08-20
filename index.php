<?php
/**
 * Adri Hair Style - Página Principal
 */
$page_title = "Adri Hair Style | Alisados Naturales sin Formol, Balayage y Coloración en Viña del Mar";
$page_desc  = "Adri Hair Style en Viña del Mar ofrece alisados naturales sin formol, balayage, coloración e hidrataciones capilares. Atención personalizada. ¡Agenda tu cita hoy!";
$canonical_url = "https://adrihairstyle.cl/";
$is_inner_page = false;

include __DIR__ . '/includes/header.php';
?>

    <main id="main-content">
        <!-- Hero Section -->
        <header class="hero" role="banner">
            <!-- Slider Images -->
            <div class="slide active" style="background-image: url('img/slide1_modeloriendo-1.jpg');" role="img"
                aria-label="Modelo con cabello liso y brillante"></div>
            <div class="slide" style="background-image: url('img/slide2_alisando2.jpg');" role="img"
                aria-label="Proceso de alisado capilar"></div>
            <div class="slide" style="background-image: url('img/slide3_productos.jpg');" role="img"
                aria-label="Productos de peluquería de alta calidad"></div>

            <!-- Slider Controls -->
            <button class="slider-btn slider-btn-prev" id="slider-prev" aria-label="Imagen anterior">
                <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
            </button>
            <button class="slider-btn slider-btn-next" id="slider-next" aria-label="Imagen siguiente">
                <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
            </button>

            <!-- Dot Indicators -->
            <div class="slider-dots" role="tablist" aria-label="Navegación del slider">
                <button class="slider-dot active" id="dot-0" role="tab" aria-selected="true" aria-label="Slide 1"></button>
                <button class="slider-dot" id="dot-1" role="tab" aria-selected="false" aria-label="Slide 2"></button>
                <button class="slider-dot" id="dot-2" role="tab" aria-selected="false" aria-label="Slide 3"></button>
            </div>

            <div class="hero-content">
                <h1>Bienvenid@ a<br>Adri Hair Style</h1>
                <p>Espacio de atención personalizada para tu cabello en Viña del Mar. Alisados naturales sin formol,
                    balayage, coloración e hidrataciones.</p>
                <div class="hero-buttons">
                    <a href="https://agendarium.com/reservas/adri-hair-style" target="_blank" rel="noopener noreferrer"
                        class="btn">Haz una Cita</a>
                    <a href="#servicios" class="btn btn-outline">Conoce nuestros servicios</a>
                </div>
            </div>
        </header>

        <!-- Services Section -->
        <section id="servicios" class="section-padding">
            <div class="container">
                <h2 class="section-title reveal">Nuestros Servicios</h2>

                <div class="services-grid">
                    <!-- Service 1: Balayage -->
                    <div class="service-card reveal">
                        <div class="service-img is-lightbox-trigger"
                             data-img="img/servicios/coloracion_1_03052021-1.jpg"
                             data-caption="Balayage">
                            <img src="img/servicios/coloracion_1_03052021-1.jpg"
                                alt="Balayage en Viña del Mar – Adri Hair Style" loading="lazy" width="600"
                                height="580">
                            <!-- Desktop scrim + slide-up overlay -->
                            <div class="service-scrim" aria-hidden="true"></div>
                            <div class="service-overlay" aria-hidden="true">
                                <h3 class="service-title-overlay">Balayage</h3>
                                <p class="service-desc-overlay">Técnicas modernas de iluminación que aportan luz y dimensión con un acabado natural y elegante.</p>
                                <a href="https://agendarium.com/reservas/adri-hair-style" target="_blank"
                                    rel="noopener noreferrer" class="btn">Agendar Cita</a>
                            </div>
                            <!-- Vertical label (visible when card is collapsed) -->
                            <div class="service-card-label" aria-hidden="true">
                                <span>Balayage</span>
                            </div>
                        </div>
                        <!-- Mobile: always-visible body -->
                        <div class="service-body">
                            <h3>Balayage</h3>
                            <p>Técnicas modernas de iluminación que aportan luz y dimensión a tu cabello con un acabado natural y elegante.</p>
                            <a href="https://agendarium.com/reservas/adri-hair-style" target="_blank"
                                rel="noopener noreferrer" class="btn">Agendar Cita</a>
                        </div>
                    </div>

                    <!-- Service 2: Alisados -->
                    <div class="service-card reveal" style="transition-delay: 0.1s;">
                        <div class="service-img is-lightbox-trigger"
                             data-img="img/servicios/COLORACION_3_03052021-pd9hwp85q4sw8bmi86429lqvdinhc8r91hpd91wd1q.jpg"
                             data-caption="Alisados sin Formol">
                            <img src="img/servicios/COLORACION_3_03052021-pd9hwp85q4sw8bmi86429lqvdinhc8r91hpd91wd1q.jpg"
                                alt="Alisados naturales sin formol en Viña del Mar – Adri Hair Style"
                                loading="lazy" width="600" height="580">
                            <div class="service-scrim" aria-hidden="true"></div>
                            <div class="service-overlay" aria-hidden="true">
                                <h3 class="service-title-overlay">Alisados sin Formol</h3>
                                <p class="service-desc-overlay">Cabello totalmente liso, brillante y sano sin químicos agresivos. Especialistas en alisados naturales.</p>
                                <a href="https://agendarium.com/reservas/adri-hair-style" target="_blank"
                                    rel="noopener noreferrer" class="btn">Agendar Cita</a>
                            </div>
                            <div class="service-card-label" aria-hidden="true">
                                <span>Alisados</span>
                            </div>
                        </div>
                        <div class="service-body">
                            <h3>Alisados sin Formol</h3>
                            <p>Especialistas en alisados naturales sin formol. Cabello totalmente liso, brillante y sano sin químicos agresivos.</p>
                            <a href="https://agendarium.com/reservas/adri-hair-style" target="_blank"
                                rel="noopener noreferrer" class="btn">Agendar Cita</a>
                        </div>
                    </div>

                    <!-- Service 3: Coloración -->
                    <div class="service-card reveal" style="transition-delay: 0.2s;">
                        <div class="service-img is-lightbox-trigger"
                             data-img="img/servicios/COLORACION_2_03052021-pd9hu2agjv6xnpgemj2qrrpbdlneqtad0ftbs3t4i6.jpg"
                             data-caption="Coloración">
                            <img src="img/servicios/COLORACION_2_03052021-pd9hu2agjv6xnpgemj2qrrpbdlneqtad0ftbs3t4i6.jpg"
                                alt="Coloración capilar en Viña del Mar – Adri Hair Style" loading="lazy"
                                width="600" height="580">
                            <div class="service-scrim" aria-hidden="true"></div>
                            <div class="service-overlay" aria-hidden="true">
                                <h3 class="service-title-overlay">Coloración</h3>
                                <p class="service-desc-overlay">Colores vibrantes y duraderos con productos de alta calidad que cuidan y protegen la fibra capilar.</p>
                                <a href="https://agendarium.com/reservas/adri-hair-style" target="_blank"
                                    rel="noopener noreferrer" class="btn">Agendar Cita</a>
                            </div>
                            <div class="service-card-label" aria-hidden="true">
                                <span>Coloración</span>
                            </div>
                        </div>
                        <div class="service-body">
                            <h3>Coloración</h3>
                            <p>Colores vibrantes y duraderos con productos de alta calidad que cuidan y protegen la fibra capilar en cada proceso.</p>
                            <a href="https://agendarium.com/reservas/adri-hair-style" target="_blank"
                                rel="noopener noreferrer" class="btn">Agendar Cita</a>
                        </div>
                    </div>

                    <!-- Service 4: Hidrataciones -->
                    <div class="service-card reveal" style="transition-delay: 0.3s;">
                        <div class="service-img is-lightbox-trigger"
                             data-img="img/servicios/rubia_adrihayr_style-pdt0swhz0icigpuygjt8kod64nglxhonpnvr8l3tvy.jpg"
                             data-caption="Hidrataciones">
                            <img src="img/servicios/rubia_adrihayr_style-pdt0swhz0icigpuygjt8kod64nglxhonpnvr8l3tvy.jpg"
                                alt="Hidratación capilar en Viña del Mar – Adri Hair Style" loading="lazy"
                                width="600" height="580">
                            <div class="service-scrim" aria-hidden="true"></div>
                            <div class="service-overlay" aria-hidden="true">
                                <h3 class="service-title-overlay">Hidrataciones</h3>
                                <p class="service-desc-overlay">Tratamientos profundos para restaurar la vitalidad, suavidad y el brillo natural de tu cabello.</p>
                                <a href="https://agendarium.com/reservas/adri-hair-style" target="_blank"
                                    rel="noopener noreferrer" class="btn">Agendar Cita</a>
                            </div>
                            <div class="service-card-label" aria-hidden="true">
                                <span>Hidrataciones</span>
                            </div>
                        </div>
                        <div class="service-body">
                            <h3>Hidrataciones</h3>
                            <p>Tratamientos profundos para restaurar la vitalidad, suavidad y el brillo natural de tu cabello dañado o reseco.</p>
                            <a href="https://agendarium.com/reservas/adri-hair-style" target="_blank"
                                rel="noopener noreferrer" class="btn">Agendar Cita</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Bio Section -->
        <section id="conoceme" class="bio-section section-padding">
            <div class="container">
                <div class="bio-container">
                    <div class="bio-image reveal">
                        <img src="img/bio_Adri_editada_web_optimo.jpg"
                            alt="Adriana Alfonzo, estilista fundadora de Adri Hair Style en Viña del Mar" loading="lazy"
                            width="600" height="800">
                    </div>
                    <div class="bio-content reveal">
                        <h2>Hola a tod@s</h2>
                        <p>Soy Adriana Alfonzo, nací en Venezuela y vivo en Viña del Mar, Chile desde el 2015.</p>
                        <p>Me encantan las redes sociales, conversar, reír, oír música, ver series, y otras tantas
                            cosas. En el año 2018 comencé con mi proyecto.</p>
                        <p>Quería combinar lo que he aprendido sobre el cuidado y tratamiento del cabello con mis ganas
                            de hablar y conocer gente nueva.</p>
                        <p>Así que creé un espacio en donde, de forma personalizada, puedes venir a cambiar tu estilo y
                            a la vez pasar un rato agradable en mi compañía… jajajaja….</p>
                        <p><strong>Aquí te espero siempre que te haga falta un cambio.</strong></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Blog Section -->
        <section id="blog" class="section-padding">
            <div class="container">
                <h2 class="section-title reveal">Blog & Novedades</h2>
                <div class="blog-grid" id="blog-grid">
                    <!-- Se cargará dinámicamente con JS -->
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section" aria-label="Llamado a la acción - Agenda tu cita">
            <div class="container cta-content reveal">
                <h2>¿Lista para un cambio?</h2>
                <a href="https://agendarium.com/reservas/adri-hair-style" target="_blank" rel="noopener noreferrer"
                    class="btn">Haz una cita!</a>
            </div>
        </section>

    </main>

<?php
include __DIR__ . '/includes/footer.php';
?>
