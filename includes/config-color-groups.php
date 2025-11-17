<?php
// if (!defined('ABSPATH')) exit;

$color_groups = [
    [
        'group_label' => 'Page',
        'fields' => [
            ['key' => 'background', 'label' => 'Background', 'default' => '#FAF8F4'],
            ['key' => 'text', 'label' => 'Text', 'default' => '#2F2F2F'],
            ['key' => 'primary', 'label' => 'Primary', 'default' => '#5DADE2'],
            ['key' => 'accent', 'label' => 'Accent', 'default' => '#F7DC6F'],
        ],
    ],
    [
        'group_label' => 'Link',
        'fields' => [
            ['key' => 'link', 'label' => 'Link Text', 'default' => '#5DADE2'],
            ['key' => 'link_hover', 'label' => 'Link Hover', 'default' => '#69eadd'],
        ]
    ],
    [
        'group_label' => 'Button',
        'fields' => [
            ['key' => 'button_background', 'label' => 'Background', 'default' => '#5DADE2'],
            ['key' => 'button_text', 'label' => 'Text', 'default' => '#FAF8F4'],
            ['key' => 'button_hover_background', 'label' => 'Hover Background', 'default' => '#F7DC6F'],
            ['key' => 'button_hover_text', 'label' => 'Hover (Text)', 'default' => '#2F2F2F'],
        ],
    ],
    [
        'group_label' => 'Header',
        'fields' => [
            ['key' => 'header_background', 'label' => 'Background', 'default' => '#00002f'],
            ['key' => 'header_text', 'label' => 'Text', 'default' => '#FAF8F4'],
        ],
    ],
    [
        'group_label' => 'Footer',
        'fields' => [
            ['key' => 'footer_background', 'label' => 'Background', 'default' => '#FAF8F4'],
            ['key' => 'footer_text', 'label' => 'Text', 'default' => '#2F2F2F'],
        ],
    ],
];
