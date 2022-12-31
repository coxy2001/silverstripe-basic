<?php

namespace Coxy\Website\Elements;

use Colymba\BulkUpload\BulkUploader;
use Coxy\Website\Models\ImageSlide;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * Class \Coxy\Website\Elements\ElementImageSlider
 *
 * @property string $SlideHeight
 * @method \SilverStripe\ORM\DataList|\Coxy\Website\Models\ImageSlide[] Slides()
 */
class ElementImageSlider extends BaseElement
{
    private static $singular_name = 'Image Slider';
    private static $plural_name = 'Image Sliders';
    private static $description = 'Multiple images sliding on a carousel';
    private static $table_name = 'ElementImageSlider';
    private static $icon = 'font-icon-block-carousel';
    private static $inline_editable = false;
    private static $element_class = 'image-slider';

    private static $db = [
        'SlideHeight' => 'Varchar(16)',
    ];

    private static $has_many = [
        'Slides' => ImageSlide::class,
    ];

    private static $owns = [
        'Slides'
    ];

    private static $cascade_delete = [
        'Slides'
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('Slides');

        $height = DropdownField::create(
            'SlideHeight',
            'Slide Height',
            [
                'small' => 'Small',
                'medium' => 'Medium',
                'large' => 'Large',
            ]
        );

        $config = GridFieldConfig_RecordEditor::create();
        $config->addComponents([
            $bulkUpload = new BulkUploader(),
            GridFieldOrderableRows::create('Sort'),
        ]);
        $bulkUpload->setUfSetup('setFolderName', ImageSlide::IMAGE_DIR);
        $slides = GridField::create('Slides', 'Slides', $this->Slides(), $config);

        $fields->addFieldsToTab('Root.Main', [
            $slides,
            $height,
        ]);

        return $fields;
    }

    public function getType()
    {
        return $this->singular_name();
    }

    public function getSummary()
    {
        $count = $this->Slides()->count();
        return "$count Slides";
    }

    protected function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        if ($this->Slides()->count() > 0) {
            $image = $this->Slides()->first()->Image();
            $blockSchema['fileURL'] = $image->CMSThumbnail()->getURL();
            $blockSchema['fileTitle'] = $image->getTitle();
        }
        $blockSchema['content'] = $this->getSummary();
        return $blockSchema;
    }

    public function updateElementClasses(&$classes)
    {
        $classes['height'] = 'image-slider--' . $this->SlideHeight;
    }
}
