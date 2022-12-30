<?php

namespace Coxy\Website\Elements;

use SilverStripe\ElementalFileBlock\Block\FileBlock;
use SilverStripe\Forms\DropdownField;

/**
 * Class \Coxy\Website\Elements\ElementImageContent
 *
 * @property string $ImagePosition
 * @property string $Content
 */
class ElementImageContent extends FileBlock
{
    private static $singular_name = 'Image Content';
    private static $plural_name = 'Image Contents';
    private static $description = 'Image Content';
    private static $table_name = 'ElementImageContent';
    private static $icon = 'font-icon-block-banner';
    private static $element_class = 'image-content';

    private static $db = [
        'ImagePosition' => 'Varchar(16)',
        'Content' => 'HTMLText'
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->fieldByName('Root.Main.Content')->setRows(8);

        $imagePos = DropdownField::create(
            'ImagePosition',
            'Image Position',
            [
                'left' => 'Left',
                'right' => 'Right',
            ]
        );
        $fields->insertAfter('Root.Main.File', $imagePos);

        return $fields;
    }

    public function getType()
    {
        return 'Image + Content';
    }

    public function getSummary()
    {
        if ($this->File() && $this->File()->exists()) {
            return $this->getSummaryThumbnail() . $this->dbObject('Content')->Summary(20);
        }
        return $this->dbObject('Content')->Summary(20);
    }

    protected function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = $this->dbObject('Content')->Summary(20);
        return $blockSchema;
    }

    public function updateElementClasses(&$classes)
    {
        $classes['position'] = 'image-content--pos-' . $this->ImagePosition;
    }
}
