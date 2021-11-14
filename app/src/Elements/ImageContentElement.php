<?php

namespace Coxy\Website\Elements;

use SilverStripe\ElementalFileBlock\Block\FileBlock;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\DropdownField;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\View\ArrayData;

class ImageContentElement extends FileBlock
{
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

    protected function decodeLinkData($linkJson)
    {
        if (!$linkJson || $linkJson === 'null') {
            return;
        }

        $data = ArrayData::create(json_decode($linkJson));

        // Link page, if selected
        if ($data->PageID) {
            $data->setField('Page', self::get_by_id(SiteTree::class, $data->PageID));
        }

        return $data;
    }

    private static $singular_name = 'image content block';

    private static $plural_name = 'image content blocks';

    private static $description = 'Image content block';

    private static $table_name = 'ElementImageContent';

    private static $icon = 'font-icon-block-banner';

    public function getType()
    {
        return 'Image + Content';
    }

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
}
