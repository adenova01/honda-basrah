<?php

use SilverStripe\Admin\ModelAdmin;

class SliderAdmin extends ModelAdmin
{
    private static $url_segment = "slider-banner";
    private static $title = "Banner Slider";
    private static $managed_models = [
        Slider::class
    ];
}
