// main.js

document.addEventListener('DOMContentLoaded', () => {
    // --- Mobile Menu Toggle ---
    const menuToggle = document.querySelector('.menu-toggle');
    const navLinks = document.querySelector('.nav-links');

    if (menuToggle) {
        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    }

    // Close mobile menu when clicking a link
    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', () => {
            navLinks.classList.remove('active');
        });
    });

    // --- Hero Slider ---
    const slides = document.querySelectorAll('.slide');
    if (slides.length > 0) {
        let currentSlide = 0;
        
        function nextSlide() {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
        }

        // Change slide every 5 seconds
        setInterval(nextSlide, 5000);
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

        navItems.forEach(a => {
            a.classList.remove('active');
            const href = a.getAttribute('href');
            if (!href) return;
            
            // Extract the hash component (e.g. "blog" or "")
            const hash = href.includes('#') ? href.split('#')[1] : '';
            
            let isCurrent = (hash === current && current !== '');
            
            // If we are at the top and the hash is empty, or the link is just "#"
            if (current === '' && (href === '#' || href === 'index.html#')) {
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

    // --- 3D Card Flip ---
    const flipBtns = document.querySelectorAll('.flip-btn');
    const flipBackBtns = document.querySelectorAll('.flip-btn-back');

    flipBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const cardInner = btn.closest('.service-card-inner');
            if (cardInner) {
                cardInner.classList.add('flipped');
            }
        });
    });

    flipBackBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const cardInner = btn.closest('.service-card-inner');
            if (cardInner) {
                cardInner.classList.remove('flipped');
            }
        });
    });

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
        fetch('posts.json')
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
});
