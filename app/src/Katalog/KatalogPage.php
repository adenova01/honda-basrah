<?php

use SilverStripe\Forms\TextField;

class KatalogPage extends Page
{
    private static $db = [
        'Text' => 'Varchar'
    ];

    static function randomNumber()
    {
        return rand(1, 6);
    }

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
    private static $allowed_actions = [
        'detil',
        'search'
    ];

    public function index()
    {
        if(isset($_REQUEST['cat']))
        {
            $catId = $_REQUEST['cat'];
            $KatCat = KatalogKategori::get()->filter([
                'Title' => $catId
            ])->first();

            $katalogKategori = Katalog::get()->filter([
                'KatalogKategoriID' => $KatCat->ID
            ]);

            return $this->customise([
                'Layout' => $this->customise([
                    'Katalog' => $katalogKategori,
                    'KatalogKategori' => KatalogKategori::get()
                ])->renderWith('Layout/Katalog'),
                'Segment' => 'katalog'
            ])->renderWith('Page');

        } else {

            return $this->customise([
                'Layout' => $this->customise([
                    'Katalog' => Katalog::get(),
                    'KatalogKategori' => KatalogKategori::get()
                ])->renderWith('Layout/Katalog'),
                'Segment' => 'katalog'
            ])->renderWith('Page');
        }
    }

    public function detil()
    {
        $urlSegment = $this->request->param('ID');
        $katalogDetil = Katalog::get()->filter([
            'URLSegment' => $urlSegment
        ])->first();

        return $this->customise([
            'Layout' => $this->customise([
                'KatalogDetil' => $katalogDetil,
                'KatalogKategori' => KatalogKategori::get()
            ])->renderWith('Layout/KatalogDetil'),
            'Segment' => 'katalog'
        ])->renderWith('Page');
    }

    public function search()
    {
        if(isset($_REQUEST['k']))
        {
            $k = $_REQUEST['k'];
            $katalogFilter = Katalog::get()->filter([
                'Title:PartialMatch' => $k
            ]);

            return $this->customise([
                'Layout' => $this->customise([
                    'Katalog' => $katalogFilter,
                    'KatalogKategori' => KatalogKategori::get()
                ])->renderWith('Layout/Katalog'),
                'Segment' => 'katalog'
            ])->renderWith('Page');
        }
    }
}
