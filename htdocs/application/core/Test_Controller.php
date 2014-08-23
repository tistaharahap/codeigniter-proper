<?php

class Test_Controller extends MY_Controller {

    var $http_client;

    function __construct() {
        parent::__construct();

        $this->CI->load->library('input');

        if(!$this->CI->input->is_cli_request()) {
            throw new TestException('This can only be ran from the CLI');
        }


    }

    protected function set_up() {
        $this->http_client = new Buzz\Browser();
    }

    protected function destroy() {
        $this->http_client = NULL;
    }

    protected function get($url, $headers = []) {
        return $this->http_client->get($url, $headers);
    }

}
