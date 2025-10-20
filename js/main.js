// Main JavaScript module - Pure ES6, no frameworks
// Modern browser APIs only: IntersectionObserver, View Transitions, etc.

// DOM ready helper
const ready = (fn) => {
  if (document.readyState !== 'loading') {
    fn();
  } else {
    document.addEventListener('DOMContentLoaded', fn);
  }
};

// Utility functions
const $ = (selector) => document.querySelector(selector);
const $$ = (selector) => document.querySelectorAll(selector);

// Initialize app
ready(() => {
  initYear();
  initNavigation();
  initScrollAnimations();
  initViewTransitions();
  initFormEnhancements();
  initAccessibility();
});

// Update year in footer
function initYear() {
  const yearElement = $('#year');
  if (yearElement) {
    yearElement.textContent = new Date().getFullYear();
  }
}

// Mobile navigation
function initNavigation() {
  const toggle = $('.nav__toggle');
  const menu = $('#nav-menu');
  
  if (!toggle || !menu) return;
  
  toggle.addEventListener('click', () => {
    const isExpanded = toggle.getAttribute('aria-expanded') === 'true';
    toggle.setAttribute('aria-expanded', String(!isExpanded));
    menu.toggleAttribute('data-open');
    
    // Prevent body scroll when menu is open
    document.body.style.overflow = !isExpanded ? 'hidden' : '';
  });
  
  // Close menu when clicking outside
  document.addEventListener('click', (e) => {
    if (!toggle.contains(e.target) && !menu.contains(e.target)) {
      toggle.setAttribute('aria-expanded', 'false');
      menu.removeAttribute('data-open');
      document.body.style.overflow = '';
    }
  });
  
  // Close menu on escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && menu.hasAttribute('data-open')) {
      toggle.setAttribute('aria-expanded', 'false');
      menu.removeAttribute('data-open');
      document.body.style.overflow = '';
      toggle.focus();
    }
  });
  
  // Close menu when clicking on links (mobile)
  menu.addEventListener('click', (e) => {
    if (e.target.matches('a')) {
      toggle.setAttribute('aria-expanded', 'false');
      menu.removeAttribute('data-open');
      document.body.style.overflow = '';
    }
  });
}

// Scroll-triggered animations
function initScrollAnimations() {
  // Check if IntersectionObserver is supported
  if (!('IntersectionObserver' in window)) {
    // Fallback: show all elements immediately
    $$('[data-animate]').forEach(el => el.classList.add('in'));
    return;
  }
  
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('in');
        
        // Add stagger delay for grid items
        if (entry.target.closest('.grid')) {
          const gridItems = $$('.grid [data-animate]');
          const index = Array.from(gridItems).indexOf(entry.target);
          entry.target.style.setProperty('--stagger', index);
        }
        
        // Unobserve after animation
        observer.unobserve(entry.target);
      }
    });
  }, {
    rootMargin: '0px 0px -10% 0px',
    threshold: 0.1
  });
  
  // Observe all elements with data-animate
  $$('[data-animate]').forEach(el => {
    observer.observe(el);
  });
}

// View Transitions API for smooth navigation
function initViewTransitions() {
  if (!document.startViewTransition) return;
  
  // Handle anchor links with smooth transitions
  $$('a[href^="#"]').forEach(link => {
    link.addEventListener('click', (e) => {
      const href = link.getAttribute('href');
      if (!href || href === '#') return;
      
      const target = $(href);
      if (!target) return;
      
      e.preventDefault();
      
      document.startViewTransition(() => {
        // Update URL
        history.pushState(null, '', href);
        
        // Scroll to target
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
        
        // Focus management for accessibility
        target.setAttribute('tabindex', '-1');
        target.focus();
        target.addEventListener('blur', () => {
          target.removeAttribute('tabindex');
        }, { once: true });
      });
    });
  });
}

// Form enhancements
function initFormEnhancements() {
  const form = $('.contact__form');
  if (!form) return;
  
  // Add loading state to submit button
  form.addEventListener('submit', (e) => {
    const submitBtn = form.querySelector('button[type="submit"]');
    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.textContent = 'Wird gesendet...';
      
      // Re-enable after 3 seconds (fallback)
      setTimeout(() => {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Nachricht senden';
      }, 3000);
    }
  });
  
  // Real-time validation
  const inputs = form.querySelectorAll('input, textarea');
  inputs.forEach(input => {
    input.addEventListener('blur', validateField);
    input.addEventListener('input', clearValidation);
  });
  
  function validateField(e) {
    const field = e.target;
    const isValid = field.checkValidity();
    
    field.classList.toggle('invalid', !isValid);
    
    if (!isValid) {
      showFieldError(field, field.validationMessage);
    } else {
      clearFieldError(field);
    }
  }
  
  function clearValidation(e) {
    const field = e.target;
    field.classList.remove('invalid');
    clearFieldError(field);
  }
  
  function showFieldError(field, message) {
    clearFieldError(field);
    
    const error = document.createElement('div');
    error.className = 'field-error';
    error.textContent = message;
    error.setAttribute('role', 'alert');
    
    field.parentNode.appendChild(error);
  }
  
  function clearFieldError(field) {
    const existingError = field.parentNode.querySelector('.field-error');
    if (existingError) {
      existingError.remove();
    }
  }
}

// Accessibility enhancements
function initAccessibility() {
  // Skip to main content
  const skipLink = $('.skip');
  if (skipLink) {
    skipLink.addEventListener('click', (e) => {
      e.preventDefault();
      const target = $('#main');
      if (target) {
        target.focus();
        target.scrollIntoView({ behavior: 'smooth' });
      }
    });
  }
  
  // Keyboard navigation for cards
  $$('.card').forEach(card => {
    const link = card.querySelector('a');
    if (link) {
      card.setAttribute('tabindex', '0');
      card.setAttribute('role', 'button');
      
      card.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          link.click();
        }
      });
    }
  });
  
  // Announce page changes to screen readers
  const announcer = document.createElement('div');
  announcer.setAttribute('aria-live', 'polite');
  announcer.setAttribute('aria-atomic', 'true');
  announcer.className = 'sr-only';
  document.body.appendChild(announcer);
  
  // Announce navigation changes
  $$('a[href^="#"]').forEach(link => {
    link.addEventListener('click', () => {
      const href = link.getAttribute('href');
      const target = $(href);
      if (target) {
        const heading = target.querySelector('h1, h2, h3, h4, h5, h6');
        if (heading) {
          announcer.textContent = `Navigiert zu: ${heading.textContent}`;
        }
      }
    });
  });
}

// Performance monitoring (optional)
function initPerformanceMonitoring() {
  if ('performance' in window && 'PerformanceObserver' in window) {
    // Monitor Core Web Vitals
    const observer = new PerformanceObserver((list) => {
      list.getEntries().forEach(entry => {
        if (entry.entryType === 'largest-contentful-paint') {
          console.log('LCP:', entry.startTime);
        }
        if (entry.entryType === 'first-input') {
          console.log('FID:', entry.processingStart - entry.startTime);
        }
        if (entry.entryType === 'layout-shift') {
          if (!entry.hadRecentInput) {
            console.log('CLS:', entry.value);
          }
        }
      });
    });
    
    observer.observe({ entryTypes: ['largest-contentful-paint', 'first-input', 'layout-shift'] });
  }
}

// Initialize performance monitoring in development
if (location.hostname === 'localhost' || location.hostname === '127.0.0.1') {
  initPerformanceMonitoring();
}

// Export for potential external use
window.PortfolioApp = {
  initYear,
  initNavigation,
  initScrollAnimations,
  initViewTransitions,
  initFormEnhancements,
  initAccessibility
};
