<?php

namespace Coxy\Website\Models;

use Coxy\Website\Elements\ElementImageSlider;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\ORM\DataObject;

class ImageSlide extends DataObject
{
    const IMAGE_DIR = 'Uploads' . DIRECTORY_SEPARATOR . 'slides';

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

    private static $owns = [
        'Image',
    ];

    private static $summary_fields = [
        'Image.CMSThumbnail' => 'Image',
        'Title' => 'Title',
        'Content.Summary' => 'Content',
    ];

    private static $searchable_fields = [
        'Title',
        'Content',
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('SliderID');

        $content = HTMLEditorField::create('Content')->setRows(8);
        $logoField = UploadField::create('Image')->setFolderName(self::IMAGE_DIR);

        $fields->addFieldsToTab('Root.Main', [
            $content,
            $logoField,
        ]);

        return $fields;
    }
}
