# JavaScript Documentation

This document outlines the JavaScript architecture and utilities available in the Modern SMF Theme.

## Table of Contents

1. [Core Files](#core-files)
2. [Theme Management](#theme-management)
3. [Forum Functionality](#forum-functionality)
4. [Animations](#animations)
5. [Utilities](#utilities)
6. [Form Validation](#form-validation)
7. [Accessibility Helpers](#accessibility-helpers)
8. [Event Handling](#event-handling)
9. [Best Practices](#best-practices)

## Core Files

### File Structure
```
js/
├── theme.js       # Theme management and core UI interactions
├── forum.js       # Forum-specific functionality
├── animations.js  # Animation utilities and transitions
└── utils.js       # General utility functions
```

## Theme Management

### Theme Switching
```javascript
// theme.js
const themeManager = {
    init() {
        this.themeToggle = document.querySelector('#theme-toggle');
        this.currentTheme = localStorage.getItem('theme') || 'light';
        this.applyTheme(this.currentTheme);
        this.bindEvents();
    },

    bindEvents() {
        this.themeToggle.addEventListener('click', () => {
            const newTheme = this.currentTheme === 'light' ? 'dark' : 'light';
            this.applyTheme(newTheme);
        });
    },

    applyTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
        this.currentTheme = theme;
    }
};
```

### Sidebar Management
```javascript
const sidebarManager = {
    init() {
        this.sidebar = document.querySelector('.sidebar');
        this.toggleBtn = document.querySelector('.sidebar-toggle');
        this.bindEvents();
    },

    bindEvents() {
        this.toggleBtn.addEventListener('click', () => {
            this.sidebar.classList.toggle('collapsed');
            this.updateAriaStates();
        });
    },

    updateAriaStates() {
        const isCollapsed = this.sidebar.classList.contains('collapsed');
        this.toggleBtn.setAttribute('aria-expanded', !isCollapsed);
        this.sidebar.setAttribute('aria-hidden', isCollapsed);
    }
};
```

## Forum Functionality

### Topic Preview
```javascript
// forum.js
const topicPreview = {
    init() {
        this.previewLinks = document.querySelectorAll('.topic-preview-link');
        this.bindEvents();
    },

    bindEvents() {
        this.previewLinks.forEach(link => {
            link.addEventListener('mouseenter', this.showPreview.bind(this));
            link.addEventListener('mouseleave', this.hidePreview.bind(this));
        });
    },

    async showPreview(event) {
        const topicId = event.target.dataset.topicId;
        const preview = await this.fetchTopicPreview(topicId);
        this.renderPreview(preview, event.target);
    },

    async fetchTopicPreview(topicId) {
        const response = await fetch(`/api/topic/${topicId}/preview`);
        return response.json();
    }
};
```

### Quick Reply
```javascript
const quickReply = {
    init() {
        this.form = document.querySelector('.quick-reply-form');
        this.editor = this.form.querySelector('.editor');
        this.bindEvents();
    },

    bindEvents() {
        this.form.addEventListener('submit', this.handleSubmit.bind(this));
    },

    async handleSubmit(event) {
        event.preventDefault();
        const formData = new FormData(this.form);
        await this.submitReply(formData);
    },

    async submitReply(formData) {
        try {
            const response = await fetch('/api/reply', {
                method: 'POST',
                body: formData
            });
            if (response.ok) {
                this.handleSuccess();
            }
        } catch (error) {
            this.handleError(error);
        }
    }
};
```

## Animations

### Page Transitions
```javascript
// animations.js
const pageTransitions = {
    init() {
        this.setupTransitionListeners();
    },

    setupTransitionListeners() {
        document.addEventListener('beforeunload', () => {
            document.body.classList.add('page-exit');
        });

        document.addEventListener('DOMContentLoaded', () => {
            document.body.classList.add('page-enter');
        });
    },

    async transitionTo(url) {
        document.body.classList.add('page-exit');
        await this.animationComplete();
        window.location.href = url;
    }
};
```

### Scroll Effects
```javascript
const scrollEffects = {
    init() {
        this.setupIntersectionObserver();
        this.setupScrollListeners();
    },

    setupIntersectionObserver() {
        const options = {
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, options);

        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });
    }
};
```

## Utilities

### DOM Manipulation
```javascript
// utils.js
const dom = {
    createElement(tag, attrs = {}, children = []) {
        const element = document.createElement(tag);
        Object.entries(attrs).forEach(([key, value]) => {
            if (key === 'class') {
                element.classList.add(...value.split(' '));
            } else {
                element.setAttribute(key, value);
            }
        });
        children.forEach(child => {
            if (typeof child === 'string') {
                element.appendChild(document.createTextNode(child));
            } else {
                element.appendChild(child);
            }
        });
        return element;
    },

    query(selector, context = document) {
        const element = context.querySelector(selector);
        if (!element) {
            console.warn(`Element not found: ${selector}`);
        }
        return element;
    },

    batchUpdate(elements, updateFn) {
        const fragment = document.createDocumentFragment();
        elements.forEach(el => {
            const clone = el.cloneNode(true);
            updateFn(clone);
            fragment.appendChild(clone);
        });
        elements[0].parentNode.replaceChildren(fragment);
    }
};

### Event Handling
```javascript
const events = {
    debounce(fn, delay) {
        let timeoutId;
        return (...args) => {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => fn(...args), delay);
        };
    },

    throttle(fn, limit) {
        let inThrottle;
        return (...args) => {
            if (!inThrottle) {
                fn(...args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    },

    delegate(element, eventType, selector, handler) {
        element.addEventListener(eventType, event => {
            const target = event.target.closest(selector);
            if (target) {
                handler.call(target, event);
            }
        });
    }
};
```

## Form Validation

### Input Validation
```javascript
const validation = {
    patterns: {
        email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        url: /^https?:\/\/[\w\-]+(\.[\w\-]+)+[/#?]?.*$/,
        username: /^[a-zA-Z0-9_]{3,20}$/
    },

    validateInput(input) {
        const value = input.value.trim();
        const type = input.dataset.validate;
        const pattern = this.patterns[type];

        if (pattern && !pattern.test(value)) {
            this.showError(input, `Invalid ${type} format`);
            return false;
        }

        if (input.required && !value) {
            this.showError(input, 'This field is required');
            return false;
        }

        this.clearError(input);
        return true;
    },

    showError(input, message) {
        const container = input.closest('.form-group');
        const error = container.querySelector('.form-error') || 
                     dom.createElement('div', { class: 'form-error' });
        error.textContent = message;
        container.appendChild(error);
        input.setAttribute('aria-invalid', 'true');
    },

    clearError(input) {
        const container = input.closest('.form-group');
        const error = container.querySelector('.form-error');
        if (error) {
            error.remove();
        }
        input.removeAttribute('aria-invalid');
    }
};
```

### Form Submission
```javascript
const formHandler = {
    async submitForm(form) {
        const data = new FormData(form);
        const isValid = Array.from(form.elements)
            .every(input => !input.dataset.validate || validation.validateInput(input));

        if (!isValid) {
            return false;
        }

        try {
            const response = await fetch(form.action, {
                method: form.method,
                body: data,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            return await response.json();
        } catch (error) {
            console.error('Form submission error:', error);
            return false;
        }
    }
};
```

## Accessibility Helpers

### Focus Management
```javascript
const focus = {
    trapFocus(element) {
        const focusableElements = element.querySelectorAll(
            'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
        );
        const firstFocusable = focusableElements[0];
        const lastFocusable = focusableElements[focusableElements.length - 1];

        element.addEventListener('keydown', e => {
            if (e.key === 'Tab') {
                if (e.shiftKey) {
                    if (document.activeElement === firstFocusable) {
                        lastFocusable.focus();
                        e.preventDefault();
                    }
                } else {
                    if (document.activeElement === lastFocusable) {
                        firstFocusable.focus();
                        e.preventDefault();
                    }
                }
            }
        });
    },

    manageFocus(trigger, container) {
        const previousFocus = document.activeElement;
        
        this.trapFocus(container);
        
        return () => {
            previousFocus.focus();
        };
    }
};
```

### ARIA Updates
```javascript
const aria = {
    announce(message, priority = 'polite') {
        const region = document.querySelector(`[aria-live="${priority}"]`) ||
                      dom.createElement('div', {
                          'aria-live': priority,
                          'class': 'sr-only'
                      });
        
        if (!region.parentElement) {
            document.body.appendChild(region);
        }

        region.textContent = message;
    },

    toggleExpanded(trigger, target) {
        const isExpanded = trigger.getAttribute('aria-expanded') === 'true';
        trigger.setAttribute('aria-expanded', !isExpanded);
        target.setAttribute('aria-hidden', isExpanded);
    },

    setLoading(element, isLoading) {
        element.setAttribute('aria-busy', isLoading);
        if (isLoading) {
            const loadingText = element.dataset.loadingText || 'Loading...';
            element.setAttribute('aria-label', loadingText);
        } else {
            element.removeAttribute('aria-label');
        }
    }
};
```

## Event Handling

### Event Delegation
```javascript
document.querySelector('.topic-list').addEventListener('click', (event) => {
    if (event.target.matches('.topic-link')) {
        handleTopicClick(event);
    }
});
```

### Resource Loading
```javascript
const lazyLoad = {
    init() {
        if ('loading' in HTMLImageElement.prototype) {
            document.querySelectorAll('img[loading="lazy"]').forEach(img => {
                img.src = img.dataset.src;
            });
        } else {
            // Fallback to Intersection Observer
            this.lazyLoadImages();
        }
    }
};
```

### Memory Management
```javascript
class ComponentBase {
    constructor() {
        this.boundHandlers = new Map();
    }

    addListener(element, event, handler) {
        const boundHandler = handler.bind(this);
        this.boundHandlers.set(handler, boundHandler);
        element.addEventListener(event, boundHandler);
    }

    removeListener(element, event, handler) {
        const boundHandler = this.boundHandlers.get(handler);
        if (boundHandler) {
            element.removeEventListener(event, boundHandler);
            this.boundHandlers.delete(handler);
        }
    }

    destroy() {
        this.boundHandlers.clear();
    }
}
```

## Best Practices

### Performance Optimization
1. **Event Delegation**
```javascript
document.querySelector('.topic-list').addEventListener('click', (event) => {
    if (event.target.matches('.topic-link')) {
        handleTopicClick(event);
    }
});
```

2. **Resource Loading**
```javascript
const lazyLoad = {
    init() {
        if ('loading' in HTMLImageElement.prototype) {
            document.querySelectorAll('img[loading="lazy"]').forEach(img => {
                img.src = img.dataset.src;
            });
        } else {
            // Fallback to Intersection Observer
            this.lazyLoadImages();
        }
    }
};
```

3. **Memory Management**
```javascript
class ComponentBase {
    constructor() {
        this.boundHandlers = new Map();
    }

    addListener(element, event, handler) {
        const boundHandler = handler.bind(this);
        this.boundHandlers.set(handler, boundHandler);
        element.addEventListener(event, boundHandler);
    }

    removeListener(element, event, handler) {
        const boundHandler = this.boundHandlers.get(handler);
        if (boundHandler) {
            element.removeEventListener(event, boundHandler);
            this.boundHandlers.delete(handler);
        }
    }

    destroy() {
        this.boundHandlers.clear();
    }
}
```

### Error Handling
```javascript
const errorHandler = {
    handleError(error, context = '') {
        console.error(`Error in ${context}:`, error);
        
        if (error.response) {
            // Handle API errors
            this.handleApiError(error.response);
        } else if (error instanceof TypeError) {
            // Handle type errors
            this.handleTypeError(error);
        } else {
            // Handle general errors
            this.showErrorMessage('An unexpected error occurred');
        }
    },

    showErrorMessage(message) {
        const toast = document.createElement('div');
        toast.className = 'toast toast-error';
        toast.textContent = message;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.remove();
        }, 5000);
    }
};
```

## Contributing

When adding new JavaScript functionality:

1. Follow the established code structure
2. Use ES6+ features appropriately
3. Add proper error handling
4. Include documentation
5. Optimize for performance
6. Add accessibility features
