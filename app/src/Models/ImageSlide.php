<?php

namespace Coxy\Website\Models;

use Coxy\Website\Elements\ElementImageSlider;
use gorriecoe\Link\Models\Link;
use gorriecoe\LinkField\LinkField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\ORM\DataObject;

/**
 * Class \Coxy\Website\Models\ImageSlide
 *
 * @property string $Title
 * @property string $Content
 * @property int $Sort
 * @property int $ImageID
 * @property int $CTALinkID
 * @property int $SliderID
 * @method \SilverStripe\Assets\Image Image()
 * @method \gorriecoe\Link\Models\Link CTALink()
 * @method \Coxy\Website\Elements\ElementImageSlider Slider()
 */
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
        'Sort' => 'Int',
    ];

    private static $has_one = [
        'Image' => Image::class,
        'CTALink' => Link::class,
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
        $fields->removeByName(['SliderID', 'Sort', 'CTALinkID']);

        $fields->addFieldsToTab('Root.Main', [
            HTMLEditorField::create('Content')->setRows(8),
            UploadField::create('Image')->setFolderName(self::IMAGE_DIR),
            LinkField::create('CTALink', 'Link', $this),
        ]);

        return $fields;
    }
}
