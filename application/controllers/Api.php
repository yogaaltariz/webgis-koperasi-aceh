<?php

class Api extends MY_Controller {

    public function __construct() {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, OPTIONS, POST");
        parent::__construct();

        $this->load->model('KoperasiModel','koperasi');
    }

    public function arrToFeatures ($arr) {
        for ($i=0; $i < sizeof($arr); $i++) { 
            $features[$i] = [
                'type'  => 'Feature',
                'properties' => $arr[$i],
                'geometry'  => [
                    'type' => 'Point',
                    'coordinates' => [
                        floatval($arr[$i]->lon),
                        floatval($arr[$i]->lat)
                    ]
                ]
            ];
        }

        return $features ?? [];
    }

    public function koperasi () {

        $koperasi = $this->koperasi->getAllKoperasi();

        $data['type'] ="FeatureCollection";
        $data['features'] = $this->arrToFeatures($koperasi);
        
        $this->sendJson($data);
    }

    public function city() {
        $query = $this->input->get('q');

        $data['result'] = $this->koperasi->searchCity($query);

        $this->sendJson($data);
    }
}