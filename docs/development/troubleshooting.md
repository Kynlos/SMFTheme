# Troubleshooting Guide

This guide helps you diagnose and resolve common issues with the Modern SMF Theme.

## Table of Contents

1. [Common Issues](#common-issues)
2. [Installation Problems](#installation-problems)
3. [Theme Customization](#theme-customization)
4. [JavaScript Issues](#javascript-issues)
5. [CSS Problems](#css-problems)
6. [Mobile Issues](#mobile-issues)
7. [Performance Issues](#performance-issues)
8. [Browser Compatibility](#browser-compatibility)

## Common Issues

### Theme Not Loading
1. Check file permissions
2. Verify theme is activated
3. Clear browser cache
4. Check console for errors
5. Verify file paths

### Layout Breaking
```css
/* Common fixes */
.container {
    width: 100%;
    max-width: var(--container-max-width);
    margin: 0 auto;
    padding: 0 var(--spacing-md);
    box-sizing: border-box;
}

.row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 calc(-1 * var(--spacing-sm));
}
```

### JavaScript Not Working
```javascript
// Debug JavaScript loading
document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM loaded');
    if (typeof Theme === 'undefined') {
        console.error('Theme object not loaded');
    }
});

// Check for script loading errors
window.addEventListener('error', (e) => {
    console.error('Script error:', e);
});
```

## Installation Problems

### Fresh Installation
1. Verify system requirements
2. Check file permissions
3. Clear cache directories
4. Verify database connection
5. Check error logs

### Upgrade Issues
1. Backup before upgrading
2. Follow version upgrade path
3. Clear all caches
4. Update dependencies
5. Run database updates

## Theme Customization

### Custom CSS Not Applied
```css
/* Check specificity */
.theme-custom .component {
    /* Your styles */
}

/* Use !important sparingly */
.theme-custom .override-component {
    color: var(--custom-color) !important;
}
```

### Variable Override Issues
```css
/* Root level variables */
:root {
    --primary-color: #007bff;
    --secondary-color: #6c757d;
}

/* Theme specific overrides */
.theme-custom {
    --primary-color: #0056b3;
}
```

## JavaScript Issues

### Event Handlers
```javascript
// Debug event handling
function debugEventHandler(event) {
    console.log('Event:', {
        type: event.type,
        target: event.target,
        currentTarget: event.currentTarget,
        bubbles: event.bubbles
    });
}

element.addEventListener('click', debugEventHandler);
```

### AJAX Issues
```javascript
// Debug AJAX requests
async function debugAjaxRequest(url, options = {}) {
    try {
        const response = await fetch(url, options);
        console.log('Response:', {
            status: response.status,
            headers: Object.fromEntries(response.headers),
            body: await response.clone().text()
        });
        return response;
    } catch (error) {
        console.error('AJAX Error:', error);
        throw error;
    }
}
```

## CSS Problems

### Responsive Issues
```css
/* Debug responsive layouts */
* {
    outline: 1px solid red;
}

/* Common breakpoint fixes */
@media (max-width: 768px) {
    .container {
        padding: 0 var(--spacing-sm);
    }
    
    .row {
        flex-direction: column;
    }
}
```

### Animation Issues
```css
/* Debug animations */
.debug-animation {
    animation-play-state: paused !important;
}

/* Performance optimizations */
.optimized-animation {
    transform: translateZ(0);
    will-change: transform;
}
```

## Mobile Issues

### Touch Events
```javascript
// Debug touch events
function debugTouchEvent(event) {
    console.log('Touch Event:', {
        type: event.type,
        touches: Array.from(event.touches).map(t => ({
            clientX: t.clientX,
            clientY: t.clientY
        }))
    });
}

element.addEventListener('touchstart', debugTouchEvent);
element.addEventListener('touchmove', debugTouchEvent);
element.addEventListener('touchend', debugTouchEvent);
```

### Viewport Issues
```html
<!-- Verify viewport meta -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Debug viewport size -->
<script>
window.addEventListener('resize', () => {
    console.log('Viewport:', {
        width: window.innerWidth,
        height: window.innerHeight,
        ratio: window.devicePixelRatio
    });
});
</script>
```

## Performance Issues

### Slow Loading
1. Check network requests
2. Optimize images
3. Minimize CSS/JS
4. Enable caching
5. Use lazy loading

### Memory Leaks
```javascript
// Debug memory usage
function debugMemory() {
    if (window.performance && window.performance.memory) {
        console.log('Memory:', {
            limit: performance.memory.jsHeapSizeLimit,
            total: performance.memory.totalJSHeapSize,
            used: performance.memory.usedJSHeapSize
        });
    }
}

// Check for event listener leaks
function debugEventListeners(element) {
    const listeners = getEventListeners(element);
    console.log('Event Listeners:', listeners);
}
```

## Browser Compatibility

### CSS Compatibility
```css
/* Add fallbacks for modern features */
.modern-layout {
    display: block; /* Fallback */
    display: grid;
    
    /* Fallback for grid */
    @supports not (display: grid) {
        display: flex;
        flex-wrap: wrap;
    }
}
```

### JavaScript Compatibility
```javascript
// Feature detection
const features = {
    grid: CSS.supports('display: grid'),
    flexbox: CSS.supports('display: flex'),
    customProperties: CSS.supports('--custom-property: value')
};

console.log('Browser Features:', features);

// Polyfill loading
function loadPolyfill(feature, url) {
    if (!features[feature]) {
        const script = document.createElement('script');
        script.src = url;
        document.head.appendChild(script);
    }
}
```

## Debugging Tools

### Console Commands
```javascript
// Debug theme state
window.debugTheme = {
    getState() {
        return {
            version: Theme.version,
            components: Theme.components,
            settings: Theme.settings
        };
    },
    
    toggleDebug() {
        document.body.classList.toggle('debug-mode');
    },
    
    logEvents() {
        const observer = new MutationObserver((mutations) => {
            mutations.forEach(mutation => {
                console.log('DOM Mutation:', mutation);
            });
        });
        
        observer.observe(document.body, {
            childList: true,
            subtree: true,
            attributes: true
        });
    }
};
```

### CSS Debug Helpers
```css
/* Debug layout issues */
.debug-layout {
    --outline-color: rgba(255, 0, 0, 0.2);
    
    * {
        outline: 1px solid var(--outline-color);
    }
    
    .container { --outline-color: rgba(0, 255, 0, 0.2); }
    .row { --outline-color: rgba(0, 0, 255, 0.2); }
}

/* Debug z-index stacking */
.debug-stack {
    * {
        background: rgba(255, 0, 0, 0.1);
    }
}
```

## Support Resources

### Getting Help
1. Check documentation
2. Search forums
3. Review issues
4. Contact support
5. Community help

### Reporting Issues
1. Reproduce the issue
2. Gather information
3. Check existing issues
4. Create detailed report
5. Provide examples

### Contributing Solutions
1. Fork repository
2. Create fix branch
3. Add test cases
4. Submit pull request
5. Update documentation
