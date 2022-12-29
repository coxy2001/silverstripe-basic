<?php

namespace Coxy\Website\Models;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;

/**
 * Class \Coxy\Website\Models\Photo
 *
 * @property string $Caption
 * @property int $Sort
 * @property int $ImageID
 * @property int $AlbumID
 * @method \SilverStripe\Assets\Image Image()
 * @method \Coxy\Website\Models\PhotoAlbum Album()
 */
class Photo extends DataObject
{
    const IMAGE_DIR = 'Uploads' . DIRECTORY_SEPARATOR . 'photos';

    private static $singular_name = 'Photo';
    private static $plural_name = 'Photos';
    private static $description = 'Photo with caption';
    private static $table_name = 'Photo';
    private static $default_sort = 'Sort';

    private static $db = [
        'Caption' => 'Varchar',
        'Sort' => 'Int',
    ];

    private static $has_one = [
        'Image' => Image::class,
        'Album' => PhotoAlbum::class,
    ];

    private static $owns = [
        'Image',
    ];

    private static $summary_fields = [
        'Image.CMSThumbnail' => 'Image',
        'Caption' => 'Caption',
    ];

    private static $searchable_fields = [
        'Image.Title',
        'Caption',
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('Sort');

        $fields->insertBefore(
            'Caption',
            UploadField::create('Image')->setFolderName(self::IMAGE_DIR)
        );

        $fields->addFieldsToTab(
            'Root.Main',
            [
                TextField::create('Caption'),
                $fields->fieldByName('Root.Main.AlbumID')
                    ->setDescription('Change the album this photo belongs to')
            ]
        );

        return $fields;
    }
}
