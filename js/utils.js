// Utility Functions for Modern SMF Theme

const utils = {
    // DOM Manipulation
    createElement(tag, attributes = {}, children = []) {
        const element = document.createElement(tag);
        Object.entries(attributes).forEach(([key, value]) => {
            if (key === 'class') {
                element.className = value;
            } else if (key === 'dataset') {
                Object.entries(value).forEach(([dataKey, dataValue]) => {
                    element.dataset[dataKey] = dataValue;
                });
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

    // Event Handling
    delegate(element, eventType, selector, handler) {
        element.addEventListener(eventType, event => {
            const target = event.target.closest(selector);
            if (target && element.contains(target)) {
                handler.call(target, event);
            }
        });
    },

    // Debounce Function
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    },

    // Throttle Function
    throttle(func, limit) {
        let inThrottle;
        return function executedFunction(...args) {
            if (!inThrottle) {
                func(...args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    },

    // Local Storage Wrapper
    storage: {
        get(key, defaultValue = null) {
            try {
                const item = localStorage.getItem(key);
                return item ? JSON.parse(item) : defaultValue;
            } catch (error) {
                console.error('Error reading from localStorage:', error);
                return defaultValue;
            }
        },

        set(key, value) {
            try {
                localStorage.setItem(key, JSON.stringify(value));
                return true;
            } catch (error) {
                console.error('Error writing to localStorage:', error);
                return false;
            }
        },

        remove(key) {
            try {
                localStorage.removeItem(key);
                return true;
            } catch (error) {
                console.error('Error removing from localStorage:', error);
                return false;
            }
        }
    },

    // Cookie Handling
    cookies: {
        get(name) {
            const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
            return match ? decodeURIComponent(match[2]) : null;
        },

        set(name, value, days = 7) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            document.cookie = `${name}=${encodeURIComponent(value)};expires=${date.toUTCString()};path=/`;
        },

        remove(name) {
            this.set(name, '', -1);
        }
    },

    // Form Validation
    form: {
        validate(form) {
            const errors = [];
            const required = form.querySelectorAll('[required]');
            const email = form.querySelectorAll('[type="email"]');
            
            required.forEach(field => {
                if (!field.value.trim()) {
                    errors.push({
                        field: field,
                        message: 'This field is required'
                    });
                }
            });

            email.forEach(field => {
                if (field.value && !this.isValidEmail(field.value)) {
                    errors.push({
                        field: field,
                        message: 'Please enter a valid email address'
                    });
                }
            });

            return errors;
        },

        isValidEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        },

        serializeForm(form) {
            const formData = new FormData(form);
            const data = {};
            for (let [key, value] of formData.entries()) {
                data[key] = value;
            }
            return data;
        }
    },

    // URL and Query String Handling
    url: {
        getQueryParams() {
            const params = {};
            new URLSearchParams(window.location.search).forEach((value, key) => {
                params[key] = value;
            });
            return params;
        },

        updateQueryParam(key, value) {
            const params = new URLSearchParams(window.location.search);
            params.set(key, value);
            window.history.replaceState({}, '', `${window.location.pathname}?${params}`);
        },

        removeQueryParam(key) {
            const params = new URLSearchParams(window.location.search);
            params.delete(key);
            window.history.replaceState({}, '', `${window.location.pathname}?${params}`);
        }
    },

    // Date Formatting
    date: {
        format(date, format = 'YYYY-MM-DD') {
            const d = new Date(date);
            const year = d.getFullYear();
            const month = String(d.getMonth() + 1).padStart(2, '0');
            const day = String(d.getDate()).padStart(2, '0');
            const hours = String(d.getHours()).padStart(2, '0');
            const minutes = String(d.getMinutes()).padStart(2, '0');

            return format
                .replace('YYYY', year)
                .replace('MM', month)
                .replace('DD', day)
                .replace('HH', hours)
                .replace('mm', minutes);
        },

        timeAgo(date) {
            const seconds = Math.floor((new Date() - new Date(date)) / 1000);
            const intervals = {
                year: 31536000,
                month: 2592000,
                week: 604800,
                day: 86400,
                hour: 3600,
                minute: 60
            };

            for (let [unit, secondsInUnit] of Object.entries(intervals)) {
                const interval = Math.floor(seconds / secondsInUnit);
                if (interval >= 1) {
                    return `${interval} ${unit}${interval === 1 ? '' : 's'} ago`;
                }
            }
            return 'just now';
        }
    },

    // String Manipulation
    string: {
        truncate(str, length = 100, ending = '...') {
            if (str.length > length) {
                return str.substring(0, length - ending.length) + ending;
            }
            return str;
        },

        slugify(str) {
            return str
                .toLowerCase()
                .replace(/[^\w\s-]/g, '')
                .replace(/\s+/g, '-');
        },

        escapeHTML(str) {
            const div = document.createElement('div');
            div.textContent = str;
            return div.innerHTML;
        }
    },

    // Array and Object Manipulation
    array: {
        chunk(arr, size) {
            return Array.from({ length: Math.ceil(arr.length / size) }, (_, i) =>
                arr.slice(i * size, i * size + size)
            );
        },

        shuffle(arr) {
            return [...arr].sort(() => Math.random() - 0.5);
        },

        unique(arr) {
            return [...new Set(arr)];
        }
    },

    // Device and Browser Detection
    device: {
        isMobile() {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        },

        isTablet() {
            return /(tablet|ipad|playbook|silk)|(android(?!.*mobile))/i.test(navigator.userAgent);
        },

        isDesktop() {
            return !this.isMobile() && !this.isTablet();
        },

        getBrowser() {
            const ua = navigator.userAgent;
            let browser = "unknown";

            if (ua.includes("Firefox/")) browser = "firefox";
            else if (ua.includes("Chrome/")) browser = "chrome";
            else if (ua.includes("Safari/")) browser = "safari";
            else if (ua.includes("Edge/")) browser = "edge";
            else if (ua.includes("MSIE ") || ua.includes("Trident/")) browser = "ie";

            return browser;
        }
    },

    // Accessibility Helpers
    a11y: {
        handleEscapeKey(callback) {
            document.addEventListener('keydown', event => {
                if (event.key === 'Escape') callback(event);
            });
        },

        trapFocus(element) {
            const focusableElements = element.querySelectorAll(
                'a[href], button, textarea, input[type="text"], input[type="radio"], input[type="checkbox"], select'
            );
            const firstFocusable = focusableElements[0];
            const lastFocusable = focusableElements[focusableElements.length - 1];

            element.addEventListener('keydown', event => {
                if (event.key !== 'Tab') return;

                if (event.shiftKey) {
                    if (document.activeElement === firstFocusable) {
                        lastFocusable.focus();
                        event.preventDefault();
                    }
                } else {
                    if (document.activeElement === lastFocusable) {
                        firstFocusable.focus();
                        event.preventDefault();
                    }
                }
            });
        },

        announceMessage(message) {
            const announcer = document.getElementById('a11y-announcer') ||
                utils.createElement('div', {
                    id: 'a11y-announcer',
                    class: 'sr-only',
                    'aria-live': 'polite',
                    'aria-atomic': 'true'
                });
            
            if (!document.getElementById('a11y-announcer')) {
                document.body.appendChild(announcer);
            }
            
            announcer.textContent = message;
        }
    }
};

// Export utils object
window.utils = utils;
