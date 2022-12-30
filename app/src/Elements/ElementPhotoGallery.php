<?php

namespace Coxy\Website\Elements;

use Bummzack\SortableFile\Forms\SortableUploadField;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Assets\Image;

/**
 * Class \Coxy\Website\Elements\ElementPhotoGallery
 *
 * @method \SilverStripe\ORM\ManyManyList|\SilverStripe\Assets\Image[] Images()
 */
class ElementPhotoGallery extends BaseElement
{
    const IMAGE_DIR = 'Uploads' . DIRECTORY_SEPARATOR . 'gallery';

    private static $singular_name = 'Photo Gallery';
    private static $plural_name = 'Photo Galleries';
    private static $description = 'Gallery of photos';
    private static $table_name = 'ElementPhotoGallery';
    private static $icon = 'font-icon-picture';
    private static $element_class = 'photo-gallery';

    private static $db = [];

    private static $many_many = [
        'Images' => Image::class,
    ];

    private static $many_many_extraFields = [
        'Images' => [
            'Sort' => 'Int'
        ]
    ];

    private static $owns = [
        'Images',
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab(
            'Root.Main',
            SortableUploadField::create('Images')
                ->setSortColumn('Sort')
                ->setFolderName(self::IMAGE_DIR),
        );

        return $fields;
    }

    public function getType()
    {
        return $this->singular_name();
    }

    public function getSummary()
    {
        $itemCount = $this->Images()->count();
        return "$itemCount Images";
    }

    protected function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        if ($this->Images()->count() > 0) {
            $image = $this->Images()->sort('Sort')->first();
            $blockSchema['fileURL'] = $image->CMSThumbnail()->getURL();
            $blockSchema['fileTitle'] = $image->getTitle();
        }
        $blockSchema['content'] = $this->getSummary();
        return $blockSchema;
    }
}
