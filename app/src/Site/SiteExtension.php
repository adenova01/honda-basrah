<?php

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;

class SiteExtension extends DataExtension
{
    private static $db = [
        'Email' => 'Varchar',
        'Phone' => 'Varchar',
        // --------- SMTP --------
        'Host' => 'Varchar',
        'Port' => 'Int',
        'Username' => 'Varchar',
        'Password' => 'Varchar',
        // -------- Sosmed -------
        'Twitter' => 'Varchar',
        'Facebook' => 'Varchar',
        'LinkedIn' => 'Varchar',
        'Instagram' => 'Varchar',
        'Youtube' => 'Varchar',
        // -------- Meta ---------
        'TitleWeb' => 'Varchar',
        'Deskripsi' => 'Text',
        'Keyword' => 'Text'
    ];

    private static $has_one = [
        'PhotoProfile' => Image::class
    ];

    private static $owns = [
        'PhotoProfile'
    ];

    /**
     * Update Fields
     * @return FieldList
     */
    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Email'),
            TextField::create('Phone'),
            $profile = UploadField::create('PhotoProfile')
        ]);

        $profile->setFolderName('PhotoProfile');
        $profile->getValidator()->setAllowedExtensions(['jpg','png','jpeg']);

        $fields->addFieldsToTab('Root.SMTP', [
            TextField::create('Host'),
            TextField::create('Port'),
            TextField::create('Username'),
            TextField::create('Password'),
        ]);

        $fields->addFieldsToTab('Root.Sosmed', [
            TextField::create('Twitter'),
            TextField::create('Facebook'),
            TextField::create('LinkedIn'),
            TextField::create('instagram'),
            TextField::create('Youtube'),
        ]);

        $fields->addFieldsToTab('Root.Meta', [
            TextField::create('TitleWeb'),
            TextareaField::create('Deskripsi'),
            TextField::create('Keyword')
        ]);

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
        if($this->owner->PhotoProfile()->exists() && !$this->owner->PhotoProfile()->isPublished())
        {
            $this->owner->PhotoProfile()->doPublish();
        }
    }
}
