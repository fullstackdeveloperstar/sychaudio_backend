<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Filteroption extends REST_Controller
{
    private $postData;
    private $header;

    public function __construct()
    {
        parent::__construct();       
        $this->load->model('filteropt_model');
        $this->postData = $this->request->body;
        $this->headers = $this->input->request_headers();
    }

    public function getallfilteroptions_get() {
        $data['mood'] = $this->filteropt_model->getFilterOptionsByWhere(array(), $this->filteropt_model->table_mood);
        $data['genre'] = $this->filteropt_model->getFilterOptionsByWhere(array(), $this->filteropt_model->table_genre);
        $data['pace'] = $this->filteropt_model->getFilterOptionsByWhere(array(), $this->filteropt_model->table_pace);
        $data['instrument'] = $this->filteropt_model->getFilterOptionsByWhere(array(), $this->filteropt_model->table_instruments);
        $data['key'] = $this->filteropt_model->getFilterOptionsByWhere(array(), $this->filteropt_model->table_key);

        $this->set_response($data, REST_Controller::HTTP_OK);
    }

    public function filteroption_delete($type, $id)
    {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $id;
            switch($type) {
                case 'mood':
                    $where['mood_id'] = $id;
                    $this->filteropt_model->delete($where, 'tbl_mood');
                    break;
                case 'genre':
                    $where['genre_id'] = $id;
                    $this->filteropt_model->delete($where, 'tbl_genre');
                    break;
                case 'pace':
                    $where['pace_id'] = $id;
                    $this->filteropt_model->delete($where, 'tbl_pace');
                    break;
                case 'inst':
                    $where['inst_id'] = $id;
                    $this->filteropt_model->delete($where, 'tbl_instruments');
                    break;
            }

            $this->set_response($id, REST_Controller::HTTP_OK);
        }
    }

    public function filteroption_post($type)
    {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $id;
            switch($type) {
                case 'mood':
                    $data['mood_title'] = $this->postData['filter_title'];
                    $id = $this->filteropt_model->add($data, 'tbl_mood');
                    break;
                case 'genre':
                    $data['genre_title'] = $this->postData['filter_title'];
                    $id = $this->filteropt_model->add($data, 'tbl_genre');
                    break;
                case 'pace':
                    $data['pace_title'] = $this->postData['filter_title'];
                    $id = $this->filteropt_model->add($data, 'tbl_pace');
                    break;
                case 'inst':
                    $data['inst_title'] = $this->postData['filter_title'];
                    $id = $this->filteropt_model->add($data, 'tbl_instruments');
                    break;
            }

            $this->set_response($id, REST_Controller::HTTP_OK);
        }
    }

    public function filteroption_patch($type, $id)
    {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $id;
            switch($type) {
                case 'mood':
                    $data['mood_title'] = $this->postData['filter_title'];
                    $where['mood_id'] = $id;
                    $this->filteropt_model->update($data, $where, 'tbl_mood');
                    break;
                case 'genre':
                    $data['genre_title'] = $this->postData['filter_title'];
                    $where['genre_id'] = $id;
                    $this->filteropt_model->update($data, $where, 'tbl_genre');
                    break;
                case 'pace':
                    $data['pace_title'] = $this->postData['filter_title'];
                    $where['pace_id'] = $id;
                    $this->filteropt_model->update($data, $where, 'tbl_pace');
                    break;
                case 'inst':
                    $data['inst_title'] = $this->postData['filter_title'];
                    $where['inst_id'] = $id;
                    $this->filteropt_model->update($data, $where, 'tbl_instruments');
                    break;
            }

            $this->set_response($id, REST_Controller::HTTP_OK);
        }
    }

}