<?php

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\DB;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\View\Parsers\HTMLValue;

class Katalog extends DataObject
{
    private static $db = [
        'Title' => 'Varchar',
        'Text' => 'HTMLText',
    ];

    private static $has_many = [
        'KatalogImage' => KatalogImage::class,
    ];

    private static $has_one = [
        'KatalogKategori' => KatalogKategori::class
    ];

    private static $summary_fields = [
        'Title',
        'getTextValue' => 'Text',
        'thumnailImage' => 'Image'
    ];

    public function getTextValue()
    {
        return DBField::create_field('HTMLText', $this->Text);
    }

    public function thumnailImage()
    {
        foreach ($this->KatalogImage()->limit(1) as $item) {
            return $item->ScaleWidth(200);
        }
    }

    public function getCreatedFormat()
    {
        return date('d M y', strtotime($this->Created));
    }

    /**
     * CMS Fields
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldsToTab('Root.Main',
        [
            TextField::create('Title'),
            HTMLEditorField::create('Text'),
            $imageKatalog = UploadField::create('KatalogImage')
        ]);
        $imageKatalog->setFolderName('ImageKatalog');
        $imageKatalog->getValidator()->setAllowedExtensions(['jpg','png','jpeg']);
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
        foreach ($this->KatalogImage() as $key => $value) {
            if($value->exists() && !$value->isPublished())
            {
                $value->doPublish();
            }
        }
    }
}
