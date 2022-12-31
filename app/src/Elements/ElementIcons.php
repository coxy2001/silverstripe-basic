<?php

namespace Coxy\Website\Elements;

use Coxy\Website\Models\Icon;
use DNADesign\Elemental\Models\BaseElement;
use gorriecoe\Link\Models\Link;
use gorriecoe\LinkField\LinkField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * Class \Coxy\Website\Elements\ElementIcons
 *
 * @property int $CTALinkID
 * @method \gorriecoe\Link\Models\Link CTALink()
 * @method \SilverStripe\ORM\DataList|\Coxy\Website\Models\Icon[] Icons()
 */
class ElementIcons extends BaseElement
{
    private static $singular_name = 'Icons';
    private static $plural_name = 'Icons';
    private static $description = 'A set of icons with text and a link';
    private static $table_name = 'ElementIcons';
    private static $icon = 'font-icon-thumbnails';
    private static $inline_editable = false;
    private static $element_class = 'icons';

    private static $db = [];

    private static $has_one = [
        'CTALink' => Link::class,
    ];

    private static $has_many = [
        'Icons' => Icon::class,
    ];

    private static $owns = [
        'Icons',
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName(['Icons', 'CTALinkID']);

        $config = GridFieldConfig_RecordEditor::create();
        $config->addComponents([
            GridFieldOrderableRows::create('Sort'),
        ]);

        $fields->addFieldsToTab('Root.Main', [
            LinkField::create('CTALink', 'Link', $this),
            GridField::create('Icons', 'Icons', $this->Icons(), $config),
        ]);

        return $fields;
    }

    public function getType()
    {
        return $this->singular_name();
    }

    public function getSummary()
    {
        $itemCount = $this->Icons()->count();
        return "$itemCount Icons";
    }

    protected function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        if ($this->Icons()->count() > 0) {
            $image = $this->Icons()->first()->Image();
            $blockSchema['fileURL'] = $image->CMSThumbnail()->getURL();
            $blockSchema['fileTitle'] = $image->getTitle();
        }
        $blockSchema['content'] = $this->getSummary();
        return $blockSchema;
    }
}
