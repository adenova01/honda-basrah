<?php

use SilverStripe\Admin\ModelAdmin;

class EmailDataAdmin extends ModelAdmin
{
    private static $menu_title = 'Saved Email';
    private static $url_segment = 'saved-email';
    private static $managed_models = [
        EmailData::class
    ];
}
