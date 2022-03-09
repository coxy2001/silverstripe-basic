<?php

namespace Coxy\Website\Extensions;

use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TabSet;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Control\Director;
use TractorCow\Colorpicker\Color;
use TractorCow\Colorpicker\Forms\ColorField;
use Axllent\Scss\ScssCompiler;

class SiteThemeExtension extends DataExtension
{
    private static $db = [
        'ColourBody' => Color::class,
        'ColourBodyBg' => Color::class,
        'ColourPrimary' => Color::class,
        'ColourSecondary' => Color::class,
        'ColourLink' => Color::class,
        'ColourBanner' => Color::class,

        'ColourH1' => Color::class,
        'ColourH2' => Color::class,
        'ColourH3' => Color::class,
        'ColourH4' => Color::class,
        'ColourH5' => Color::class,
        'ColourH6' => Color::class,

        'WeightH1' => 'Varchar',
        'WeightH2' => 'Varchar',
        'WeightH3' => 'Varchar',
        'WeightH4' => 'Varchar',
        'WeightH5' => 'Varchar',
        'WeightH6' => 'Varchar',

        'ColourHeaderBg' => Color::class,

        'ColourNavLink' => Color::class,
        'ColourNavCurrent' => Color::class,
        'ColourNavHover' => Color::class,

        'ColourFooterBg' => Color::class,
        'ColourFooter' => Color::class,
        'ColourFooterLink' => Color::class
    ];

    private static $defaults = [
        'ColourBody' => '000000',
        'ColourBodyBg' => 'ffffff',
        'ColourPrimary' => '0088ff',
        'ColourSecondary' => 'ffff00',
        'ColourLink' => '0088ff',
        'ColourBanner' => 'ffffff',

        'ColourH1' => '000000',
        'ColourH2' => '000000',
        'ColourH3' => '000000',
        'ColourH4' => '000000',
        'ColourH5' => '000000',
        'ColourH6' => '000000',

        'WeightH1' => '700',
        'WeightH2' => '700',
        'WeightH3' => '500',
        'WeightH4' => '500',
        'WeightH5' => '500',
        'WeightH6' => '500',

        'ColourHeaderBg' => '0088ff',

        'ColourNavLink' => 'ffffff',
        'ColourNavCurrent' => '0088ff',
        'ColourNavHover' => 'ffff00',

        'ColourFooterBg' => '000000',
        'ColourFooter' => 'ffffff',
        'ColourFooterLink' => 'dddddd'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        // Theme Options
        if (!$fields->fieldByName('Root.ThemeOptions')) {
            $fields->insertAfter(new TabSet('ThemeOptions'), 'General');
        }

        $fields->addFieldsToTab(
            "Root.ThemeOptions.Body",
            array(
                ColorField::create('ColourBody', 'Body Colour'),
                ColorField::create('ColourBodyBg', 'Body Background Colour'),
                ColorField::create('ColourPrimary', 'Primary Colour'),
                ColorField::create('ColourSecondary', 'Secondary Colour'),
                ColorField::create('ColourLink', 'Link Text Colour'),
                ColorField::create('ColourBanner', 'Banner Text Colour')
            )
        );

        $fields->addFieldsToTab(
            "Root.ThemeOptions.Headings",
            array(
                ColorField::create('ColourH1', 'H1 Colour'),
                TextField::create('WeightH1', 'H1 Weight'),
                ColorField::create('ColourH2', 'H2 Colour'),
                TextField::create('WeightH2', 'H2 Weight'),
                ColorField::create('ColourH3', 'H3 Colour'),
                TextField::create('WeightH3', 'H3 Weight'),
                ColorField::create('ColourH4', 'H4 Colour'),
                TextField::create('WeightH4', 'H4 Weight'),
                ColorField::create('ColourH5', 'H5 Colour'),
                TextField::create('WeightH5', 'H5 Weight'),
                ColorField::create('ColourH6', 'H6 Colour'),
                TextField::create('WeightH6', 'H6 Weight')
            )
        );

        $fields->addFieldsToTab(
            "Root.ThemeOptions.Header",
            array(
                ColorField::create('ColourHeaderBg', 'Header Background Colour'),
            )
        );

        $fields->addFieldsToTab(
            "Root.ThemeOptions.Navigation",
            array(
                ColorField::create('ColourNavLink', 'Navigation Link Colour'),
                ColorField::create('ColourNavCurrent', 'Navigation Current Colour'),
                ColorField::create('ColourNavHover', 'Navigation Hover Colour')
            )
        );

        $fields->addFieldsToTab(
            "Root.ThemeOptions.Footer",
            array(
                ColorField::create('ColourFooterBg', 'Footer Background color'),
                ColorField::create('ColourFooter', 'Footer Text color'),
                ColorField::create('ColourFooterLink', 'Footer Link color')
            )
        );
    }

    public function onBeforeWrite()
    {
        $this->writeCustomScssFile();
        parent::onBeforeWrite();
    }

    public function writeCustomScssFile()
    {
        $baseFolder = Director::baseFolder();
        $overridesStylesheet = $baseFolder . '/themes/cb-basic/scss/themeOptions.scss';

        $data = $this->owner->renderWith('ThemeOptions');
        file_put_contents($overridesStylesheet, $data);

        ScssCompiler::flush();
    }
}
