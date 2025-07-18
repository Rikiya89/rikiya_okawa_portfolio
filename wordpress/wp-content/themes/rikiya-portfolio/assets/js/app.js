(function() {
    // Use jQuery document ready for WordPress compatibility
    jQuery(document).ready(function($) {
        // Handle loading spinner
        let spinner = document.querySelector('.intersecting-circles-spinner');
        if (spinner) {
            // Apply fade-out animation
            spinner.classList.add('fade-out');

            // Wait for the animation to finish before hiding the spinner
            spinner.addEventListener('animationend', () => {
                spinner.style.display = 'none';
            });
        }

        // Initialize Swiper after DOM and external scripts are fully loaded
        // Use a small delay to ensure Swiper is loaded
        setTimeout(function() {
            if (typeof Swiper !== 'undefined') {
                let swiper = new Swiper(".mySwiper", {
                    effect: "flip",
                    grabCursor: true,
                    pagination: {
                        el: ".swiper-pagination",
                    },
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                });
            }
        }, 100);
    });
    
    
    // DOM ready functions for WordPress compatibility
    jQuery(document).ready(function($) {
        // scroll to top functionality
        const scrollUp = document.querySelector("#scroll-up");
        
        if (scrollUp) {
            scrollUp.addEventListener("click", () => {
                window.scrollTo({
                    top: 0,
                    left: 0,
                    behavior: "smooth",
                });
            });
        }
        
        // Nav hamburger selections
        const burger = document.querySelector("#burger-menu");
        const ul = document.querySelector("nav ul");
        const nav = document.querySelector("nav");
        
        if (burger && ul) {
            burger.addEventListener("click", () => {
                ul.classList.toggle("show");
            });
        }
        
        // Close hamburger menu when a link is clicked
        const navLink = document.querySelectorAll(".nav-link");
        
        navLink.forEach((link) =>
            link.addEventListener("click", () => {
                if (ul) {
                    ul.classList.remove("show");
                }
            })
        );
    });
    
    // Scroll animations - optimized for WordPress
    let scrollTimeout;
    
    window.addEventListener('scroll', function () {
        // Throttle scroll events for better performance
        if (scrollTimeout) {
            clearTimeout(scrollTimeout);
        }
        
        scrollTimeout = setTimeout(function() {
            // Fade-In animations for iconSection
            let iconSections = document.querySelectorAll('.iconSection');
        
            iconSections.forEach(function (iconSection) {
                let position = iconSection.getBoundingClientRect();
        
                // Check if the section is in the viewport
                if (position.top <= window.innerHeight && position.bottom >= 0) {
                    // Calculate opacity based on how far the element is from the top of the viewport
                    let opacity = (window.innerHeight - position.top) / window.innerHeight;
        
                    // Apply the calculated opacity
                    iconSection.style.opacity = Math.min(opacity, 1);
                }
            });
            
            // For iconSection and first-set classes
            let commonSections = document.querySelectorAll('.iconSection, .first-set');
        
            commonSections.forEach(function (section, index) {
                let position = section.getBoundingClientRect();
        
                // Check if the section is in the viewport
                if (position.top <= window.innerHeight && position.bottom >= 0) {
                    setTimeout(function () {
                        // Calculate opacity based on how far the element is from the top of the viewport
                        let opacity = (window.innerHeight - position.top) / window.innerHeight;
        
                        // Apply the calculated opacity
                        section.style.opacity = Math.min(opacity, 1);
                    }, index * 100);  // 100ms delay between each
                }
            });
        
            // For project-card-fadein class
            let projectCards = document.querySelectorAll('.project-card-fadein');
        
            projectCards.forEach(function (projectCard, index) {
                let position = projectCard.getBoundingClientRect();
        
                // Check if the section is in the viewport
                if (position.top <= window.innerHeight && position.bottom >= 0) {
                    setTimeout(function () {
                        // Calculate opacity based on how far the element is from the top of the viewport
                        let opacity = (window.innerHeight - position.top) / window.innerHeight;
        
                        // Apply the calculated opacity and transform
                        projectCard.style.opacity = Math.min(opacity, 1);
                        projectCard.style.transform = `translateY(${Math.min(50 * (1 - opacity), 50)}px)`;
                    }, index * 200);  // 200ms delay between each
                }
            });
        }, 16); // ~60fps throttling
    });

    
})();