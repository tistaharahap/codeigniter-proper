<?php

@include_once(APPPATH . 'core/Test_Controller' . EXT);

class Welcome extends Test_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        echo "Tester";
    }

}
