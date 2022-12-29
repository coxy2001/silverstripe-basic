<?php

namespace Coxy\Website\Admin;

use Coxy\Website\Models\Photo;
use Coxy\Website\Models\PhotoAlbum;
use SilverStripe\Admin\ModelAdmin;

/**
 * Class \Coxy\Website\Admin\PhotoAdmin
 *
 */
class PhotoAdmin extends ModelAdmin
{
    private static $menu_title = 'Photo';
    private static $url_segment = 'photo';

    private static $managed_models = [
        PhotoAlbum::class,
        Photo::class,
    ];
}
