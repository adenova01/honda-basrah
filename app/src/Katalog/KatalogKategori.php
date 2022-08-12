<?php

use SilverStripe\ORM\DataObject;

class KatalogKategori extends DataObject
{
    private static $db = [
        'Title' => 'Varchar'
    ];

    private static $has_many = [
        'Katalog' => Katalog::class
    ];
}
