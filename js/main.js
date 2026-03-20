/**
 * CLIL Learning - Interactions & Animations
 */
document.addEventListener('DOMContentLoaded', () => {

    // Remove loading state to allow un-hiding of body
    document.body.classList.remove('loading');

    /* =======================================
       1. NAVBAR SCROLL EFFECT
    ======================================= */
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 30) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    /* =======================================
       2. MOBILE MENU
    ======================================= */
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const closeMenuBtn = document.getElementById('close-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobLinks = document.querySelectorAll('.mob-link, .mob-btn');

    const toggleMenu = () => {
        mobileMenu.classList.toggle('active');
        document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
    };

    if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', toggleMenu);
    if (closeMenuBtn) closeMenuBtn.addEventListener('click', toggleMenu);
    mobLinks.forEach(link => link.addEventListener('click', toggleMenu));

    /* =======================================
       3. SMOOTH SCROLLING
    ======================================= */
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                const headerOffset = 90;
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    /* =======================================
       4. INTERSECTION OBSERVER FOR ANIMATIONS
    ======================================= */
    const animElements = document.querySelectorAll('.reveal-fade-up, .reveal-fade-in, .reveal-slide-left, .reveal-slide-right');
    const observerOptions = {
        root: null,
        rootMargin: '0px 0px -100px 0px', // Trigger slightly before the element
        threshold: 0.1
    };

    const animObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                observer.unobserve(entry.target); // Animate only once
            }
        });
    }, observerOptions);

    animElements.forEach(el => animObserver.observe(el));

    /* =======================================
       5. FAQ ACCORDION
    ======================================= */
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const questionBtn = item.querySelector('.faq-question');
        questionBtn.addEventListener('click', () => {
            // Close all others
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });
            // Toggle current
            item.classList.toggle('active');
        });
    });

    /* =======================================
       6. FORM SUBMISSION MOCK
    ======================================= */
    const form = document.getElementById('lead-form');
    if (form) {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const btn = form.querySelector('button');
            const originalText = btn.innerHTML;
            
            // Loading state
            btn.innerHTML = 'Enviando...';
            btn.style.opacity = '0.7';
            btn.style.pointerEvents = 'none';

            // Simulate API request Delay
            setTimeout(() => {
                alert('¡Plaza solicitada correctamente! En breve un asesor te contactará.');
                form.reset();
                btn.innerHTML = originalText;
                btn.style.opacity = '1';
                btn.style.pointerEvents = 'all';
            }, 1000);
        });
    }

    /* =======================================
       7. BACK TO TOP BUTTON
    ======================================= */
    const backToTopBtn = document.getElementById('back-to-top');
    if (backToTopBtn) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 400) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        });

        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
});
