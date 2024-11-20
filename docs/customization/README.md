# Customization Guide

This guide explains how to customize the Modern 2024 SMF Theme to match your forum's unique style and requirements.

## Table of Contents

1. [Color Schemes](#color-schemes)
2. [Typography](#typography)
3. [Layout Customization](#layout-customization)
4. [Component Styling](#component-styling)
5. [Template Customization](#template-customization)
6. [Mobile Customization](#mobile-customization)
7. [Advanced Customization](#advanced-customization)

## Color Schemes

### Theme Settings

The theme includes comprehensive color scheme settings in `theme_settings.php`:

1. **Predefined Schemes**
   - Light (Default)
   - Dark
   - Auto (System preference)

2. **Custom Colors**
   - Primary colors
   - Background colors
   - Text colors
   - Status colors

### CSS Variables

Customize colors using CSS variables in your custom CSS:

```css
:root {
    /* Brand Colors */
    --primary-color: #your-color;
    --secondary-color: #your-color;
    --accent-color: #your-color;

    /* Background Colors */
    --bg-primary: #your-color;
    --bg-secondary: #your-color;

    /* Text Colors */
    --text-primary: #your-color;
    --text-secondary: #your-color;

    /* Status Colors */
    --success-color: #your-color;
    --warning-color: #your-color;
    --error-color: #your-color;
}
```

## Typography

### Font Settings

Configure fonts through theme settings:

1. **Font Families**
   - Primary: Inter (Default)
   - Secondary: Your choice of:
     - Roboto
     - Open Sans
     - Custom font

2. **Text Properties**
   - Font sizes
   - Line heights
   - Font weights

### Custom Fonts

Add custom fonts to your theme:

```css
@font-face {
    font-family: 'YourCustomFont';
    src: url('../fonts/your-font.woff2') format('woff2');
}

:root {
    --font-primary: 'YourCustomFont', sans-serif;
}
```

## Layout Customization

### Layout Options

Configure layout through theme settings:

1. **Layout Style**
   - Wide (Default)
   - Boxed

2. **Sidebar Position**
   - Left
   - Right

3. **Header Options**
   - Sticky header
   - Custom logo
   - Navigation style

### Component Layout

Customize individual components:

1. **Board Index**
   - Category layout
   - Board display style
   - Statistics placement

2. **Message Display**
   - Post layout
   - Avatar position
   - Signature placement

3. **Profile Pages**
   - Info layout
   - Tab arrangement
   - Custom sections

## Component Styling

### Available Components

The theme includes styled components for:

1. **Navigation**
   - Main menu
   - User menu
   - Breadcrumbs

2. **Content**
   - Posts
   - Topics
   - Categories
   - Boards

3. **Interactive Elements**
   - Buttons
   - Forms
   - Dropdowns
   - Modals

4. **Utility Components**
   - Alerts
   - Badges
   - Progress bars
   - Tooltips

## Template Customization

### Template Files

Customize these template files for specific functionality:

1. **Core Templates**
   - `index.template.php` - Main structure
   - `header.template.php` - Navigation
   - `footer.template.php` - Footer content

2. **Content Templates**
   - `boardindex.template.php` - Forum listing
   - `display.template.php` - Topic display
   - `messageindex.template.php` - Topic listing

3. **Feature Templates**
   - `search.template.php` - Search functionality
   - `calendar.template.php` - Calendar views
   - `stats.template.php` - Statistics display
   - `help.template.php` - Help system
   - `moderate.template.php` - Moderation tools

4. **User Templates**
   - `profile.template.php` - User profiles
   - `admin.template.php` - Admin panel

### Template Modifications

To modify templates:

1. Create a copy of the template file
2. Make your changes
3. Update theme settings to use your modified template

## Mobile Customization

### Mobile Features

The theme includes mobile-specific features:

1. **Responsive Design**
   - Fluid layouts
   - Breakpoint handling
   - Touch-friendly controls

2. **Mobile Menu**
   - Drawer navigation
   - Quick access buttons
   - Gesture support

3. **Content Adaptation**
   - Optimized images
   - Simplified layouts
   - Touch-friendly forms

### Mobile Settings

Configure mobile behavior:

```css
/* Breakpoints */
--breakpoint-sm: 576px;
--breakpoint-md: 768px;
--breakpoint-lg: 992px;
--breakpoint-xl: 1200px;

/* Mobile Menu */
--mobile-menu-width: 280px;
--mobile-header-height: 60px;
```

## Advanced Customization

### Custom CSS

Add custom styles in theme settings:

1. Navigate to Theme Settings → Custom CSS
2. Add your styles:
```css
/* Custom styles */
.your-class {
    property: value;
}
```

### JavaScript Customization

Add custom JavaScript:

1. Navigate to Theme Settings → Custom JavaScript
2. Add your code:
```javascript
// Custom functionality
document.addEventListener('DOMContentLoaded', () => {
    // Your code here
});
```

### Development Tools

Use these tools for development:

1. **Browser Tools**
   - Inspector
   - Console
   - Network monitor

2. **Theme Development**
   - CSS preprocessors
   - JavaScript bundlers
   - Version control

## Troubleshooting

### Common Issues

1. **Style Issues**
   - Clear cache
   - Check CSS specificity
   - Verify file paths

2. **Layout Problems**
   - Check responsive breakpoints
   - Verify template modifications
   - Validate HTML structure

3. **JavaScript Issues**
   - Check console for errors
   - Verify dependencies
   - Test browser compatibility
