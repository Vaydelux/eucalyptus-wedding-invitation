/**
 * Eucalyptus Wedding Invitation - JavaScript Functionality
 * Handles smooth scrolling, countdown timer, form validation, and animations
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all functionality
    initSmoothScrolling();
    initScrollAnimations();
    initFormValidation();
    initMobileMenu();
    
    console.log('Eucalyptus Wedding Invitation loaded successfully! 🌿');
});

/**
 * Smooth scrolling for navigation links
 */
function initSmoothScrolling() {
    const navLinks = document.querySelectorAll('.nav-link[href^="#"]');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                const offsetTop = targetSection.offsetTop - 100; // Account for fixed navbar
                
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
                
                // Update active nav link
                updateActiveNavLink(this);
            }
        });
    });
}

/**
 * Update active navigation link
 */
function updateActiveNavLink(activeLink) {
    // Remove active class from all links
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('active');
    });
    
    // Add active class to clicked link
    activeLink.classList.add('active');
}

/**
 * Initialize countdown timer
 */
function initCountdown(targetDate) {
    const daysEl = document.getElementById('days');
    const hoursEl = document.getElementById('hours');
    const minutesEl = document.getElementById('minutes');
    const secondsEl = document.getElementById('seconds');
    
    if (!daysEl || !hoursEl || !minutesEl || !secondsEl) {
        console.log('Countdown elements not found');
        return;
    }
    
    function updateCountdown() {
        const now = new Date().getTime();
        const distance = targetDate.getTime() - now;
        
        if (distance < 0) {
            // Wedding day has passed
            daysEl.textContent = '0';
            hoursEl.textContent = '0';
            minutesEl.textContent = '0';
            secondsEl.textContent = '0';
            
            // Show celebration message
            const countdownSection = document.querySelector('.countdown-section');
            if (countdownSection) {
                const celebrationMsg = document.createElement('div');
                celebrationMsg.className = 'celebration-message';
                celebrationMsg.innerHTML = '<h3>🎉 The Wedding Day is Here! 🎉</h3>';
                celebrationMsg.style.textAlign = 'center';
                celebrationMsg.style.marginTop = '2rem';
                celebrationMsg.style.color = '#27ae60';
                countdownSection.appendChild(celebrationMsg);
            }
            
            clearInterval(countdownInterval);
            return;
        }
        
        // Calculate time units
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        // Update display with animation
        animateNumberChange(daysEl, days);
        animateNumberChange(hoursEl, hours);
        animateNumberChange(minutesEl, minutes);
        animateNumberChange(secondsEl, seconds);
    }
    
    // Update immediately and then every second
    updateCountdown();
    const countdownInterval = setInterval(updateCountdown, 1000);
}

/**
 * Animate number changes in countdown
 */
function animateNumberChange(element, newValue) {
    const currentValue = parseInt(element.textContent);
    
    if (currentValue !== newValue) {
        element.style.transform = 'scale(1.1)';
        element.style.color = '#27ae60';
        
        setTimeout(() => {
            element.textContent = newValue;
            element.style.transform = 'scale(1)';
            element.style.color = '';
        }, 150);
    }
}

/**
 * Initialize scroll animations
 */
function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);
    
    // Add fade-in class to elements and observe them
    const animatedElements = document.querySelectorAll('.story-card, .detail-card, .gallery-item, .timeline-item');
    animatedElements.forEach(el => {
        el.classList.add('fade-in');
        observer.observe(el);
    });
}

/**
 * Form validation and enhancement
 */
function initFormValidation() {
    const rsvpForm = document.querySelector('.rsvp-form');
    
    if (!rsvpForm) return;
    
    // Real-time validation
    const inputs = rsvpForm.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('blur', validateField);
        input.addEventListener('input', clearFieldError);
    });
    
    // Form submission
    rsvpForm.addEventListener('submit', function(e) {
        if (!validateForm()) {
            e.preventDefault();
            showFormError('Please fill in all required fields correctly.');
        } else {
            showFormLoading();
        }
    });
    
    // Attendance selection enhancement
    const attendanceInputs = document.querySelectorAll('input[name="attendance"]');
    const guestCountGroup = document.querySelector('#guest_count').closest('.form-group');
    const dietaryGroup = document.querySelector('#dietary_requirements').closest('.form-group');
    
    attendanceInputs.forEach(input => {
        input.addEventListener('change', function() {
            if (this.value === 'yes') {
                guestCountGroup.style.display = 'block';
                dietaryGroup.style.display = 'block';
                animateElementIn(guestCountGroup);
                animateElementIn(dietaryGroup);
            } else {
                guestCountGroup.style.display = 'none';
                dietaryGroup.style.display = 'none';
            }
        });
    });
}

/**
 * Validate individual form field
 */
function validateField(e) {
    const field = e.target;
    const value = field.value.trim();
    
    // Remove existing error styling
    clearFieldError(e);
    
    // Validation rules
    let isValid = true;
    let errorMessage = '';
    
    if (field.hasAttribute('required') && !value) {
        isValid = false;
        errorMessage = 'This field is required';
    } else if (field.type === 'email' && value && !isValidEmail(value)) {
        isValid = false;
        errorMessage = 'Please enter a valid email address';
    } else if (field.type === 'tel' && value && !isValidPhone(value)) {
        isValid = false;
        errorMessage = 'Please enter a valid phone number';
    }
    
    if (!isValid) {
        showFieldError(field, errorMessage);
    }
    
    return isValid;
}

/**
 * Clear field error styling
 */
function clearFieldError(e) {
    const field = e.target;
    field.classList.remove('error');
    
    const errorMsg = field.parentNode.querySelector('.error-message');
    if (errorMsg) {
        errorMsg.remove();
    }
}

/**
 * Show field error
 */
function showFieldError(field, message) {
    field.classList.add('error');
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    errorDiv.textContent = message;
    errorDiv.style.color = '#e74c3c';
    errorDiv.style.fontSize = '0.9rem';
    errorDiv.style.marginTop = '0.5rem';
    
    field.parentNode.appendChild(errorDiv);
}

/**
 * Validate entire form
 */
function validateForm() {
    const form = document.querySelector('.rsvp-form');
    const requiredFields = form.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        const fieldEvent = { target: field };
        if (!validateField(fieldEvent)) {
            isValid = false;
        }
    });
    
    return isValid;
}

/**
 * Show form loading state
 */
function showFormLoading() {
    const submitBtn = document.querySelector('.rsvp-submit-btn');
    if (submitBtn) {
        submitBtn.textContent = 'Sending RSVP...';
        submitBtn.disabled = true;
        submitBtn.style.opacity = '0.7';
    }
}

/**
 * Show form error message
 */
function showFormError(message) {
    const form = document.querySelector('.rsvp-form');
    
    // Remove existing error message
    const existingError = form.querySelector('.form-error');
    if (existingError) {
        existingError.remove();
    }
    
    // Create new error message
    const errorDiv = document.createElement('div');
    errorDiv.className = 'form-error';
    errorDiv.textContent = message;
    errorDiv.style.cssText = `
        background-color: #f8d7da;
        color: #721c24;
        padding: 1rem;
        border-radius: 5px;
        margin-bottom: 1rem;
        border: 1px solid #f5c6cb;
    `;
    
    form.insertBefore(errorDiv, form.firstChild);
    
    // Scroll to error
    errorDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

/**
 * Email validation
 */
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

/**
 * Phone validation (basic)
 */
function isValidPhone(phone) {
    const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
    return phoneRegex.test(phone.replace(/[\s\-\(\)]/g, ''));
}

/**
 * Animate element entrance
 */
function animateElementIn(element) {
    element.style.opacity = '0';
    element.style.transform = 'translateY(20px)';
    element.style.transition = 'all 0.3s ease';
    
    setTimeout(() => {
        element.style.opacity = '1';
        element.style.transform = 'translateY(0)';
    }, 100);
}

/**
 * Mobile menu functionality
 */
function initMobileMenu() {
    // Add mobile menu toggle if needed
    const navbar = document.querySelector('.navbar');
    
    if (window.innerWidth <= 768) {
        // Mobile-specific enhancements
        const navLinks = document.querySelectorAll('.nav-link');
        
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                // Close mobile menu after clicking (if implemented)
                console.log('Mobile nav link clicked');
            });
        });
    }
}

/**
 * Utility function to debounce events
 */
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

/**
 * Handle window resize
 */
window.addEventListener('resize', debounce(() => {
    // Reinitialize mobile menu if needed
    if (window.innerWidth <= 768) {
        initMobileMenu();
    }
}, 250));

/**
 * Add CSS for error states
 */
const style = document.createElement('style');
style.textContent = `
    .form-group input.error,
    .form-group select.error,
    .form-group textarea.error {
        border-color: #e74c3c;
        box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1);
    }
    
    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }
    
    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    .nav-link.active {
        background-color: rgba(39, 174, 96, 0.2);
        color: #27ae60;
    }
`;
document.head.appendChild(style);

/**
 * Global countdown initialization function
 * Called from the HTML with the wedding date
 */
window.initCountdown = initCountdown;

/**
 * Easter egg - Konami code for fun
 */
let konamiCode = [];
const konamiSequence = [38, 38, 40, 40, 37, 39, 37, 39, 66, 65]; // Up Up Down Down Left Right Left Right B A

document.addEventListener('keydown', function(e) {
    konamiCode.push(e.keyCode);
    
    if (konamiCode.length > konamiSequence.length) {
        konamiCode.shift();
    }
    
    if (konamiCode.length === konamiSequence.length && 
        konamiCode.every((code, index) => code === konamiSequence[index])) {
        
        // Easter egg activated!
        document.body.style.animation = 'rainbow 2s infinite';
        
        const style = document.createElement('style');
        style.textContent = `
            @keyframes rainbow {
                0% { filter: hue-rotate(0deg); }
                100% { filter: hue-rotate(360deg); }
            }
        `;
        document.head.appendChild(style);
        
        setTimeout(() => {
            document.body.style.animation = '';
            style.remove();
        }, 5000);
        
        console.log('🌈 Easter egg activated! Emma & John send their love! 💕');
        konamiCode = [];
    }
});
