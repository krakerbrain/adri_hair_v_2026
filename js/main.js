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
            // If the href is exactly "#id" and it matches current, add active. 
            // Also if current is empty and href is "#" (Inicio), add active.
            if (href === '#' + current || (current === '' && href === '#')) {
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
});
