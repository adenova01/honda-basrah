<?php

use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\View\Parsers\HTMLValue;
use BucklesHusky\FontAwesomeIconPicker\Forms\FAPickerField;
use SilverStripe\Forms\TextField;

class Service extends DataObject
{
    private static $db = [
        'Title' => 'Varchar',
        'Text' => 'Varchar',
        'Icon' => 'Varchar'
    ];

    private static $summary_fields = [
        'Title',
        'Text',
        'Icon'
    ];

    public function getIconFont()
    {
        return strip_tags($this->Icon);
    }

    /**
     * CMS Fields
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName(['Text','Icon']);
        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Text', 'Text'),
            FAPickerField::create('Icon', 'Pick Icon')
        ], 'Icon');
        return $fields;
    }
}
