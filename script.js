// Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    
    // Elementos del DOM
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.nav-menu');
    const modal = document.getElementById('modal');
    const closeModal = document.querySelector('.close');
    const contactForm = document.getElementById('contact-form');
    const ctaButton = document.getElementById('cta-button');
    const serviceCards = document.querySelectorAll('.service-card');
    const counterNumbers = document.querySelectorAll('.counter-number');
    
    // Menú móvil
    hamburger.addEventListener('click', function() {
        navMenu.classList.toggle('active');
        hamburger.classList.toggle('active');
    });
    
    // Cerrar menú al hacer clic en un enlace
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', () => {
            navMenu.classList.remove('active');
            hamburger.classList.remove('active');
        });
    });
    
    // Navegación suave
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Botón CTA
    ctaButton.addEventListener('click', function() {
        showModal('¡Gracias por tu interés!', 'Nos pondremos en contacto contigo pronto.');
    });
    
    // Efectos en las tarjetas de servicios
    serviceCards.forEach(card => {
        card.addEventListener('click', function() {
            const service = this.getAttribute('data-service');
            const serviceNames = {
                'web': 'Desarrollo Web',
                'mobile': 'Aplicaciones Móviles',
                'design': 'Diseño UI/UX'
            };
            showModal(`Servicio: ${serviceNames[service]}`, 
                     'Nuestro equipo está listo para ayudarte con este servicio. ¡Contáctanos para más información!');
        });
        
        // Efecto de hover con tilt
        card.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = (y - centerY) / 10;
            const rotateY = (centerX - x) / 10;
            
            this.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateZ(10px)`;
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateZ(0)';
        });
    });
    
    // Animación de contadores
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px 0px -100px 0px'
    };
    
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const target = parseInt(counter.getAttribute('data-target'));
                animateCounter(counter, target);
                counterObserver.unobserve(counter);
            }
        });
    }, observerOptions);
    
    counterNumbers.forEach(counter => {
        counterObserver.observe(counter);
    });
    
    // Función para animar contadores
    function animateCounter(element, target) {
        let current = 0;
        const increment = target / 100;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current);
        }, 20);
    }
    
    // Manejo del formulario de contacto
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const submitButton = this.querySelector('button[type="submit"]');
        
        // Validación
        const name = formData.get('name');
        const email = formData.get('email');
        const message = formData.get('message');
        
        if (!validateForm(name, email, message)) {
            return;
        }
        
        // Simular envío
        submitButton.textContent = 'Enviando...';
        submitButton.classList.add('loading');
        
        setTimeout(() => {
            submitButton.textContent = '¡Enviado!';
            submitButton.classList.remove('loading');
            submitButton.classList.add('success');
            
            showModal('¡Mensaje Enviado!', 'Gracias por contactarnos. Te responderemos pronto.');
            this.reset();
            
            setTimeout(() => {
                submitButton.textContent = 'Enviar Mensaje';
                submitButton.classList.remove('success');
            }, 3000);
        }, 2000);
    });
    
    // Validación del formulario
    function validateForm(name, email, message) {
        let isValid = true;
        
        // Limpiar errores previos
        document.querySelectorAll('.error').forEach(el => {
            el.classList.remove('error');
        });
        
        if (!name || name.trim().length < 2) {
            document.getElementById('name').classList.add('error');
            isValid = false;
        }
        
        if (!email || !isValidEmail(email)) {
            document.getElementById('email').classList.add('error');
            isValid = false;
        }
        
        if (!message || message.trim().length < 10) {
            document.getElementById('message').classList.add('error');
            isValid = false;
        }
        
        return isValid;
    }
    
    // Validación de email
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    // Modal
    function showModal(title, message) {
        const modalContent = modal.querySelector('.modal-content');
        modalContent.innerHTML = `
            <span class="close">&times;</span>
            <h2>${title}</h2>
            <p>${message}</p>
        `;
        
        modal.style.display = 'block';
        
        // Re-asignar evento de cierre
        modal.querySelector('.close').addEventListener('click', closeModalFunction);
    }
    
    function closeModalFunction() {
        modal.style.display = 'none';
    }
    
    // Cerrar modal
    closeModal.addEventListener('click', closeModalFunction);
    
    // Cerrar modal al hacer clic fuera
    window.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModalFunction();
        }
    });
    
    // Efecto de parallax en el hero
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const hero = document.querySelector('.hero');
        const rate = scrolled * -0.5;
        hero.style.transform = `translateY(${rate}px)`;
    });
    
    // Animación de aparición al hacer scroll
    const observerOptionsScroll = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const scrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptionsScroll);
    
    // Aplicar animación a elementos
    document.querySelectorAll('.service-card, .counter-item, .contact-form').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        scrollObserver.observe(el);
    });
    
    // Efecto de typing en el título
    function typeWriter(element, text, speed = 100) {
        let i = 0;
        element.textContent = '';
        
        function type() {
            if (i < text.length) {
                element.textContent += text.charAt(i);
                i++;
                setTimeout(type, speed);
            }
        }
        type();
    }
    
    // Aplicar efecto de typing al título principal
    const heroTitle = document.querySelector('.hero-title');
    const originalText = heroTitle.textContent;
    typeWriter(heroTitle, originalText, 80);
    
    // Efecto de partículas en el fondo
    function createParticle() {
        const particle = document.createElement('div');
        particle.style.position = 'absolute';
        particle.style.width = '2px';
        particle.style.height = '2px';
        particle.style.background = 'rgba(255, 255, 255, 0.5)';
        particle.style.borderRadius = '50%';
        particle.style.pointerEvents = 'none';
        
        const hero = document.querySelector('.hero');
        hero.appendChild(particle);
        
        const startX = Math.random() * window.innerWidth;
        const startY = window.innerHeight + 10;
        const endX = startX + (Math.random() - 0.5) * 200;
        const endY = -10;
        const duration = Math.random() * 3000 + 2000;
        
        particle.style.left = startX + 'px';
        particle.style.top = startY + 'px';
        
        const startTime = Date.now();
        
        function animate() {
            const elapsed = Date.now() - startTime;
            const progress = elapsed / duration;
            
            if (progress < 1) {
                const currentX = startX + (endX - startX) * progress;
                const currentY = startY + (endY - startY) * progress;
                
                particle.style.left = currentX + 'px';
                particle.style.top = currentY + 'px';
                
                requestAnimationFrame(animate);
            } else {
                particle.remove();
            }
        }
        
        animate();
    }
    
    // Crear partículas periódicamente
    setInterval(createParticle, 300);
    
    // Efecto de hover en botones
    document.querySelectorAll('.btn').forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px) scale(1.05)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
    
    // Preloader
    window.addEventListener('load', function() {
        const preloader = document.createElement('div');
        preloader.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        `;
        
        preloader.innerHTML = `
            <div style="text-align: center; color: white;">
                <div style="font-size: 2rem; margin-bottom: 1rem;">Cargando...</div>
                <div style="width: 50px; height: 50px; border: 3px solid rgba(255,255,255,0.3); border-top: 3px solid white; border-radius: 50%; animation: spin 1s linear infinite;"></div>
            </div>
        `;
        
        document.body.appendChild(preloader);
        
        setTimeout(() => {
            preloader.style.opacity = '0';
            setTimeout(() => {
                preloader.remove();
            }, 500);
        }, 1000);
    });
    
    // Agregar estilos para la animación de spin
    const style = document.createElement('style');
    style.textContent = `
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    `;
    document.head.appendChild(style);
    
    // Console log para debugging
    console.log('🚀 Aplicación cargada exitosamente!');
    console.log('📱 Funcionalidades disponibles:');
    console.log('- Navegación suave');
    console.log('- Menú móvil responsive');
    console.log('- Animaciones de contadores');
    console.log('- Formulario de contacto con validación');
    console.log('- Efectos de hover y parallax');
    console.log('- Modal interactivo');
    console.log('- Partículas animadas');
});