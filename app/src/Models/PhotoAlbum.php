<?php

namespace Coxy\Website\Models;

use Colymba\BulkUpload\BulkUploader;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\ORM\DataObject;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * Class \Coxy\Website\Models\PhotoAlbum
 *
 * @property string $Title
 * @property string $Description
 * @property int $AlbumCoverID
 * @method \SilverStripe\Assets\Image AlbumCover()
 * @method \SilverStripe\ORM\DataList|\Coxy\Website\Models\Photo[] Photos()
 */
class PhotoAlbum extends DataObject
{
    private static $singular_name = 'Photo Album';
    private static $plural_name = 'Photo Albums';
    private static $description = 'Album of photos';
    private static $table_name = 'PhotoAlbum';

    private static $db = [
        'Title' => 'Varchar',
        'Description' => 'HTMLText',
    ];

    private static $has_one = [
        'AlbumCover' => Image::class,
    ];

    private static $has_many = [
        'Photos' => Photo::class,
    ];

    private static $owns = [
        'AlbumCover',
        'Photos',
    ];

    private static $cascade_delete = [
        'Photos',
    ];

    private static $summary_fields = [
        'CoverPhoto.CMSThumbnail' => 'Album Cover',
        'Title' => 'Title',
        'Description.Summary' => 'Description',
        'Photos.Count' => 'Photos',
    ];

    private static $searchable_fields = [
        'Title',
        'Description',
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldsToTab('Root.Main', [
            HTMLEditorField::create('Description')->setRows(8),
            UploadField::create('AlbumCover', 'Album Cover')
                ->setFolderName(Photo::IMAGE_DIR)
                ->setDescription('Will use the first photo in the album if left blank'),
        ]);

        if ($this->exists()) {
            $config = $fields->fieldByName('Root.Photos.Photos')->getConfig();
            $config->removeComponentsByType([
                GridFieldAddExistingAutocompleter::class,
            ]);
            $config->addComponents([
                $bulkUpload = new BulkUploader(),
                GridFieldOrderableRows::create('Sort'),
            ]);
            $bulkUpload->setUfSetup('setFolderName', Photo::IMAGE_DIR);
        } else {
            $fields->addFieldToTab(
                'Root.Main',
                LiteralField::create(
                    'info',
                    '<p class="alert alert-info">Save album to add photos</p>'
                )
            );
        }

        return $fields;
    }

    public function getCoverPhoto()
    {
        if ($this->AlbumCover()->exists())
            return  $this->AlbumCover();
        elseif ($this->Photos()->count() > 0)
            return $this->Photos()->first()->Image();
        else
            return null;
    }
}
