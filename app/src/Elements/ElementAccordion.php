<?php

namespace Coxy\Website\Elements;

use Coxy\Website\Models\AccordionItem;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridField_ActionMenu;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use SilverStripe\Forms\GridField\GridFieldDetailForm;
use SilverStripe\Forms\GridField\GridFieldEditButton;
use SilverStripe\Forms\GridField\GridFieldFilterHeader;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\Tab;

class ElementAccordion extends BaseElement
{
    private static $singular_name = 'Accordion';
    private static $plural_name = 'Accordions';
    private static $description = 'List of things';
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

        $items = GridField::create('AccordionItems', 'Accordion Items', $this->AccordionItems());
        $config = $items->getConfig();
        $config->removeComponentsByType([
            GridFieldFilterHeader::class,
        ]);
        $config->addComponents([
            GridFieldAddNewButton::create(),
            GridFieldDetailForm::create(),
            GridField_ActionMenu::create(),
            GridFieldEditButton::create(),
            GridFieldDeleteAction::create(),
        ]);

        $fields->addFieldsToTab(
            'Root.Main',
            [
                $content,
                $items,
            ]
        );

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
