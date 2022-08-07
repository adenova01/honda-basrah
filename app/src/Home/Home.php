<?php

class Home extends Page {

}

class HomeController extends PageController {
    private static $allowed_actions = [

    ];

    public function index()
    {
        return $this->customise([
            'Layout' => $this->renderWith('Layout/Home')
        ])->renderWith('Page');
    }
}
