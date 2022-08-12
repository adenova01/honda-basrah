<?php

use SilverStripe\Admin\ModelAdmin;

class KatalogAdmin extends ModelAdmin
{
    private static $menu_title = "Katalog";
    private static $url_segment = "katalog";
    private static $managed_models =
    [
        Katalog::class,
        KatalogKategori::class
    ];
}
