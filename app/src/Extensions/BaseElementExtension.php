<?php

namespace Coxy\Website\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\ORM\DataExtension;

class BaseElementExtension extends DataExtension
{
    private static $db = [
        'BackgroundColour' => 'Enum(array("None","Primary","Secondary"), "None")',
        'TextColour' => 'Enum(array("Inherit","Light","Dark"), "Inherit")',
        'SectionPadTop' => 'Enum(array("Small","Medium","Large","None"), "Medium")',
        'SectionPadBottom' => 'Enum(array("Same","Small","Medium","Large","None"), "Same")',
        'ContainerWidth' => 'Enum(array("Contained","Full"), "Contained")',
        'BoxedItem' => 'Boolean'
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

        $containerWidth = new DropdownField(
            'ContainerWidth',
            'Container Width',
            $ownerSingleton->dbObject('ContainerWidth')->enumValues()
        );
        $containerWidth->setDescription('Set block width to contained or full');

        $boxedItem = new CheckboxField('BoxedItem', 'Boxed Item?');
        $boxedItem->setDescription('Add a box around this block to contain the background colour');

        $fields->addFieldsToTab(
            'Root.Settings',
            [
                $backgroundColour,
                $textColour,
                $sectionPaddingType,
                $sectionPaddingBottom,
                $containerWidth,
                $boxedItem
            ]
        );
    }

    public function getElementClassesArray(): array
    {
        $owner = $this->owner;
        $classes = [];

        if ($owner->config()->get('element_class'))
            $classes['element'] = $owner->config()->get('element_class');
        if ($owner->BackgroundColour != 'None')
            $classes['bg-colour'] = $owner->BackgroundColour;
        if ($owner->TextColour != 'Inherit')
            $classes['text-color'] = $owner->TextColour;
        if ($owner->ExtraClass)
            $classes['extra'] = $owner->ExtraClass;

        $owner->invokeWithExtensions('updateElementClasses', $classes);
        return $classes;
    }

    public function getElementClasses()
    {
        return implode(' ', $this->getElementClassesArray());
    }
}
