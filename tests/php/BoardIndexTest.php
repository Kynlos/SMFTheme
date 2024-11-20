<?php
/**
 * Test cases for the BoardIndex template
 */

use PHPUnit\Framework\TestCase;

class BoardIndexTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        resetContext();
        loadTemplate('BoardIndex');
    }

    public function testBoardIndexTemplateContainsForumName()
    {
        global $context;
        $context['forum_name'] = 'Test Forum Name';
        
        $this->assertTrue(
            assertTemplateOutput('template_main', $context['forum_name']),
            'BoardIndex template should contain forum name'
        );
    }

    public function testBoardIndexTemplateWithCategories()
    {
        global $context;
        
        $context['categories'] = [
            1 => [
                'id' => 1,
                'name' => 'Test Category',
                'description' => 'Test Category Description',
                'boards' => [
                    [
                        'id' => 1,
                        'name' => 'Test Board',
                        'description' => 'Test Board Description',
                        'new' => false,
                        'children' => [],
                        'link' => 'http://example.com/board/1',
                        'href' => 'http://example.com/board/1',
                        'topics' => 10,
                        'posts' => 20,
                        'last_post' => [
                            'id' => 1,
                            'time' => '2024-01-01 12:00:00',
                            'timestamp' => strtotime('2024-01-01 12:00:00'),
                            'subject' => 'Test Post',
                            'member' => [
                                'name' => 'Test User',
                                'id' => 1,
                                'href' => 'http://example.com/member/1',
                            ],
                            'href' => 'http://example.com/post/1',
                        ],
                    ],
                ],
            ],
        ];

        $output = assertTemplateOutput('template_main', 'Test Category');
        $this->assertTrue($output, 'BoardIndex template should contain category name');
        
        $output = assertTemplateOutput('template_main', 'Test Board');
        $this->assertTrue($output, 'BoardIndex template should contain board name');
        
        $output = assertTemplateOutput('template_main', 'Test Board Description');
        $this->assertTrue($output, 'BoardIndex template should contain board description');
    }

    public function testBoardIndexTemplateWithNoBoards()
    {
        global $context;
        $context['categories'] = [];
        
        $output = assertTemplateOutput('template_main', 'No boards');
        $this->assertTrue($output, 'BoardIndex template should handle empty board list');
    }

    public function testBoardIndexTemplateWithUserLoggedIn()
    {
        global $context;
        $context['user']['is_logged'] = true;
        $context['user']['name'] = 'Test User';
        
        $output = assertTemplateOutput('template_main', 'Test User');
        $this->assertTrue($output, 'BoardIndex template should display username when logged in');
    }

    public function testBoardIndexTemplateResponsiveLayout()
    {
        global $context, $modSettings;
        
        // Test wide layout
        $modSettings['layout_style'] = 'wide';
        $output = assertTemplateOutput('template_main', 'wrapper-wide');
        $this->assertTrue($output, 'BoardIndex template should have wide layout class');
        
        // Test narrow layout
        $modSettings['layout_style'] = 'narrow';
        $output = assertTemplateOutput('template_main', 'wrapper-narrow');
        $this->assertTrue($output, 'BoardIndex template should have narrow layout class');
    }

    public function testBoardIndexTemplateThemeVariants()
    {
        global $context, $modSettings;
        
        // Test light theme
        $modSettings['theme_color_scheme'] = 'light';
        $output = assertTemplateOutput('template_main', 'theme-light');
        $this->assertTrue($output, 'BoardIndex template should have light theme class');
        
        // Test dark theme
        $modSettings['theme_color_scheme'] = 'dark';
        $output = assertTemplateOutput('template_main', 'theme-dark');
        $this->assertTrue($output, 'BoardIndex template should have dark theme class');
    }

    public function testBoardIndexTemplateSidebarPosition()
    {
        global $context, $modSettings;
        
        // Test left sidebar
        $modSettings['sidebar_position'] = 'left';
        $output = assertTemplateOutput('template_main', 'sidebar-left');
        $this->assertTrue($output, 'BoardIndex template should have left sidebar class');
        
        // Test right sidebar
        $modSettings['sidebar_position'] = 'right';
        $output = assertTemplateOutput('template_main', 'sidebar-right');
        $this->assertTrue($output, 'BoardIndex template should have right sidebar class');
    }
}
