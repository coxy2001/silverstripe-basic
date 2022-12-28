<?php

namespace Coxy\Website\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\DropdownField;
use SilverStripe\ORM\DataExtension;

class BannerExtension extends DataExtension
{
    private static $element_class = 'banner';

    private static $db = [
        'BannerHeight' => 'Enum(["30","40","50","60","70"], "40")'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $ownerSingleton = $this->getOwner();

        $bannerHeight = new DropdownField(
            'BannerHeight',
            'Banner Height',
            $ownerSingleton->dbObject('BannerHeight')->enumValues()
        );
        $bannerHeight->setDescription('Set banner height');
    }
}
