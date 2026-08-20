// main.js

document.addEventListener('DOMContentLoaded', () => {
    // --- Mobile Menu Toggle & Fullscreen Drawer ---
    const menuToggle = document.querySelector('.menu-toggle');
    const navLinks = document.querySelector('.nav-links');
    const menuCloseBtn = document.getElementById('menu-close-btn');

    function openMenu() {
        if (!navLinks) return;
        navLinks.classList.add('active');
        if (menuToggle) menuToggle.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }

    function closeMenu() {
        if (!navLinks) return;
        navLinks.classList.remove('active');
        if (menuToggle) menuToggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    if (menuToggle) {
        menuToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            if (navLinks.classList.contains('active')) {
                closeMenu();
            } else {
                openMenu();
            }
        });
    }

    if (menuCloseBtn) {
        menuCloseBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            closeMenu();
        });
    }

    // Close mobile menu when clicking a link
    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', () => {
            closeMenu();
        });
    });

    // Close mobile menu on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && navLinks && navLinks.classList.contains('active')) {
            closeMenu();
        }
    });

    // --- Mobile Top Bar Carousel ---
    const topBarItems = document.querySelectorAll('.top-bar-item');
    const topBarPrevBtn = document.querySelector('.top-bar-prev');
    const topBarNextBtn = document.querySelector('.top-bar-next');
    const topBarWrapper = document.querySelector('.top-bar-carousel-wrapper');

    if (topBarItems.length > 0) {
        let currentTopBarIdx = 0;
        let topBarTimer = null;

        function showTopBarItem(newIndex, direction = 'next') {
            if (window.innerWidth > 768) return;
            const total = topBarItems.length;
            const prevIndex = currentTopBarIdx;
            currentTopBarIdx = (newIndex + total) % total;

            topBarItems.forEach((item, i) => {
                item.classList.remove('active', 'slide-prev');
                if (i === currentTopBarIdx) {
                    item.classList.add('active');
                } else if (i === prevIndex && direction === 'next') {
                    item.classList.add('slide-prev');
                }
            });
        }

        function startTopBarAutoplay() {
            if (topBarTimer) clearInterval(topBarTimer);
            topBarTimer = setInterval(() => {
                if (window.innerWidth <= 768) {
                    showTopBarItem(currentTopBarIdx + 1, 'next');
                }
            }, 3500);
        }

        if (topBarPrevBtn) {
            topBarPrevBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                showTopBarItem(currentTopBarIdx - 1, 'prev');
                startTopBarAutoplay();
            });
        }

        if (topBarNextBtn) {
            topBarNextBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                showTopBarItem(currentTopBarIdx + 1, 'next');
                startTopBarAutoplay();
            });
        }

        // Swipe support on mobile top-bar
        if (topBarWrapper) {
            let startX = 0;
            topBarWrapper.addEventListener('touchstart', (e) => {
                startX = e.changedTouches[0].screenX;
            }, { passive: true });
            topBarWrapper.addEventListener('touchend', (e) => {
                const diff = startX - e.changedTouches[0].screenX;
                if (Math.abs(diff) > 30) {
                    if (diff > 0) {
                        showTopBarItem(currentTopBarIdx + 1, 'next');
                    } else {
                        showTopBarItem(currentTopBarIdx - 1, 'prev');
                    }
                    startTopBarAutoplay();
                }
            }, { passive: true });
        }

        startTopBarAutoplay();
    }

    // --- Hero Slider ---
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.slider-dot');
    const prevBtn = document.getElementById('slider-prev');
    const nextBtn = document.getElementById('slider-next');

    if (slides.length > 0) {
        let currentSlide = 0;
        let autoplayTimer = null;
        let isPaused = false;

        function goToSlide(index) {
            slides[currentSlide].classList.remove('active');
            dots[currentSlide].classList.remove('active');
            dots[currentSlide].setAttribute('aria-selected', 'false');

            currentSlide = (index + slides.length) % slides.length;

            slides[currentSlide].classList.add('active');
            dots[currentSlide].classList.add('active');
            dots[currentSlide].setAttribute('aria-selected', 'true');
        }

        function startAutoplay() {
            if (autoplayTimer) clearInterval(autoplayTimer);
            autoplayTimer = setInterval(() => {
                if (!isPaused) goToSlide(currentSlide + 1);
            }, 5000);
        }

        // Arrow buttons
        if (prevBtn) prevBtn.addEventListener('click', () => { goToSlide(currentSlide - 1); startAutoplay(); });
        if (nextBtn) nextBtn.addEventListener('click', () => { goToSlide(currentSlide + 1); startAutoplay(); });

        // Dot buttons
        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => { goToSlide(i); startAutoplay(); });
        });

        // Pause on hover (desktop)
        const hero = document.querySelector('.hero');
        if (hero) {
            hero.addEventListener('mouseenter', () => { isPaused = true; });
            hero.addEventListener('mouseleave', () => { isPaused = false; });
        }

        // Touch/swipe support (mobile)
        let touchStartX = 0;
        const heroEl = document.querySelector('.hero');
        if (heroEl) {
            heroEl.addEventListener('touchstart', (e) => { touchStartX = e.changedTouches[0].screenX; }, { passive: true });
            heroEl.addEventListener('touchend', (e) => {
                const diff = touchStartX - e.changedTouches[0].screenX;
                if (Math.abs(diff) > 50) {
                    goToSlide(diff > 0 ? currentSlide + 1 : currentSlide - 1);
                    startAutoplay();
                }
            }, { passive: true });
        }

        startAutoplay();
    }

    // --- Scroll Reveal, Sticky Navbar & Scrollspy ---
    const reveals = document.querySelectorAll('.reveal');
    const navbar = document.querySelector('.navbar');
    const sections = document.querySelectorAll('section');
    const navItems = document.querySelectorAll('.nav-links a');

    function handleScroll() {
        // Sticky Navbar
        if (window.scrollY > 40) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }

        // Scroll Reveal
        const windowHeight = window.innerHeight;
        const elementVisible = 150;

        reveals.forEach(reveal => {
            const elementTop = reveal.getBoundingClientRect().top;
            if (elementTop < windowHeight - elementVisible) {
                reveal.classList.add('active');
            }
        });

        // Scrollspy
        let current = '';
        sections.forEach(section => {
            const sectionId = section.getAttribute('id');
            if (sectionId) {
                const sectionTop = section.offsetTop;
                if (window.scrollY >= (sectionTop - 150)) {
                    current = sectionId;
                }
            }
        });
        
        // Also check if we are at the very top (Hero section)
        if (window.scrollY < 150) {
            current = ''; // "Inicio" shouldn't necessarily trigger an ID unless Hero has one. 
        }

        // Dynamic Browser Tab Title based on active section (Landing page only)
        if (!document.body.classList.contains('inner-page')) {
            const sectionTitles = {
                'servicios': 'Servicios | Adri Hair Style',
                'conoceme': 'Conóceme | Adri Hair Style',
                'blog': 'Blog & Novedades | Adri Hair Style'
            };
            const originalTitle = 'Adri Hair Style | Alisados Naturales sin Formol, Balayage y Coloración en Viña del Mar';
            const newTitle = sectionTitles[current] || originalTitle;
            if (document.title !== newTitle) {
                document.title = newTitle;
            }
        }

        navItems.forEach(a => {
            a.classList.remove('active');
            const href = a.getAttribute('href');
            if (!href) return;
            
            // Extract the hash component (e.g. "blog" or "")
            const hash = href.includes('#') ? href.split('#')[1] : '';
            
            let isCurrent = (hash === current && current !== '');
            
            // If we are at the top and the hash is empty, or the link is just "#"
            if (current === '' && (href === '#' || href === 'index.html#' || href === 'index.php#' || href === 'index.php')) {
                isCurrent = true;
            }
            
            // If we are reading a post (blog-reader-section active) and the link is the blog
            if (current === 'blog-reader-section' && hash === 'blog') {
                isCurrent = true;
            }
            
            if (isCurrent) {
                a.classList.add('active');
            }
        });
    }

    window.addEventListener('scroll', handleScroll);
    // Trigger once on load
    handleScroll();

    // --- Mobile Center-Scroll Animation for Service Cards ---
    function setupMobileCenterScroll() {
        const serviceCards = document.querySelectorAll('.service-card');
        if (serviceCards.length === 0) return;

        function checkCardsInCenter() {
            if (window.innerWidth > 768) {
                serviceCards.forEach(card => card.classList.remove('in-center'));
                return;
            }

            const viewportHeight = window.innerHeight;
            const centerTopThreshold = viewportHeight * 0.18; // Top 18% boundary
            const centerBottomThreshold = viewportHeight * 0.82; // Bottom 82% boundary

            serviceCards.forEach(card => {
                const rect = card.getBoundingClientRect();
                const cardMiddle = rect.top + rect.height / 2;

                // Card's vertical center point is in the middle of screen
                if (cardMiddle >= centerTopThreshold && cardMiddle <= centerBottomThreshold) {
                    card.classList.add('in-center');
                } else {
                    card.classList.remove('in-center');
                }
            });
        }

        window.addEventListener('scroll', checkCardsInCenter, { passive: true });
        window.addEventListener('resize', checkCardsInCenter, { passive: true });
        // Initial check
        checkCardsInCenter();
    }

    setupMobileCenterScroll();

    // --- WhatsApp Popup Toggle ---
    const waBtn = document.querySelector('.whatsapp-float-btn');
    const waPopup = document.querySelector('.whatsapp-popup');

    if (waBtn && waPopup) {
        waBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            waPopup.classList.toggle('open');
        });

        // Close popup when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.whatsapp-container')) {
                waPopup.classList.remove('open');
            }
        });
    }

    // --- Blog Logic ---
    const blogGrid = document.getElementById('blog-grid');

    if (blogGrid) {
        // Fetch posts.json
        fetch('posts.json?t=' + new Date().getTime())
            .then(response => {
                if (!response.ok) {
                    throw new Error('No se pudo cargar el archivo posts.json');
                }
                return response.json();
            })
            .then(posts => {
                renderBlogCards(posts);
            })
            .catch(error => {
                console.error('Error cargando blog posts:', error);
                blogGrid.innerHTML = `
                    <div class="blog-loading">
                        <i class="fa-solid fa-triangle-exclamation" style="font-size: 2rem; color: #ff00a0;"></i>
                        <p>Lo sentimos, no pudimos cargar las entradas del blog en este momento.</p>
                    </div>
                `;
            });
    }

    function renderBlogCards(posts) {
        blogGrid.innerHTML = '';
        if (posts.length === 0) {
            blogGrid.innerHTML = `
                <div class="blog-loading">
                    <p>No hay publicaciones disponibles en este momento.</p>
                </div>
            `;
            return;
        }

        posts.forEach(post => {
            // Create direct SEO-friendly anchor wrapper
            const card = document.createElement('a');
            card.className = 'blog-card reveal';
            card.href = `post.php?id=${encodeURIComponent(post.id)}`;
            card.dataset.id = post.id;
            
            // Format date: "2026-06-10 22:43:45" -> "10 Jun, 2026"
            const rawDate = new Date(post.fecha_publicacion.replace(/-/g, '/'));
            const options = { day: 'numeric', month: 'short', year: 'numeric' };
            const formattedDate = rawDate.toLocaleDateString('es-ES', options);

            // Strip HTML/Markdown tags for excerpt
            const cleanText = post.texto
                .replace(/<[^>]*>/g, '') // remove HTML tags
                .replace(/[*#_`~\[\]]/g, '') // remove simple markdown characters
                .substring(0, 120) + '...';

            card.innerHTML = `
                <div class="blog-card-img">
                    <img src="${post.imagen_url}" alt="${post.titulo}" loading="lazy">
                </div>
                <div class="blog-card-body">
                    <div class="blog-card-meta">
                        <span><i class="fa-regular fa-calendar"></i> ${formattedDate}</span>
                    </div>
                    <h3 class="blog-card-title">${post.titulo}</h3>
                    <p class="blog-card-excerpt">${cleanText}</p>
                    <div class="blog-card-footer">
                        <div class="blog-card-author">
                            <img src="${post.foto_autor_url || 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=256&h=256&q=80'}" alt="${post.nombre_autor}" class="author-avatar">
                            <span class="author-name">${post.nombre_autor}</span>
                        </div>
                        <span class="blog-read-more">Leer Más <i class="fa-solid fa-arrow-right"></i></span>
                    </div>
                </div>
            `;

            blogGrid.appendChild(card);
        });

        // Refresh reveal elements to capture newly loaded cards
        refreshScrollReveal();
    }

    function refreshScrollReveal() {
        const windowHeight = window.innerHeight;
        const elementVisible = 150;

        // Force a scroll reveal check on dynamic cards
        const dynamicCards = document.querySelectorAll('.blog-card');
        dynamicCards.forEach(card => {
            card.classList.add('reveal');
            const elementTop = card.getBoundingClientRect().top;
            if (elementTop < windowHeight - elementVisible) {
                card.classList.add('active');
            }
        });
        
        // Add to main scroll listener
        window.addEventListener('scroll', () => {
            dynamicCards.forEach(card => {
                const elementTop = card.getBoundingClientRect().top;
                if (elementTop < windowHeight - elementVisible) {
                    card.classList.add('active');
                }
            });
        });
    }

    // --- Service Image Lightbox (Mobile) ---
    const lightboxOverlay = document.getElementById('service-lightbox');
    const lightboxImg     = document.getElementById('lightbox-img');
    const lightboxCaption = document.getElementById('lightbox-caption');
    const lightboxCloseBtn = document.getElementById('lightbox-close-btn');

    function openLightbox(imgSrc, caption, altText) {
        lightboxImg.src = imgSrc;
        lightboxImg.alt = altText || caption;
        lightboxCaption.textContent = caption || '';
        lightboxOverlay.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        lightboxOverlay.classList.remove('open');
        document.body.style.overflow = '';
        // Clear src after transition
        setTimeout(() => {
            if (!lightboxOverlay.classList.contains('open')) {
                lightboxImg.src = '';
            }
        }, 320);
    }

    // Enable image lightbox popup on mobile click
    document.querySelectorAll('.is-lightbox-trigger').forEach(trigger => {
        trigger.addEventListener('click', (e) => {
            if (window.innerWidth <= 768) {
                // Ignore if clicked on a button or link inside
                if (e.target.closest('a') || e.target.closest('button')) return;
                const imgSrc = trigger.dataset.img || trigger.querySelector('img')?.src;
                const caption = trigger.dataset.caption || '';
                const altText = trigger.querySelector('img')?.alt || '';
                if (imgSrc) {
                    openLightbox(imgSrc, caption, altText);
                }
            }
        });
    });

    if (lightboxCloseBtn) {
        lightboxCloseBtn.addEventListener('click', closeLightbox);
    }

    if (lightboxOverlay) {
        // Close on backdrop click (but not on image click)
        lightboxOverlay.addEventListener('click', (e) => {
            if (e.target === lightboxOverlay || e.target === lightboxImg) {
                closeLightbox();
            }
        });
    }

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && lightboxOverlay && lightboxOverlay.classList.contains('open')) {
            closeLightbox();
        }
    });
});
