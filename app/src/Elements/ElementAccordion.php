<?php

namespace Coxy\Website\Elements;

use Coxy\Website\Models\AccordionItem;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * Class \Coxy\Website\Elements\ElementAccordion
 *
 * @property string $Content
 * @method \SilverStripe\ORM\DataList|\Coxy\Website\Models\AccordionItem[] AccordionItems()
 */
class ElementAccordion extends BaseElement
{
    private static $singular_name = 'Accordion';
    private static $plural_name = 'Accordions';
    private static $description = 'List of collapsable items';
    private static $table_name = 'ElementAccordion';
    private static $icon = 'font-icon-block-file-list';
    private static $inline_editable = false;
    private static $element_class = 'accordion';

    private static $db = [
        'Content' => 'HTMLText',
    ];

    private static $has_many = [
        'AccordionItems' => AccordionItem::class,
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('AccordionItems');

        $content = HTMLEditorField::create('Content')->setRows(8);

        $config = GridFieldConfig_RecordEditor::create();
        $config->addComponent(GridFieldOrderableRows::create('Sort'));
        $items = GridField::create('AccordionItems', 'Accordion Items', $this->AccordionItems(), $config);

        $fields->addFieldsToTab('Root.Main', [
            $content,
            $items,
        ]);

        return $fields;
    }

    public function getType()
    {
        return $this->singular_name();
    }

    public function getSummary()
    {
        $itemCount = $this->AccordionItems()->count();
        $summary = $this->dbObject('Content')->Summary(20);
        return "$itemCount Items | $summary";
    }

    protected function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = $this->getSummary();
        return $blockSchema;
    }
}
