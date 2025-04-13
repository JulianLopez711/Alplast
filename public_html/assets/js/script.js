
        document.addEventListener('DOMContentLoaded', function() {
            // Menú móvil
            const menuBtn = document.getElementById('menuBtn');
            const navMenu = document.getElementById('navMenu');
            
            if (menuBtn && navMenu) {
                menuBtn.addEventListener('click', function() {
                    navMenu.classList.toggle('active');
                });
                
                // Cerrar menú al hacer clic en un enlace
                const navLinks = navMenu.querySelectorAll('a');
                navLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        navMenu.classList.remove('active');
                    });
                });
            }
            
            // Navegación suave
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);
                    
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 70,
                            behavior: 'smooth'
                        });
                    }
                });
            });
            
            // Manejo del formulario
            const contactForm = document.getElementById('contactForm');
            const successMessage = document.getElementById('successMessage');
            const errorMessage = document.getElementById('errorMessage');
            
            if (contactForm) {
                contactForm.addEventListener('submit', function(e) {
                    // En un entorno local sin PHP, podemos simular el envío
                    // En producción, esto se manejará en el servidor
                    // Este código es solo para demostración
                    e.preventDefault();
                    
                    // Aquí iría la lógica para enviar los datos del formulario al servidor
                    // Por ahora, solo mostraremos el mensaje de éxito para simular
                    successMessage.style.display = 'block';
                    
                    // Ocultar el mensaje después de 5 segundos
                    setTimeout(() => {
                        successMessage.style.display = 'none';
                    }, 5000);
                    
                    // Restablecer el formulario
                    contactForm.reset();
                });
            }
        });
