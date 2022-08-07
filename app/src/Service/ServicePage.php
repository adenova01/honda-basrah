<?php

use SilverStripe\Forms\TextField;

class ServicePage extends Page
{
    private static $db = [
        'Text' => 'Varchar'
    ];

    /**
     * CMS Fields
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Text', 'Text')
        ], 'Content');
        return $fields;
    }
}

class ServicePageController extends PageController
{

}
