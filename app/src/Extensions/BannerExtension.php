<?php

namespace Coxy\Website\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\DropdownField;
use SilverStripe\ORM\DataExtension;

/**
 * Class \Coxy\Website\Extensions\BannerExtension
 *
 * @property string $BannerHeight
 */
class BannerExtension extends DataExtension
{
    private static $element_class = 'banner';

    private static $db = [
        'BannerHeight' => 'Varchar(16)'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName('CallToActionLink');

        $fields->insertAfter(
            'Title',
            DropdownField::create(
                'BannerHeight',
                'Banner Height',
                [
                    'small' => 'Small',
                    'medium' => 'Medium',
                    'large' => 'Large',
                ]
            )
        );
    }

    public function updateElementClasses(&$classes)
    {
        $owner = $this->owner;
        $classes['height'] = 'banner--' . $owner->BannerHeight;
    }
}
