# Development Workflow

This document outlines the development workflow for the Modern 2024 SMF Theme.

## Getting Started

1. Clone the repository:
   ```bash
   git clone [repository-url]
   cd modern-2024-smf-theme
   ```

2. Install dependencies:
   ```bash
   npm install
   ```

3. Start development:
   ```bash
   npm run dev
   ```

## Development Process

### 1. Code Organization

- `templates/` - PHP template files
- `css/` - Stylesheets
- `js/` - JavaScript files
- `images/` - Theme images and assets
- `languages/` - Language files
- `docs/` - Documentation
- `tests/` - Test files
  - `js/` - JavaScript tests
  - `php/` - PHP template tests

### 2. Branch Strategy

- `main` - Production-ready code
- `develop` - Development branch
- `feature/*` - New features
- `bugfix/*` - Bug fixes
- `release/*` - Release preparation

### 3. Development Cycle

1. Create a new branch from `develop`:
   ```bash
   git checkout develop
   git pull
   git checkout -b feature/your-feature
   ```

2. Make your changes and ensure:
   - Code follows style guidelines
   - Tests are written/updated
   - Documentation is updated

3. Run tests and linting:
   ```bash
   # JavaScript tests
   npm run test:js
   
   # PHP tests
   vendor/bin/phpunit
   
   # Linting
   npm run lint:js
   npm run lint:css
   ```

4. Build assets:
   ```bash
   npm run build
   ```

5. Commit changes:
   ```bash
   git add .
   git commit -m "feat: description of changes"
   ```

6. Push and create a pull request:
   ```bash
   git push origin feature/your-feature
   ```

### 4. Code Review Process

1. Create a pull request to `develop`
2. Ensure CI checks pass:
   - JavaScript tests
   - PHP tests
   - ESLint
   - Stylelint
   - Build verification
3. Request review from team members
4. Address review comments
5. Merge when approved

### 5. Release Process

1. Create a release branch:
   ```bash
   git checkout -b release/v1.x.x
   ```

2. Update version numbers:
   - `package.json`
   - `theme_info.xml`

3. Update changelog

4. Build and test:
   ```bash
   npm run build
   npm run test:js
   vendor/bin/phpunit
   ```

5. Create a pull request to `main`

6. After merge, tag the release:
   ```bash
   git tag -a v1.x.x -m "Version 1.x.x"
   git push origin v1.x.x
   ```

## Build System

### CSS Processing

- PostCSS for modern CSS features
- Autoprefixer for vendor prefixes
- CSS Nano for minification
- CSS Variables for theming
- Modern CSS Grid and Flexbox

### JavaScript Bundling

- Rollup for efficient bundling
- Babel for modern JavaScript
- Terser for minification
- ES6+ features
- Tree shaking

### Image Optimization

- Imagemin for compression
- SVG optimization
- Responsive images
- Lazy loading

### Development Server

- File watching
- Auto rebuilding
- Browser sync
- Source maps

## Testing

### JavaScript Tests

- Jest for unit testing
- Mock browser environment
- DOM testing utilities
- Code coverage reports

### PHP Template Tests

- PHPUnit for testing
- Template rendering tests
- Mock SMF environment
- Integration tests

### Testing Best Practices

1. Write tests first (TDD)
2. Mock external dependencies
3. Test edge cases
4. Maintain high coverage
5. Use descriptive test names

## Code Quality

### Linting

- ESLint for JavaScript
  - Modern rules
  - Import checking
  - Best practices
- Stylelint for CSS
  - Modern CSS rules
  - Order checking
  - BEM validation

### Code Style

- EditorConfig for consistency
- Prettier for formatting
- BEM methodology for CSS
- JSDoc comments

## CI/CD Pipeline

### GitHub Actions Workflow

1. Install dependencies
2. Run linters
3. Run tests
4. Build assets
5. Create release
6. Deploy (if applicable)

### Quality Gates

- All tests passing
- Code coverage maintained
- Linting passes
- Build succeeds
- PR approved

## Best Practices

### Code Quality

1. Write meaningful commit messages (Conventional Commits)
2. Keep changes focused and atomic
3. Document code and changes
4. Write tests for new features
5. Review your own code before requesting review

### Performance

1. Optimize assets
2. Minimize dependencies
3. Use modern CSS/JS features
4. Implement lazy loading
5. Monitor bundle size

### Maintenance

1. Keep dependencies updated
2. Monitor security advisories
3. Clean up unused code
4. Maintain documentation
5. Review analytics and feedback

## Tools and Resources

### Development

- Git for version control
- GitHub for collaboration
- npm for package management
- VS Code recommended editor

### Building

- PostCSS ecosystem
- Rollup bundler
- Babel transpiler
- Terser minifier

### Testing

- Jest for JavaScript
- PHPUnit for PHP
- Testing utilities
- Coverage tools

### CI/CD

- GitHub Actions
- Automated workflows
- Release management
- Deployment scripts
