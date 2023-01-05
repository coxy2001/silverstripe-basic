<?php

use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\View\Requirements;

/**
 * Class \PageController
 *
 * @property \Page $dataRecord
 * @method \Page data()
 * @mixin \Page
 */
class PageController extends ContentController
{
    /**
     * An array of actions that can be accessed via a request. Each array element should be an action name, and the
     * permissions or conditions required to allow the user to access it.
     *
     * <code>
     * [
     *     'action', // anyone can access this action
     *     'action' => true, // same as above
     *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
     *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
     * ];
     * </code>
     *
     * @var array
     */
    private static $allowed_actions = [];

    protected function init()
    {
        parent::init();

        Requirements::css('coxy2001/silverstripe-elements:client/css/splide-core.min.css');
        Requirements::themedCSS('css/style');

        Requirements::javascript('coxy2001/silverstripe-elements:client/js/splide.min.js');
        Requirements::themedJavascript('js/main');
    }
}
