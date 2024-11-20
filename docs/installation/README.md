# Installation Guide

This guide will walk you through the process of installing and setting up the Modern 2024 SMF Theme.

## Table of Contents

1. [Requirements](#requirements)
2. [Installation Methods](#installation-methods)
3. [Post-Installation Setup](#post-installation-setup)
4. [Troubleshooting](#troubleshooting)
5. [Upgrading](#upgrading)
6. [Uninstallation](#uninstallation)

## Requirements

### System Requirements
- SMF 2.0.x or higher
- PHP 7.4 or higher
- MySQL 5.7+ or MariaDB 10.2+
- Apache 2.4+ or Nginx 1.18+

### Browser Support
- Chrome (latest 2 versions)
- Firefox (latest 2 versions)
- Safari (latest 2 versions)
- Edge (latest version)

### Server Requirements
- Memory: 256MB+ PHP memory limit
- Storage: 50MB+ free space
- PHP Extensions:
  - curl
  - gd
  - json
  - mbstring
  - mysqli
  - xml

## Installation Methods

### Method 1: Through SMF Admin Panel (Recommended)

1. Download the latest release from [GitHub Releases](https://github.com/yourusername/modern-smf-theme/releases)
2. Log in to your SMF Admin Panel
3. Navigate to: Admin → Theme and Layout → Manage and Install
4. Click "Install a New Theme"
5. Upload the theme package (.zip file)
6. Follow the installation wizard
7. Configure initial theme settings

### Method 2: Manual Installation

1. Download and extract the theme package
2. Upload the contents to your forum's `Themes` directory:
   ```
   /path/to/forum/Themes/modern-2024/
   ```
3. Ensure proper file permissions:
   - Directories: 755 (drwxr-xr-x)
   - Files: 644 (-rw-r--r--)
4. Log in to your SMF Admin Panel
5. Navigate to: Admin → Theme and Layout → Manage and Install
6. The theme should appear in the list
7. Click "Install" next to Modern 2024 theme

## Post-Installation Setup

### 1. Theme Settings

#### Basic Settings
1. Navigate to: Admin → Theme and Layout → Theme Settings
2. Configure essential settings:
   - Enable responsive design
   - Set default color scheme
   - Configure header layout
   - Set up footer content

#### Advanced Settings
1. Navigate to: Admin → Theme and Layout → Theme Settings → Advanced
2. Configure:
   - Custom CSS
   - JavaScript options
   - Layout preferences
   - Mobile breakpoints

### 2. Color Scheme Configuration

#### Built-in Schemes
1. Navigate to: Admin → Theme and Layout → Theme Settings → Colors
2. Choose from:
   - Light Mode
   - Dark Mode
   - Auto (system preference)

#### Custom Colors
1. Navigate to: Admin → Theme and Layout → Theme Settings → Custom Colors
2. Customize:
   - Primary colors
   - Secondary colors
   - Background colors
   - Text colors
   - Link colors
   - Button colors

### 3. Performance Optimization

#### Caching
1. Enable CSS and JavaScript minification
2. Configure browser caching
3. Enable image optimization

#### Asset Loading
1. Configure lazy loading for images
2. Enable asynchronous script loading
3. Set up resource prioritization

## Troubleshooting

### Common Issues

#### Theme Not Appearing
1. Check file permissions
2. Verify theme directory structure
3. Clear SMF cache
4. Check error logs

#### Display Issues
1. Clear browser cache
2. Check for JavaScript errors
3. Verify CSS loading
4. Test in different browsers

#### Mobile Issues
1. Check viewport settings
2. Test responsive breakpoints
3. Verify touch interactions
4. Check mobile menu functionality

## Upgrading

### Before Upgrading
1. Backup your current theme
2. Document custom modifications
3. Check compatibility notes
4. Test in development environment

### Upgrade Process
1. Download new version
2. Disable theme temporarily
3. Upload new files
4. Restore custom modifications
5. Clear cache
6. Enable theme
7. Test functionality

## Uninstallation

### Temporary Disable
1. Navigate to Admin Panel
2. Select different theme
3. Disable Modern 2024 theme

### Complete Removal
1. Switch to different theme
2. Uninstall Modern 2024 theme
3. Delete theme files
4. Clear cache
5. Remove theme options from database

## Support

### Getting Help
- Check [Documentation](../README.md)
- Visit [Support Forum](https://forum.example.com)
- Submit [GitHub Issues](https://github.com/yourusername/modern-smf-theme/issues)
- Join [Discord Community](https://discord.gg/example)
