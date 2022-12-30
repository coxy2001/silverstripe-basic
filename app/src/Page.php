<?php

use SilverStripe\CMS\Model\SiteTree;

/**
 * Class \Page
 *
 * @property int $ElementalAreaID
 * @method \DNADesign\Elemental\Models\ElementalArea ElementalArea()
 * @mixin \DNADesign\Elemental\Extensions\ElementalPageExtension
 */
class Page extends SiteTree
{
    private static $db = [];

    private static $has_one = [];
}
