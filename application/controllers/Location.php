<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Location extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();       
        $this->load->model('location_model');
    }

    public function countries_get() {
        $data = $this->location_model->getCountries();
        $this->set_response($data, REST_Controller::HTTP_OK);
    }

    public function states_get($country_id) {
        $data = $this->location_model->getStates($country_id);
        $this->set_response($data, REST_Controller::HTTP_OK);
    }

    public function cities_get($state_id) {
        $data = $this->location_model->getCities($state_id);
        $this->set_response($data, REST_Controller::HTTP_OK);
    }
}