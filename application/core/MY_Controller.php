<?php

class MY_Controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function sendJson($arr,$status_code = 200){
		return $this->output
			->set_status_header($status_code)
            ->set_content_type('application/json')
            ->set_output(json_encode($arr));
	}
}