# Template Documentation

This document provides comprehensive documentation for the Modern 2024 SMF Theme templates.

## Template Structure

The theme's templates are organized in the `templates/` directory:

```
templates/
├── BoardIndex.template.php   # Main board listing
├── Display.template.php      # Topic display
├── GenericMenu.template.php  # Menu components
├── MessageIndex.template.php # Topic listing
├── Posting.template.php      # Post editor
└── components/              # Reusable components
    ├── Buttons.template.php
    ├── Cards.template.php
    └── Navigation.template.php
```

## Testing Templates

### Setup

1. Install PHPUnit:
   ```bash
   composer require --dev phpunit/phpunit
   ```

2. Configure PHPUnit:
   ```xml
   <!-- phpunit.xml -->
   <phpunit>
     <testsuites>
       <testsuite name="Template Tests">
         <directory>tests/php</directory>
       </testsuite>
     </testsuites>
   </phpunit>
   ```

3. Bootstrap file:
   ```php
   // tests/php/bootstrap.php
   require_once __DIR__ . '/bootstrap.php';
   ```

### Writing Tests

1. Create test files in `tests/php/`
2. Extend `PHPUnit\Framework\TestCase`
3. Use helper functions from bootstrap
4. Test template output

Example:
```php
class BoardIndexTest extends TestCase
{
    public function testBoardIndexTemplate()
    {
        // Test template rendering
        $output = assertTemplateOutput('template_main', 'Expected Content');
        $this->assertTrue($output);
    }
}
```

### Running Tests

```bash
vendor/bin/phpunit
```

## Template Guidelines

### 1. Structure

- Use semantic HTML5 elements
- Maintain consistent indentation
- Group related elements
- Use meaningful IDs and classes

### 2. Accessibility

- Include ARIA attributes
- Use semantic headings
- Ensure keyboard navigation
- Provide alt text for images

### 3. Performance

- Minimize inline styles
- Use efficient selectors
- Optimize template logic
- Cache when possible

### 4. Responsive Design

- Mobile-first approach
- Use flexible layouts
- Test on multiple devices
- Consider touch interactions

## Common Templates

### BoardIndex.template.php

Main board listing template.

```php
function template_main()
{
    global $context, $settings, $options, $scripturl, $txt;

    // Template code...
}
```

Features:
- Category listing
- Board information
- Last post details
- Board statistics
- User information

### Display.template.php

Topic display template.

```php
function template_main()
{
    global $context, $settings, $options, $scripturl, $txt;

    // Template code...
}
```

Features:
- Post content
- User profiles
- Quick reply
- Moderation tools
- Navigation

### MessageIndex.template.php

Topic listing template.

```php
function template_main()
{
    global $context, $settings, $options, $scripturl, $txt;

    // Template code...
}
```

Features:
- Topic listing
- Sort options
- Search functionality
- Topic information
- Pagination

## Component Templates

### Buttons.template.php

Reusable button components.

```php
function template_button_primary()
{
    global $context, $txt;

    // Button code...
}
```

Features:
- Multiple variants
- State handling
- Icon support
- Loading states

### Cards.template.php

Card layout components.

```php
function template_card_standard()
{
    global $context;

    // Card code...
}
```

Features:
- Various layouts
- Content areas
- Interactive states
- Media support

### Navigation.template.php

Navigation components.

```php
function template_nav_main()
{
    global $context, $scripturl;

    // Navigation code...
}
```

Features:
- Menu structure
- Responsive behavior
- Active states
- Dropdown support

## Template Variables

### Global Variables

- `$context` - Template context data
- `$settings` - Theme settings
- `$options` - User options
- `$scripturl` - Forum URL
- `$txt` - Language strings

### Common Context Keys

- `$context['page_title']` - Current page title
- `$context['user']` - User information
- `$context['forum_name']` - Forum name
- `$context['current_board']` - Current board
- `$context['current_topic']` - Current topic

## Best Practices

### 1. Code Organization

- Group related functions
- Use consistent naming
- Comment complex logic
- Separate concerns

### 2. Performance

- Cache expensive operations
- Minimize database queries
- Use efficient loops
- Avoid redundant code

### 3. Maintenance

- Document changes
- Write tests
- Follow coding standards
- Keep templates focused

### 4. Security

- Escape output
- Validate input
- Check permissions
- Use security tokens

## Testing Examples

### Basic Template Test

```php
public function testTemplateRendering()
{
    global $context;
    
    $context['page_title'] = 'Test Page';
    $this->assertTrue(
        assertTemplateOutput('template_main', $context['page_title'])
    );
}
```

### User State Test

```php
public function testUserLoggedIn()
{
    global $context;
    
    $context['user']['is_logged'] = true;
    $context['user']['name'] = 'Test User';
    
    $this->assertTrue(
        assertTemplateOutput('template_main', $context['user']['name'])
    );
}
```

### Layout Test

```php
public function testResponsiveLayout()
{
    global $context, $modSettings;
    
    $modSettings['layout_style'] = 'wide';
    $this->assertTrue(
        assertTemplateOutput('template_main', 'wrapper-wide')
    );
}
```

## Troubleshooting

### Common Issues

1. Template not found
   - Check file path
   - Verify template name
   - Check file permissions

2. Variable undefined
   - Check global declaration
   - Verify context setup
   - Check variable scope

3. Styling issues
   - Check class names
   - Verify CSS loading
   - Test responsive behavior

### Debug Tips

1. Use template comments
2. Check error logs
3. Test incrementally
4. Use var_dump() wisely

## Additional Resources

- [SMF Template Documentation](https://wiki.simplemachines.org/smf/Templates)
- [Theme Development Guide](../customization/README.md)
- [Installation Guide](../installation/README.md)
