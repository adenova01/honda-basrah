<?php

use SilverStripe\Forms\TextField;

class KatalogPage extends Page
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
        $fields->remove('Text');
        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Text')
        ], 'Content');
        return $fields;
    }
}

class KatalogPageController extends PageController
{

}
