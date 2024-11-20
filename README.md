# Modern 2024 SMF Theme

A modern, highly customizable theme for Simple Machines Forum (SMF) 2+ that brings a contemporary 2024 design aesthetic to your forum.

## 🌟 Features

- 🎨 Modern, clean design with careful attention to typography and spacing
- 🌓 Built-in dark/light mode with easy theme switching
- 📱 Fully responsive design for all devices
- 🎯 Enhanced user experience with modern UI patterns
- ⚡ Performance optimized with modern build tools
- 🎪 Card-based layout design
- 🔧 Highly customizable through CSS variables
- 📦 Component-based architecture
- 🧪 Comprehensive testing suite
- 🔄 Continuous Integration/Deployment ready

## 📁 Project Structure

```
.
├── .github/                    # GitHub configuration
│   └── workflows/             # GitHub Actions workflows
│       └── ci.yml            # CI pipeline configuration
├── css/                      # Stylesheets
│   ├── base.css             # Base styles and variables
│   ├── colors/              # Color schemes
│   │   ├── dark.css        # Dark theme styles
│   │   └── light.css       # Light theme styles
│   ├── components/          # UI component styles
│   │   ├── alerts.css      # Alert components
│   │   ├── avatars.css     # Avatar styles
│   │   ├── badges.css      # Badge components
│   │   ├── breadcrumbs.css # Breadcrumb navigation
│   │   ├── buttons.css     # Button styles
│   │   ├── cards.css       # Card components
│   │   ├── forms.css       # Form elements
│   │   ├── lists.css       # List styles
│   │   ├── navigation.css  # Navigation components
│   │   ├── pagination.css  # Pagination controls
│   │   ├── progress.css    # Progress indicators
│   │   ├── tables.css      # Table styles
│   │   ├── tabs.css        # Tab components
│   │   └── tooltips.css    # Tooltip styles
│   └── layout/             # Layout styles
│       ├── footer.css      # Footer styles
│       ├── header.css      # Header styles
│       └── sidebar.css     # Sidebar styles
├── docs/                    # Documentation
│   ├── customization/      # Customization guides
│   ├── development/        # Development documentation
│   │   ├── components.md   # Component documentation
│   │   ├── javascript.md   # JavaScript documentation
│   │   ├── templates.md    # Template documentation
│   │   ├── workflow.md     # Development workflow
│   │   └── accessibility.md # Accessibility guidelines
│   └── installation/       # Installation guides
├── images/                 # Theme images and assets
├── js/                    # JavaScript files
│   ├── animations.js     # Animation utilities
│   ├── forum.js         # Forum-specific functionality
│   ├── theme.js        # Theme management and core UI
│   └── utils.js       # Utility functions
├── languages/          # Language files
│   ├── english.php    # English language strings
│   └── english-utf8.php # UTF-8 English strings
├── scripts/           # Build and utility scripts
├── templates/         # SMF template files
│   ├── admin.template.php      # Admin interface
│   ├── boardindex.template.php # Board listing
│   ├── calendar.template.php   # Calendar view
│   ├── display.template.php    # Topic display
│   ├── footer.template.php     # Footer template
│   ├── generic.template.php    # Generic components
│   ├── header.template.php     # Header template
│   ├── help.template.php       # Help system
│   ├── index.template.php      # Main index
│   ├── messageindex.template.php # Message listing
│   ├── moderate.template.php    # Moderation tools
│   ├── profile.template.php     # User profiles
│   ├── search.template.php      # Search functionality
│   └── stats.template.php       # Statistics display
├── tests/             # Test files
│   ├── php/          # PHP template tests
│   │   ├── bootstrap.php     # Test environment setup
│   │   └── BoardIndexTest.php # Board index tests
│   ├── setup.js     # JavaScript test setup
│   └── utils.test.js # Utility function tests
├── .babelrc         # Babel configuration
├── .editorconfig    # Editor configuration
├── .eslintrc.js    # ESLint configuration
├── .gitignore      # Git ignore rules
├── .stylelintrc.js # Stylelint configuration
├── jest.config.js  # Jest test configuration
├── package.json    # NPM package configuration
├── phpunit.xml    # PHPUnit configuration
├── postcss.config.js # PostCSS configuration
├── rollup.config.js  # Rollup bundler configuration
├── theme_info.xml    # Theme metadata
├── theme_settings.php # Theme settings
└── TODO.md          # Development tasks
```

## 📚 Documentation

- [Installation Guide](docs/installation/README.md)
- [Customization Guide](docs/customization/README.md)
- [Development Guide](docs/development/README.md)
- [Development Workflow](docs/development/workflow.md)
- [Template Documentation](docs/development/templates.md)

## 🚀 Quick Start

1. Download the latest release
2. Upload the theme directory to your SMF themes folder
3. Install via Admin → Theme and Layout → Manage and Install
4. Customize colors and settings through the admin panel

## 🛠️ Development Setup

1. Clone the repository
2. Install dependencies:
   ```bash
   npm install
   ```
3. Start development server:
   ```bash
   npm run dev
   ```
4. Build for production:
   ```bash
   npm run build
   ```

## 🧪 Testing

The theme includes comprehensive testing:

### JavaScript Tests
```bash
npm run test:js
```

### PHP Template Tests
```bash
vendor/bin/phpunit
```

### Linting
```bash
npm run lint:js   # ESLint
npm run lint:css  # Stylelint
```

## 🔄 CI/CD

The theme uses GitHub Actions for:
- Automated testing
- Code quality checks
- Asset building
- Release management

## 🎨 Customization

### Color Schemes
- Light (Default)
- Dark
- Custom schemes can be added in `css/colors/`
- Easy customization through CSS variables

### Components
- Buttons (multiple variants)
- Cards (elevated, interactive)
- Tables (responsive, sortable)
- Forms and inputs
- Navigation menus
- Modal dialogs
- Tooltips
- Progress indicators

## 📱 Responsive Design
- Mobile-first approach
- Breakpoints for all devices
- Touch-friendly interface
- Optimized navigation

## ⚡ Performance
- Modern build system with PostCSS and Rollup
- Minified and optimized assets
- Lazy loading of images
- Efficient CSS architecture
- JavaScript bundling and tree shaking

## 🤝 Contributing
1. Fork the repository
2. Create a feature branch
3. Follow the development workflow in [docs/development/workflow.md](docs/development/workflow.md)
4. Submit a pull request

## 📄 License
This theme is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
