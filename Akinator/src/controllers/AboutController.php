<?php

namespace App\controllers;

class AboutController {
    public function display(){
        $template = "about/about";
        require_once "src/views/layout.phtml";
    }
}
