<?php

use SilverStripe\Control\Director;
use SilverStripe\Core\Config\Config;
use SilverStripe\Security\PasswordValidator;
use SilverStripe\Security\Member;
use SilverStripe\Forms\HTMLEditor\TinyMCEConfig;

// remove PasswordValidator for SilverStripe 5.0
$validator = PasswordValidator::create();
// Settings are registered via Injector configuration - see passwords.yml in framework
Member::set_password_validator($validator);

// Enable IDE Annotator in dev mode
if (Director::isDev()) {
    Config::modify()->set('SilverLeague\IDEAnnotator\DataObjectAnnotator', 'enabled', true);
    Config::modify()->set('SilverLeague\IDEAnnotator\DataObjectAnnotator', 'enabled_modules', ['app']);
}

/**
 * HTML Editor Config setup
 */

$formats = [
    [
        'title' => 'Buttons',
        'items' => [
            [
                'title' => 'Button Primary',
                'selector' => 'a',
                'wrapper' => false,
                'classes' => 'btn btn--primary',
                'merge_siblings' => false,
            ],
            [
                'title' => 'Button Secondary',
                'selector' => 'a',
                'wrapper' => false,
                'classes' => 'btn btn--secondary',
                'merge_siblings' => false,
            ]
        ]
    ]
];

TinyMCEConfig::get('cms')
    ->addButtonsToLine(1, 'styleselect')
    ->setOptions([
        'importcss_append' => true,
        'style_formats' => $formats,
    ]);
