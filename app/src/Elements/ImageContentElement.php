<?php

namespace Coxy\Website\Elements;

use SilverStripe\ElementalFileBlock\Block\FileBlock;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\DropdownField;

class ImageContentElement extends FileBlock
{
    private static $singular_name = 'Image Content Block';
    private static $plural_name = 'Image Content Blocks';
    private static $description = 'Image Content Block';
    private static $table_name = 'ElementImageContent';
    private static $icon = 'font-icon-block-banner';
    private static $element_class = "image-content";

    private static $db = [
        'ImagePosition' => 'Enum(array("Left","Right"), "Right")',
        'Content' => 'HTMLText'
    ];

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(
            function (FieldList $fields) {
                $imagePos = new DropdownField(
                    'ImagePosition',
                    'Image Position',
                    $this->dbObject('ImagePosition')->enumValues()
                );
                $fields->insertAfter('Root.Main.File', $imagePos);
                $fields->fieldByName('Root.Main.Content')->setRows(8);
            }
        );

        return parent::getCMSFields();
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
        return '';
    }

    protected function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = $this->dbObject('Content')->Summary(20);
        return $blockSchema;
    }
}
