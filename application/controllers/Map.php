<?php

class Map extends MY_Controller {

    public function __construct() {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        parent::__construct();
    }

    public function index() {
        $this->load->View('map/dashboard.html');
    }

    public function example () {
        $this->sendJson(['success' => true]);
    }
}