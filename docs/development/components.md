# Component Documentation

This document provides detailed information about the components available in the Modern SMF Theme.

## Table of Contents

1. [Layout Components](#layout-components)
2. [UI Components](#ui-components)
3. [Form Components](#form-components)
4. [Navigation Components](#navigation-components)
5. [Data Display Components](#data-display-components)
6. [Feedback Components](#feedback-components)
7. [Interactive Components](#interactive-components)
8. [User Components](#user-components)

## Layout Components

### Header
- Modern, responsive header with navigation
- Supports both desktop and mobile layouts
- Includes search, user menu, and notifications
- Dark/light mode toggle

### Footer
- Multi-column layout with responsive design
- Newsletter signup form
- Social media links
- Back to top button
- Copyright and legal links

### Sidebar
- Collapsible sidebar with smooth animations
- Mobile-friendly navigation
- User profile section
- Quick links and categories

## UI Components

### Buttons
```html
<button class="btn btn-primary">Primary Button</button>
<button class="btn btn-secondary">Secondary Button</button>
<button class="btn btn-outline">Outline Button</button>
```

Variants:
- Primary: `btn-primary`
- Secondary: `btn-secondary`
- Outline: `btn-outline`
- Ghost: `btn-ghost`
- Link: `btn-link`

Sizes:
- Small: `btn-sm`
- Regular: default
- Large: `btn-lg`

### Cards
```html
<div class="card">
    <div class="card-header">Header</div>
    <div class="card-body">Content</div>
    <div class="card-footer">Footer</div>
</div>
```

Variants:
- Default: `card`
- Elevated: `card card-elevated`
- Interactive: `card card-interactive`
- Bordered: `card card-bordered`

### Badges
```html
<span class="badge badge-primary">New</span>
<span class="badge badge-success">Completed</span>
<span class="badge badge-warning">Pending</span>
```

Variants:
- Status: `badge-status`
- Counter: `badge-counter`
- Notification: `badge-notification`
- Removable: `badge-removable`

### Tables
```html
<div class="table-container">
    <table class="table">
        <thead>...</thead>
        <tbody>...</tbody>
    </table>
</div>
```

Variants:
- Striped: `table-striped`
- Bordered: `table-bordered`
- Compact: `table-compact`
- Responsive: `table-responsive`

## Form Components

### Input Fields
```html
<div class="form-group">
    <label class="form-label">Username</label>
    <input type="text" class="form-input">
    <span class="form-hint">Enter your username</span>
</div>
```

Types:
- Text: `form-input`
- Textarea: `form-textarea`
- Select: `form-select`
- Checkbox: `form-checkbox`
- Radio: `form-radio`

### Form Validation
```html
<div class="form-group">
    <input type="email" class="form-input" required>
    <div class="form-error">Please enter a valid email</div>
</div>
```

States:
- Valid: `is-valid`
- Invalid: `is-invalid`
- Disabled: `disabled`
- Loading: `is-loading`

## Navigation Components

### Navbars
```html
<nav class="navbar">
    <div class="navbar-brand">Brand</div>
    <ul class="navbar-nav">
        <li class="nav-item active"><a class="nav-link" href="#">Link 1</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Link 2</a></li>
    </ul>
</nav>
```

Variants:
- Default: `navbar`
- Dark: `navbar-dark`
- Light: `navbar-light`
- Fixed: `navbar-fixed`

### Breadcrumbs
```html
<nav class="breadcrumbs" aria-label="Breadcrumb">
    <ol>
        <li><a href="/">Home</a></li>
        <li><a href="/category">Category</a></li>
        <li aria-current="page">Current Page</li>
    </ol>
</nav>
```

Features:
- Custom separators
- Responsive collapse
- Icon support
- Dropdown for collapsed items
- Screen reader support

## Data Display Components

### Lists
```html
<ul class="list">
    <li class="list-item">Item 1</li>
    <li class="list-item">Item 2</li>
</ul>
```

Variants:
- Ordered: `list-ordered`
- Unordered: `list-unordered`
- Description: `list-description`
- Icon: `list-icon`
- Divider: `list-divider`
- Action: `list-action`

Features:
- Custom markers
- Nested lists
- Icon alignment
- Interactive items
- Keyboard navigation

### Pagination
```html
<nav class="pagination" aria-label="Page navigation">
    <a class="pagination-prev" aria-label="Previous page">Previous</a>
    <ul class="pagination-list">
        <li><a class="pagination-item active" aria-current="page">1</a></li>
        <li><a class="pagination-item">2</a></li>
        <li><a class="pagination-item">3</a></li>
    </ul>
    <a class="pagination-next" aria-label="Next page">Next</a>
</nav>
```

Features:
- Responsive design
- Size variants (sm, md, lg)
- State indicators
- Custom separators
- Keyboard navigation
- Screen reader support

### Progress
```html
<div class="progress">
    <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
        75%
    </div>
</div>
```

Variants:
- Linear: `progress`
- Circular: `progress-circular`
- Steps: `progress-steps`
- Indeterminate: `progress-indeterminate`

Features:
- Color variants
- Size variants
- Animations
- Label placement
- Background patterns

### Tabs
```html
<div class="tabs">
    <div class="tabs-list" role="tablist">
        <button class="tab active" role="tab" aria-selected="true">Tab 1</button>
        <button class="tab" role="tab">Tab 2</button>
    </div>
    <div class="tab-panels">
        <div class="tab-panel active" role="tabpanel">Content 1</div>
        <div class="tab-panel" role="tabpanel">Content 2</div>
    </div>
</div>
```

Variants:
- Default: `tabs`
- Filled: `tabs-filled`
- Bordered: `tabs-bordered`
- Vertical: `tabs-vertical`

Features:
- Responsive design
- Keyboard navigation
- Content transitions
- Dynamic content loading
- Screen reader support

## Feedback Components

### Alerts
```html
<div class="alert alert-success">
    <div class="alert-icon">...</div>
    <div class="alert-content">
        <h4 class="alert-title">Success</h4>
        <p class="alert-message">Operation completed successfully</p>
    </div>
</div>
```

Types:
- Success: `alert-success`
- Info: `alert-info`
- Warning: `alert-warning`
- Error: `alert-error`

Features:
- Dismissible
- Icons
- Actions
- Auto-dismiss

### Toast Notifications
```html
<div class="toast">
    <div class="toast-content">Message sent successfully</div>
    <button class="toast-close">×</button>
</div>
```

Features:
- Auto-dismiss
- Stack multiple
- Position options
- Progress indicator

## Interactive Components

### Modals
```html
<div class="modal" id="myModal">
    <div class="modal-overlay"></div>
    <div class="modal-content">
        <div class="modal-header">...</div>
        <div class="modal-body">...</div>
        <div class="modal-footer">...</div>
    </div>
</div>
```

Features:
- Keyboard navigation (Esc to close)
- Focus trap
- Click outside to close
- Smooth animations

### Dropdowns
```html
<div class="dropdown">
    <button class="dropdown-toggle">Menu</button>
    <div class="dropdown-menu">
        <a class="dropdown-item">Item 1</a>
        <a class="dropdown-item">Item 2</a>
    </div>
</div>
```

Features:
- Position (top, right, bottom, left)
- Arrow indicators
- Nested dropdowns
- Custom triggers

### Tooltips
```html
<button class="tooltip" data-tooltip="Helpful information">
    Hover me
    <div class="tooltip-content">
        Detailed help text goes here
    </div>
</button>
```

Variants:
- Position: `tooltip-top`, `tooltip-right`, `tooltip-bottom`, `tooltip-left`
- Theme: `tooltip-light`, `tooltip-dark`
- Size: `tooltip-sm`, `tooltip-lg`
- Width: `tooltip-wide`, `tooltip-narrow`

Features:
- Arrow positioning
- Show/hide delay
- HTML content
- Interactive tooltips
- Keyboard triggers
- Screen reader support

## User Components

### Avatars
```html
<div class="avatar">
    <img src="user.jpg" alt="User Name">
    <span class="avatar-status online"></span>
</div>
```

Variants:
- Size: `avatar-sm`, `avatar-lg`
- Shape: `avatar-square`, `avatar-circle`
- Group: `avatar-group`
- Placeholder: `avatar-placeholder`

Features:
- Status indicators
- Loading states
- Fallback initials
- Group stacking
- Tooltips

## Best Practices

1. **Accessibility**
   - Use semantic HTML elements
   - Include ARIA labels where necessary
   - Ensure keyboard navigation
   - Maintain proper contrast ratios

2. **Performance**
   - Lazy load components when possible
   - Use CSS transitions instead of JavaScript animations
   - Minimize DOM manipulations
   - Optimize images and assets

3. **Responsiveness**
   - Test on multiple devices
   - Use mobile-first approach
   - Implement proper breakpoints
   - Consider touch interactions

4. **Maintainability**
   - Follow BEM naming convention
   - Keep components modular
   - Document component variations
   - Use CSS custom properties for theming

## Browser Support

- Chrome (last 2 versions)
- Firefox (last 2 versions)
- Safari (last 2 versions)
- Edge (last 2 versions)
- iOS Safari (last 2 versions)
- Android Chrome (last 2 versions)

## Contributing

When creating new components:

1. Follow the established naming conventions
2. Include documentation and examples
3. Add accessibility features
4. Test across browsers
5. Optimize for performance
6. Include dark mode support
