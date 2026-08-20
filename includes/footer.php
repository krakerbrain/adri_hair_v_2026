<?php
/**
 * Footer unificado - Adri Hair Style
 */
$js_version = file_exists(__DIR__ . '/../js/main.js') ? filemtime(__DIR__ . '/../js/main.js') : '20260820';
?>
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col reveal">
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

                <div class="footer-col reveal" style="transition-delay: 0.1s;">
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
                <p>&copy; <?php echo date('Y'); ?> Adri Hair Style. Todos los derechos reservados.</p>
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
    <script src="js/main.js?v=<?php echo $js_version; ?>"></script>

    <!-- Service Image Lightbox Overlay -->
    <div class="lightbox-overlay" id="service-lightbox" role="dialog" aria-modal="true" aria-label="Ver imagen del servicio">
        <button class="lightbox-close" id="lightbox-close-btn" aria-label="Cerrar lightbox">
            <i class="fa-solid fa-xmark" aria-hidden="true"></i>
        </button>
        <img src="" alt="" id="lightbox-img">
        <div class="lightbox-caption" id="lightbox-caption"></div>
    </div>
</body>

</html>
