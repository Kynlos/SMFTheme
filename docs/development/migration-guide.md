# Migration Guide

This guide helps you migrate from previous versions of the Modern SMF Theme to the latest version.

## Table of Contents

1. [Version History](#version-history)
2. [Breaking Changes](#breaking-changes)
3. [Deprecated Features](#deprecated-features)
4. [New Features](#new-features)
5. [Migration Steps](#migration-steps)
6. [Troubleshooting](#troubleshooting)

## Version History

### Latest Version (2.0.0)
- Complete redesign with modern components
- Enhanced accessibility features
- Improved performance optimizations
- New JavaScript utilities
- Mobile-first responsive design

### Previous Version (1.x)
- Basic theme functionality
- Limited component library
- Basic responsive design
- Simple JavaScript utilities

## Breaking Changes

### CSS Changes

#### Class Name Changes
```css
/* Old */
.theme-button {}
.theme-input {}
.theme-card {}

/* New */
.btn {}
.form-control {}
.card {}
```

#### Removed Classes
The following classes have been removed:
- `.theme-container`
- `.theme-header`
- `.theme-footer`
- `.theme-sidebar`

#### Modified Classes
Classes with modified behavior:
- `.nav` - Now requires `.nav-list` wrapper
- `.card` - New structure with header and body
- `.btn` - New variants and states

### JavaScript Changes

#### API Changes
```javascript
// Old
Theme.init();
Theme.toggleMenu();
Theme.showModal();

// New
import { init, toggleMenu, showModal } from './theme';
init();
toggleMenu();
showModal();
```

#### Event Changes
- Renamed events to follow a consistent pattern
- Added new custom events for components
- Modified event data structure

## Deprecated Features

### Deprecated in 2.0.0
1. `Theme` global object
2. Legacy color variables
3. Old grid system
4. jQuery dependency
5. IE11 support

### Removal Timeline
- 2.0.0: Features marked as deprecated
- 2.1.0: Warning messages for deprecated features
- 3.0.0: Complete removal of deprecated features

## New Features

### Components
1. Modern component library
   - Lists
   - Pagination
   - Breadcrumbs
   - Tabs
   - Avatars
   - Progress bars
   - Tooltips

### Utilities
1. JavaScript utilities
   - DOM manipulation
   - Event handling
   - Form validation
   - Accessibility helpers

### Styling
1. CSS improvements
   - CSS variables
   - Modern layout system
   - Enhanced animations
   - Dark mode support

## Migration Steps

### Step 1: Update Dependencies
```json
{
    "dependencies": {
        "modern-smf-theme": "^2.0.0"
    }
}
```

### Step 2: Update HTML Structure
```html
<!-- Old structure -->
<div class="theme-container">
    <div class="theme-header">...</div>
    <div class="theme-content">...</div>
    <div class="theme-footer">...</div>
</div>

<!-- New structure -->
<div class="container">
    <header class="header">...</header>
    <main class="main">...</main>
    <footer class="footer">...</footer>
</div>
```

### Step 3: Update CSS
1. Replace old class names
2. Update color variables
3. Implement new grid system
4. Add responsive utilities

### Step 4: Update JavaScript
1. Remove jQuery dependency
2. Update event handlers
3. Implement new utilities
4. Add accessibility features

### Step 5: Testing
1. Visual regression testing
2. Functionality testing
3. Accessibility testing
4. Performance testing
5. Cross-browser testing

## Troubleshooting

### Common Issues

#### Layout Issues
```css
/* Fix for layout breaking after migration */
.container {
    width: 100%;
    max-width: var(--container-max-width);
    margin: 0 auto;
    padding: 0 var(--spacing-md);
}
```

#### JavaScript Errors
```javascript
// Fix for undefined Theme object
if (typeof Theme !== 'undefined') {
    // Legacy code
    Theme.init();
} else {
    // New code
    import { init } from './theme';
    init();
}
```

#### Style Conflicts
1. Check for duplicate class names
2. Verify CSS specificity
3. Review media queries
4. Check CSS variable scope

### Support

If you encounter issues during migration:

1. Check the documentation
2. Review the changelog
3. Search existing issues
4. Create a new issue
5. Contact support

## Resources

### Documentation
1. [Theme Documentation](./README.md)
2. [Component Guide](./components.md)
3. [API Reference](./api.md)
4. [Examples](./examples.md)

### Tools
1. Migration scripts
2. Testing utilities
3. Debug tools
4. Style guides

## Contributing

When contributing during the migration period:

1. Follow the new coding standards
2. Update documentation
3. Add migration notes
4. Test thoroughly
5. Review changes
