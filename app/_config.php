<?php

use SilverStripe\Security\PasswordValidator;
use SilverStripe\Security\Member;

// remove PasswordValidator for SilverStripe 5.0
$validator = PasswordValidator::create();
// Settings are registered via Injector configuration - see passwords.yml in framework
Member::set_password_validator($validator);

/**
 * HTML Editor Config setup
 */

$formats = [
    [
        'title' => 'Misc Styles', 'items' => [
            [
                'title' => 'Button',
                'selector' => 'a',
                'wrapper' => false,
                'classes' => 'btn btn-primary',
                'merge_siblings' => false,
            ],
            [
                'title' => 'Phone',
                'inline' => 'span',
                'classes' => 'phone-link',
                'merge_siblings' => true,
            ]
        ]
    ],
];

TinyMCEConfig::get('cms')
    ->setContentCSS(['/public/assets/_css/themes-cb-basic-scss-style.css'])
    ->addButtonsToLine(1, 'styleselect')
    ->setOptions([
        'importcss_append' => true,
        'style_formats' => $formats,
    ]);
