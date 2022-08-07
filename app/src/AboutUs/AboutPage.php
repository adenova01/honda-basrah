<?php

use SilverStripe\Forms\TextField;

class AboutPage extends Page
{
    private static $db = [
        'Text' => 'HTMLText'
    ];

    /**
     * CMS Fields
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Text','Text')
        ], 'Content');
        return $fields;
    }
}

class AboutPageController extends PageController
{
    public function index()
    {
        $aboutUs = Page::get()->filter([
            'ClassName' => 'AboutPage'
        ])->first();
        return $this->customise([
            'Layout' => $this->customise([
                'AboutUs' => $aboutUs
            ])->renderWith('Layout/About'),
            'Segment' => 'about'
        ])->renderWith('Page');
    }
}
