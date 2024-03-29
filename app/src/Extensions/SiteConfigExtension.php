<?php

namespace Coxy\Website\Extensions;

use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TabSet;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\FieldType\DBField;

/**
 * Class \Coxy\Website\Extensions\SiteConfigExtension
 *
 * @property string $CompanyName
 * @property string $ContactEmail
 * @property string $ContactPhone
 * @property string $ContactMobile
 * @property string $ContactFax
 * @property string $OpenHours
 * @property string $CompanyAddress
 * @property string $CompanyAddress2
 * @property string $CompanyCity
 * @property string $CompanyState
 * @property string $CompanyPostalCode
 * @property string $CompanyCountry
 * @property string $FacebookUrl
 * @property string $TwitterUrl
 * @property string $InstagramUrl
 * @property string $LinkedinUrl
 * @property string $YouTubeUrl
 * @property string $SpotifyUrl
 * @property int $LogoID
 * @property int $IconID
 * @method \SilverStripe\Assets\Image Logo()
 * @method \SilverStripe\Assets\Image Icon()
 */
class SiteConfigExtension extends DataExtension
{
    const IMAGE_DIR = 'Uploads' . DIRECTORY_SEPARATOR . 'branding';

    private static $db = [
        'CompanyName' => 'Varchar',
        'ContactEmail' => 'Varchar',
        'ContactPhone' => 'Varchar',
        'ContactMobile' => 'Varchar',
        'ContactFax' => 'Varchar',
        'OpenHours' => 'Text',

        'CompanyAddress' => 'Varchar',
        'CompanyAddress2' => 'Varchar',
        'CompanyCity' => 'Varchar(64)',
        'CompanyState' => 'Varchar(64)',
        'CompanyPostalCode' => 'Varchar(10)',
        'CompanyCountry' => 'Varchar(64)',

        'FacebookUrl' => 'Varchar',
        'TwitterUrl' => 'Varchar',
        'InstagramUrl' => 'Varchar',
        'LinkedinUrl' => 'Varchar',
        'YouTubeUrl' => 'Varchar',
        'SpotifyUrl' => 'Varchar',
    ];

    private static $has_one = [
        'Logo' => Image::class,
        'Icon' => Image::class
    ];

    private static $owns = [
        'Logo',
        'Icon',
    ];

    public function updateCMSFields(FieldList $fields)
    {
        // Logo and Favicon
        $logoField = UploadField::create('Logo', 'Logo')->setFolderName(self::IMAGE_DIR);
        $faviconField = UploadField::create('Icon', 'Favicon')->setFolderName(self::IMAGE_DIR);

        $logoField->getValidator()->setAllowedExtensions(
            ['jpg', 'jpeg', 'png', 'gif', 'svg']
        );

        $faviconField->getValidator()->setAllowedExtensions(
            ['ico', 'png']
        );

        $fields->addFieldsToTab('Root.Main', [
            $logoField,
            $faviconField
        ]);

        // Company info and social media
        if (!$fields->fieldByName('Root.General')) {
            $fields->insertAfter(TabSet::create('General'), 'Main');
        }

        $fields->addFieldsToTab('Root.General.Data', [
            TextField::create('CompanyName', 'Company Name'),
            TextField::create('ContactEmail', 'Contact Email'),
            TextField::create('ContactPhone', 'Contact Phone'),
            TextField::create('ContactMobile', 'Contact Mobile'),
            TextField::create('ContactFax', 'Contact Fax'),
            TextareaField::create('OpenHours', 'Open Hours'),
        ]);

        $fields->addFieldsToTab('Root.General.Address', [
            TextField::create('CompanyAddress', 'Company Address'),
            TextField::create('CompanyAddress2', 'Company Address 2'),
            TextField::create('CompanyCity', 'Company City'),
            TextField::create('CompanyState', 'Company State'),
            TextField::create('CompanyPostalCode', 'Company Postal Code'),
            TextField::create('CompanyCountry', 'Company Country'),
        ]);

        $fields->addFieldsToTab('Root.General.SocialMedia', [
            TextField::create('FacebookUrl', 'Facebook URL'),
            TextField::create('TwitterUrl', 'Twitter URL'),
            TextField::create('InstagramUrl', 'Instagram URL'),
            TextField::create('LinkedinUrl', 'Linkedin URL'),
            TextField::create('YouTubeUrl', 'YouTube URL'),
            TextField::create('SpotifyUrl', 'Spotify URL'),
        ]);
    }

    public function getFullAddress()
    {
        $parts = [
            $this->owner->CompanyAddress,
            $this->owner->CompanyAddress2,
            $this->owner->CompanyCity,
            $this->owner->CompanyState,
            $this->owner->CompanyPostalCode,
            $this->owner->CompanyCountry
        ];

        return implode(', ', array_filter($parts));
    }

    public function getFullAddressFormatted()
    {
        $parts = [
            $this->owner->CompanyAddress,
            $this->owner->CompanyAddress2,
            $this->owner->CompanyCity . ' ' . $this->owner->CompanyPostalCode,
            $this->owner->CompanyState,
            $this->owner->CompanyCountry
        ];

        $results = implode('<br/>', array_filter($parts));
        return DBField::create_field('HTMLText', $results);
    }
}
