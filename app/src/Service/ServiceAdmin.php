<?php

use SilverStripe\Admin\ModelAdmin;

class ServiceAdmin extends ModelAdmin
{
    private static $url_segment = 'service';
    private static $menu_title = 'Service';
    private static $managed_models = [
        Service::class
    ];
}
