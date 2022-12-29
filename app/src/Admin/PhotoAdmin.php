<?php

namespace Coxy\Website\Admin;

use Coxy\Website\Models\Photo;
use Coxy\Website\Models\PhotoAlbum;
use SilverStripe\Admin\ModelAdmin;
use SilverStripe\Forms\GridField\GridFieldConfig;
use SilverStripe\Forms\GridField\GridFieldExportButton;
use SilverStripe\Forms\GridField\GridFieldImportButton;
use SilverStripe\Forms\GridField\GridFieldPrintButton;

/**
 * Class \Coxy\Website\Admin\PhotoAdmin
 *
 */
class PhotoAdmin extends ModelAdmin
{
    private static $menu_title = 'Photos';
    private static $url_segment = 'photos';

    private static $managed_models = [
        PhotoAlbum::class,
        Photo::class,
    ];

    protected function getGridFieldConfig(): GridFieldConfig
    {
        $config = parent::getGridFieldConfig();

        $config->removeComponentsByType([
            GridFieldImportButton::class,
            GridFieldExportButton::class,
            GridFieldPrintButton::class,
        ]);

        return $config;
    }
}
