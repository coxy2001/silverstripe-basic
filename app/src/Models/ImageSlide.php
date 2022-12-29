<?php

namespace Coxy\Website\Models;

use Coxy\Website\Elements\ElementImageSlider;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\ORM\DataObject;

class ImageSlide extends DataObject
{
    private static $singular_name = 'Image Slide';
    private static $plural_name = 'Image Slides';
    private static $description = 'Slide containing an image';
    private static $table_name = 'ImageSlide';

    private static $db = [
        'Title' => 'Varchar',
        'Content' => 'HTMLText',
    ];

    private static $has_one = [
        'Image' => Image::class,
        'Slider' => ElementImageSlider::class,
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('SliderID');

        $content = HTMLEditorField::create('Content')->setRows(8);
        $fields->insertAfter('Title', $content);

        return $fields;
    }
}
