<?php

class MY_Controller extends CI_Controller {

    protected $CI;

    function __construct() {
        parent::__construct();

        $this->CI =& get_instance();
    }

}
