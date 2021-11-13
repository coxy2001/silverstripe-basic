<?php

namespace Coxy\Elements\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\DropdownField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Control\Controller;

class BaseExtension extends DataExtension
{
    private static $db = [
        'BackgroundColour' => 'Enum(array("None","Primary","Secondary"), "None")',
        'TextColour' => 'Enum(array("Inherit","Light","Dark"), "Inherit")',
        'SectionPadTop' => 'Enum(array("Small","Medium","Large","None"), "Medium")',
        'SectionPadBottom' => 'Enum(array("Same","Small","Medium","Large","None"), "Same")'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $ownerSingleton = $this->getOwner();

        $backgroundColour = new DropdownField(
            'BackgroundColour',
            'Background Colour',
            $ownerSingleton->dbObject('BackgroundColour')->enumValues()
        );
        $backgroundColour->setDescription('Set background colour');

        $textColour = new DropdownField(
            'TextColour',
            'Text Colour',
            $ownerSingleton->dbObject('TextColour')->enumValues()
        );
        $textColour->setDescription('Override text colour style');

        $sectionPaddingType = new DropdownField(
            'SectionPadTop',
            'Section Padding',
            $ownerSingleton->dbObject('SectionPadTop')->enumValues()
        );
        $sectionPaddingType->setDescription('Vertical padding of block');

        $sectionPaddingBottom = new DropdownField(
            'SectionPadBottom',
            'Section Padding Bottom',
            $ownerSingleton->dbObject('SectionPadBottom')->enumValues()
        );
        $sectionPaddingBottom->setDescription('Bottom padding of block');

        $fields->addFieldsToTab(
            'Root.Settings',
            array(
                $backgroundColour,
                $textColour,
                $sectionPaddingType,
                $sectionPaddingBottom
            )
        );
    }

    public function BackgroundColourClass()
    {
        $color = $this->owner->BackgroundColour;
        if ($color == 'Primary') {
            $class = 'bg-primary';
        } elseif ($color == 'Secondary') {
            $class = 'bg-secondary';
        } else {
            $class = '';
        }

        return $class;
    }

    public function TextColourClass()
    {
        $color = $this->owner->TextColour;
        if ($color == 'Dark') {
            $class = 'text-dark';
        } elseif ($color == 'Light') {
            $class = 'text-light';
        } else {
            $class = '';
        }

        return $class;
    }

    public function SectionPaddingClass()
    {
        $padTop = $this->owner->SectionPadTop;
        if ($padTop == 'Small') {
            $class = 'pt-4';
        } elseif ($padTop == 'Medium') {
            $class = 'pt-5';
        } elseif ($padTop == 'Large') {
            $class = 'pt-7';
        } else {
            $class = 'pt-0';
        }
        
        $padBot = $this->owner->SectionPadBottom;
        if ($padBot == 'Same') {
            $padBot = $padTop;
        }
        
        if ($padBot == 'Small') {
            $class .= ' pb-4';
        } elseif ($padBot == 'Medium') {
            $class .= ' pb-5';
        } elseif ($padBot == 'Large') {
            $class .= ' pb-7';
        } else {
            $class .= ' pb-0';
        }

        return $class;
    }

    public function CurrentPageController()
    {
        return (Controller::has_curr()) ? Controller::curr() : null;
    }
}
