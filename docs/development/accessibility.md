# Accessibility Guidelines

This document outlines the accessibility standards and best practices implemented in the Modern SMF Theme.

## Table of Contents

1. [Core Principles](#core-principles)
2. [Semantic HTML](#semantic-html)
3. [ARIA Implementation](#aria-implementation)
4. [Keyboard Navigation](#keyboard-navigation)
5. [Color and Contrast](#color-and-contrast)
6. [Focus Management](#focus-management)
7. [Screen Readers](#screen-readers)
8. [Testing](#testing)

## Core Principles

Our theme follows the WCAG 2.1 Level AA guidelines and implements the following core principles:

1. **Perceivable**: Information must be presentable in ways all users can perceive
2. **Operable**: Interface components must be operable by all users
3. **Understandable**: Information and operation must be understandable
4. **Robust**: Content must be robust enough to work with various assistive technologies

## Semantic HTML

### Document Structure
```html
<header role="banner">
    <!-- Main navigation -->
    <nav role="navigation" aria-label="Main navigation">
        <!-- Navigation items -->
    </nav>
</header>

<main role="main">
    <!-- Main content -->
</main>

<footer role="contentinfo">
    <!-- Footer content -->
</footer>
```

### Content Organization
- Use proper heading hierarchy (h1-h6)
- Implement landmarks appropriately
- Structure content with semantic elements like `<article>`, `<section>`, `<aside>`

## ARIA Implementation

### Interactive Elements
```html
<!-- Buttons -->
<button aria-label="Close dialog" aria-pressed="false">
    <span class="icon-close" aria-hidden="true"></span>
</button>

<!-- Expandable sections -->
<button aria-expanded="false" aria-controls="section1">
    Toggle Section
</button>
<div id="section1" aria-hidden="true">
    <!-- Section content -->
</div>
```

### Common ARIA Roles
- `role="alert"`: For important messages
- `role="dialog"`: Modal windows
- `role="tablist"`, `role="tab"`, `role="tabpanel"`: Tab interfaces
- `role="tooltip"`: Tooltips
- `role="status"`: Status messages

## Keyboard Navigation

### Focus Management
```javascript
// Trap focus in modal
function trapFocus(element) {
    const focusableElements = element.querySelectorAll(
        'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
    );
    const firstFocusable = focusableElements[0];
    const lastFocusable = focusableElements[focusableElements.length - 1];

    element.addEventListener('keydown', function(e) {
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
}
```

### Keyboard Shortcuts
- `Esc`: Close modals, dropdowns
- `Enter`/`Space`: Activate buttons
- `Tab`: Navigate through focusable elements
- `Arrow keys`: Navigate within components (e.g., menus)

## Color and Contrast

### Contrast Ratios
- Normal text: minimum 4.5:1
- Large text: minimum 3:1
- UI components and graphics: minimum 3:1

### Implementation
```css
:root {
    /* High contrast colors */
    --text-primary: #1a1a1a;
    --text-secondary: #4a4a4a;
    --background-primary: #ffffff;
    --background-secondary: #f5f5f5;
    
    /* Focus indicators */
    --focus-ring-color: #2563eb;
    --focus-ring-width: 3px;
}

/* Visible focus indicators */
:focus-visible {
    outline: var(--focus-ring-width) solid var(--focus-ring-color);
    outline-offset: 2px;
}
```

## Focus Management

### Focus Indicators
```css
/* Custom focus styles */
.custom-focus:focus-visible {
    outline: none;
    box-shadow: 0 0 0 3px var(--focus-ring-color);
}

/* Skip to main content link */
.skip-link {
    position: absolute;
    top: -40px;
    left: 0;
    padding: 8px;
    z-index: 100;
}

.skip-link:focus {
    top: 0;
}
```

### Focus Order
- Logical tab order following visual layout
- Skip links for navigation
- Focus trap in modals
- Return focus after modal close

## Screen Readers

### Text Alternatives
```html
<!-- Images -->
<img src="logo.png" alt="Company Logo">

<!-- Icons -->
<span class="icon-search" aria-hidden="true"></span>
<span class="sr-only">Search</span>

<!-- Complex images -->
<figure>
    <img src="chart.png" alt="Sales chart for Q1 2023">
    <figcaption>Quarterly sales showing 15% growth</figcaption>
</figure>
```

### Screen Reader Only Content
```css
.sr-only {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border: 0;
}
```

## Testing

### Automated Testing
- Use tools like WAVE, aXe, or Lighthouse
- Implement automated accessibility tests in CI/CD pipeline
- Regular audits of WCAG compliance

### Manual Testing
1. **Keyboard Navigation**
   - Tab through all interactive elements
   - Verify focus indicators
   - Test keyboard shortcuts

2. **Screen Reader Testing**
   - Test with NVDA and VoiceOver
   - Verify announcement of dynamic content
   - Check heading structure

3. **Visual Testing**
   - Test color contrast
   - Verify text scaling
   - Check responsive layout

### Testing Checklist

- [ ] All images have meaningful alt text
- [ ] Proper heading hierarchy
- [ ] ARIA landmarks implemented correctly
- [ ] Keyboard navigation works as expected
- [ ] Focus management is implemented
- [ ] Color contrast meets WCAG requirements
- [ ] Dynamic content is announced to screen readers
- [ ] Forms have proper labels and error handling
- [ ] Skip links are implemented
- [ ] Modal dialogs trap focus correctly

## Resources

1. [WCAG 2.1 Guidelines](https://www.w3.org/WAI/WCAG21/quickref/)
2. [WAI-ARIA Practices](https://www.w3.org/WAI/ARIA/apg/)
3. [A11Y Project Checklist](https://www.a11yproject.com/checklist/)
4. [MDN Accessibility Guide](https://developer.mozilla.org/en-US/docs/Web/Accessibility)

## Contributing

When implementing new features or components:

1. Follow WCAG 2.1 Level AA guidelines
2. Test with keyboard navigation
3. Provide appropriate ARIA attributes
4. Ensure proper color contrast
5. Test with screen readers
6. Document accessibility features
