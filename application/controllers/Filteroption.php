<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Filteroption extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();       
        $this->load->model('filteropt_model');
    }

    public function getallfilteroptions_get() {
        $data['mood'] = $this->filteropt_model->getFilterOptionsByWhere(array(), $this->filteropt_model->table_mood);
        $data['genre'] = $this->filteropt_model->getFilterOptionsByWhere(array(), $this->filteropt_model->table_genre);
        $data['pace'] = $this->filteropt_model->getFilterOptionsByWhere(array(), $this->filteropt_model->table_pace);
        $data['instrument'] = $this->filteropt_model->getFilterOptionsByWhere(array(), $this->filteropt_model->table_instruments);
        $data['key'] = $this->filteropt_model->getFilterOptionsByWhere(array(), $this->filteropt_model->table_key);

        $this->set_response($data, REST_Controller::HTTP_OK);
    }

}