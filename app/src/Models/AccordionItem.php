<?php

namespace Coxy\Website\Models;

use Coxy\Website\Elements\ElementAccordion;
use SilverStripe\ORM\DataObject;

class AccordionItem extends DataObject
{
    private static $singular_name = 'Accordion Item';
    private static $plural_name = "Accordion Item's";
    private static $description = 'A collapsable item';
    private static $table_name = 'AccordionItem';

    private static $db = [
        'Title' => 'Varchar',
        'Content' => 'HTMLText',
    ];

    private static $has_one = [
        'Accordion' => ElementAccordion::class,
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('AccordionID');
        return $fields;
    }
}
