<?php

class Home extends Page
{

}

class HomeController extends PageController
{
    private static $allowed_actions = [
        'quote'
    ];

    public function index()
    {
        $aboutUs = Page::get()->filter([
            'ClassName' => 'AboutPage'
        ])->first();

        $service = Page::get()->filter([
            'ClassName' => 'ServicePage'
        ])->first();

        return $this->customise([
            'Layout' => $this->customise([
                'AboutUs' => $aboutUs,
                'Service' => $service,
                'ServiceCust' => Service::get(),
            ])->renderWith('Layout/Home'),
            'Slider' => Slider::get(),
            'Product' => Product::get(),
            'ShowBanner' => true,
            'Segment' => '/'
        ])->renderWith('Page');
    }

    public function quote()
    {
        return $this->customise([
            'Layout' => $this->renderWith('Layout/Quote'),
            'ShowBanner' => false
        ])->renderWith('Page');
    }
}
