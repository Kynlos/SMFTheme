# Development Guide

This guide provides detailed information for developers who want to modify, extend, or contribute to the Modern 2024 SMF Theme.

## Table of Contents

1. [Development Environment](#development-environment)
2. [Project Structure](#project-structure)
3. [Build System](#build-system)
4. [Template System](#template-system)
5. [CSS Architecture](#css-architecture)
6. [JavaScript Framework](#javascript-framework)
7. [Testing](#testing)
8. [Contributing](#contributing)

## Development Environment

### Prerequisites

- PHP 7.4+ for SMF compatibility
- Node.js 14+ for build tools
- Git for version control
- Local SMF installation for testing
- Modern code editor (VS Code recommended)

### Recommended VS Code Extensions

- PHP Intelephense
- ESLint
- Prettier
- Live Sass Compiler
- CSS Peek
- EditorConfig
- GitLens

### Initial Setup

1. Clone the repository:
```bash
git clone https://github.com/yourusername/smf-modern-theme.git
cd smf-modern-theme
```

2. Install dependencies:
```bash
npm install
```

3. Start development server:
```bash
npm run dev
```

## Project Structure

```
modern-smf-theme/
├── css/                    # Stylesheets
│   ├── base/              # Base styles
│   │   ├── variables.css  # CSS variables
│   │   ├── reset.css      # CSS reset
│   │   └── typography.css # Typography styles
│   ├── components/        # UI components
│   │   ├── buttons.css    # Button styles
│   │   ├── cards.css      # Card components
│   │   ├── forms.css      # Form elements
│   │   └── navigation.css # Navigation components
│   └── layouts/           # Layout styles
├── js/                    # JavaScript files
│   ├── modules/          # JS modules
│   ├── utils/            # Utility functions
│   └── theme.js          # Main theme script
├── templates/            # Template files
│   ├── index.template.php
│   ├── header.template.php
│   ├── footer.template.php
│   └── ...
├── languages/           # Language files
├── images/             # Theme images
├── docs/              # Documentation
└── build/            # Build output
```

## Build System

### NPM Scripts

```json
{
  "scripts": {
    "dev": "gulp watch",
    "build": "gulp build",
    "lint": "gulp lint",
    "test": "jest"
  }
}
```

### Gulp Tasks

```javascript
// gulpfile.js
gulp.task('css', () => {
  return gulp.src('css/index.css')
    .pipe(postcss([
      require('autoprefixer'),
      require('cssnano')
    ]))
    .pipe(gulp.dest('build/css'));
});

gulp.task('js', () => {
  return gulp.src('js/theme.js')
    .pipe(webpack(webpackConfig))
    .pipe(gulp.dest('build/js'));
});
```

## Template System

### Template Structure

Each template file follows this structure:
```php
<?php
/**
 * Template: Name
 * Description: Purpose of this template
 */

function template_main() {
    global $context, $settings, $txt;
    
    // Template code
}

function template_above() {
    // Above content
}

function template_below() {
    // Below content
}
```

### Template Functions

Common utility functions:
```php
// Display user avatar
function template_avatar($member, $size = 'medium') {
    // Implementation
}

// Show error message
function template_error_message($message, $type = 'warning') {
    // Implementation
}
```

## CSS Architecture

### SASS Organization

```scss
// Base styles
@import 'base/variables';
@import 'base/typography';
@import 'base/reset';

// Components
@import 'components/buttons';
@import 'components/forms';
@import 'components/cards';

// Layout
@import 'layout/header';
@import 'layout/footer';
@import 'layout/sidebar';
```

### BEM Methodology

```css
.block {}
.block__element {}
.block--modifier {}
```

## JavaScript Framework

### Module System

```javascript
// modules/darkMode.js
export class DarkMode {
    constructor() {
        this.init();
    }
    
    init() {
        // Implementation
    }
}

// theme.js
import { DarkMode } from './modules/darkMode';
new DarkMode();
```

### Event System

```javascript
// Subscribe to events
SMF.Theme.on('darkMode.toggle', function(isDark) {
    // Handle dark mode change
});

// Trigger events
SMF.Theme.trigger('darkMode.toggle', true);
```

## Testing

### Unit Tests

```javascript
// __tests__/darkMode.test.js
describe('DarkMode', () => {
    test('toggles dark mode', () => {
        const darkMode = new DarkMode();
        darkMode.toggle();
        expect(document.documentElement.dataset.theme).toBe('dark');
    });
});
```

### Browser Testing

- Chrome (latest 2 versions)
- Firefox (latest 2 versions)
- Safari (latest 2 versions)
- Edge (latest version)

### Accessibility Testing

- WCAG 2.1 Level AA compliance
- Screen reader compatibility
- Keyboard navigation
- Color contrast

## Contributing

### Pull Request Process

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Run tests
5. Submit pull request

### Code Style

- Follow PHP PSR-12 standard
- Use ESLint for JavaScript
- Follow BEM for CSS
- Keep functions small and focused
- Write meaningful commit messages

### Documentation

- Update relevant documentation
- Add JSDoc comments
- Include code examples
- Document breaking changes
