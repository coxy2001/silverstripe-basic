<?php

namespace Coxy\Website\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\ORM\DataExtension;

class DualContentExtension extends DataExtension
{
    private static $db = [
        'HTML2' => 'HTMLText'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $content2 = new HTMLEditorField('HTML2', 'Right Content');
        $content = $fields->fieldByName('Root.Main.HTML');
        if (!$content) {
            $content = $fields->fieldByName('Root.Main.Content');
        }
        if ($content) {
            $content->setDescription('If no data is in the right side content block, this will fill the full width of the block');
            $content->setTitle('Left Content');
        }
        $content2->setRows(5);
        $fields->insertAfter($content->getName(), $content2);
    }
}
