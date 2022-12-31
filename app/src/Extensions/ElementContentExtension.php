<?php

namespace Coxy\Website\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\ORM\DataExtension;

/**
 * Class \Coxy\Website\Extensions\ElementContentExtension
 *
 * @property string $HTML2
 */
class ElementContentExtension extends DataExtension
{
    private static $element_class = 'content';

    private static $db = [
        'HTML2' => 'HTMLText'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $content = $fields->fieldByName('Root.Main.HTML');
        if (!$content) {
            $content = $fields->fieldByName('Root.Main.Content');
        }
        if ($content) {
            $content->setDescription('If no data is in the right side content block, this will fill the full width of the block');
            $content->setTitle('Left Content');
        }

        $fields->insertAfter(
            $content->getName(),
            HTMLEditorField::create('HTML2', 'Right Content')->setRows(5)
        );
    }
}
