<?php

use SilverStripe\Assets\Image;

class KatalogImage extends Image
{
    private static $has_one = [
        'Katalog' => Katalog::class
    ];
}
