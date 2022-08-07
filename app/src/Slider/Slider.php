<?php

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\FieldType\DBField;

class Slider extends DataObject
{
    private static $db = [
        'Title' => 'Varchar',
        'Text' => 'Varchar'
    ];

    private static $has_one = [
        'ImageSlider' => Image::class
    ];

    private static $summary_fields = [
        'Title',
        'Text',
        'showImageAdmin' => 'Thumnail'
    ];

    public function showImageAdmin()
    {
        return $this->ImageSlider()->ScaleWidth(150);
    }

    /**
     * CMS Fields
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('ImageSlider');
        $fields->addFieldsToTab(
            'Root.Main',
            [
                $upload = UploadField::create('ImageSlider', 'Image Slider')
            ]
        );

        $upload->setFolderName('ImageSlider');
        $upload->getValidator()->setAllowedExtensions(['jpg','png','jpeg']);

        return $fields;
    }

    /**
     * Event handler called before writing to the database.
     *
     * @uses DataExtension->onAfterWrite()
     */
    public function onBeforeWrite()
    {
        parent::onBeforeWrite();
        if(!$this->ImageSlider()->exists() && !$this->ImageSlider()->isPublished())
        {
            $this->ImageSlider()->doPublish();
        }
    }
}
