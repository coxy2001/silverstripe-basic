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

        'CompanyAddress' => 'Varchar(255)',
        'CompanyAddress2' => 'Varchar(255)',
        'CompanyCity' => 'Varchar(64)',
        'CompanyState' => 'Varchar(64)',
        'CompanyPostalCode' => 'Varchar(10)',
        'CompanyCountry' => 'Varchar(64)',

        'FacebookUrl' => 'Varchar(255)',
        'TwitterUrl' => 'Varchar(255)',
        'InstagramUrl' => 'Varchar(255)',
        'YouTubeUrl' => 'Varchar(255)',
        'SpotifyUrl' => 'Varchar(255)'
    ];

    private static $has_one = array(
        'Logo' => Image::class,
        'Icon' => Image::class
    );

    private static $owns = ['Logo', 'Icon'];

    public function updateCMSFields(FieldList $fields)
    {
        // Logo and Favicon
        $logoField = new UploadField(
            $name = 'Logo',
            $title = 'Logo'
        );

        $faviconField = new UploadField(
            $name = 'Icon',
            $title = 'Favicon'
        );

        $logoField->getValidator()->setAllowedExtensions(
            array('jpg', 'jpeg', 'png', 'gif', 'svg')
        );

        $faviconField->getValidator()->setAllowedExtensions(
            array('ico', 'png')
        );

        $logoField->setFolderName(self::IMAGE_DIR);
        $faviconField->setFolderName(self::IMAGE_DIR);

        $fields->addFieldsToTab(
            "Root.Main",
            array(
                $logoField,
                $faviconField
            )
        );

        // Company info and social media
        if (!$fields->fieldByName('Root.General')) {
            $fields->insertAfter(new TabSet('General'), 'Main');
        }

        $fields->addFieldsToTab(
            "Root.General.Data",
            array(
                TextField::create("CompanyName", "Company Name"),
                TextField::create("ContactEmail", "Contact Email"),
                TextField::create("ContactPhone", "Contact Phone"),
                TextField::create("ContactMobile", "Contact Mobile"),
                TextField::create("ContactFax", "Contact Fax"),
                TextareaField::create("OpenHours", "Open Hours")
            )
        );

        $fields->addFieldsToTab(
            'Root.General.Address',
            [
                TextField::create('CompanyAddress'),
                TextField::create('CompanyAddress2', 'Company address 2'),
                TextField::create('CompanyCity'),
                TextField::create('CompanyState'),
                TextField::create('CompanyPostalCode'),
                TextField::create("CompanyCountry")
            ]
        );

        $fields->addFieldsToTab(
            "Root.General.SocialMedia",
            array(
                TextField::create("FacebookUrl", "Facebook Url"),
                TextField::create("TwitterUrl", "Twitter Url"),
                TextField::create("InstagramUrl", "Instagram Url"),
                TextField::create("YouTubeUrl", "YouTube Url"),
                TextField::create("SpotifyUrl", "Spotify Url")
            )
        );
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
