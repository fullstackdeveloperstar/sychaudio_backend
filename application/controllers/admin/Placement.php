<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Placement extends REST_Controller
{
    private $postData;
    private $header;

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('placement_model');
        $this->load->model('artist_model');
        $this->postData = $this->request->body;
        $this->headers = $this->input->request_headers();
    }

    public function placements_get()
    {
        $where = array(
            'is_deleted' => '0'
        );

        $placements = $this->placement_model->getByWhere($where);
        $return_data = [];
        foreach($placements as $placement) {

            $placement['artist'] = $this->artist_model->getArtistById($placement['placement_artist']);
            $return_data[] = $placement;
        }
        
        $this->set_response($return_data, REST_Controller::HTTP_OK);
    }

    public function placement_post() {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $placement_data['placement_artist'] = $this->postData['placement_artist'];
            $placement_data['placement_title'] = $this->postData['placement_title'];
            $placement_data['placement_poster'] = $this->postData['placement_poster'];
            $placement_data['placement_youtube'] = $this->postData['placement_youtube'];
            $placement_data['placement_linkto'] = $this->postData['placement_linkto'];
            $placement_data['placement_description'] = $this->postData['placement_description'];
            $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            $placement_data['created_datetime'] =  mdate($datestring, $time);

            $placement_id = $this->placement_model->add($placement_data);
            if($placement_id) {
                $this->set_response($placement_data, REST_Controller::HTTP_OK);    
            } else {
                $this->set_response($placement_data, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);    
            }
        }
    }

    public function placement_patch($placement_id) {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $where = array(
                'placement_id' => $placement_id
            );

            $placement_data['placement_artist'] = $this->postData['placement_artist'];
            $placement_data['placement_title'] = $this->postData['placement_title'];
            $placement_data['placement_poster'] = $this->postData['placement_poster'];
            $placement_data['placement_youtube'] = $this->postData['placement_youtube'];
            $placement_data['placement_linkto'] = $this->postData['placement_linkto'];
            $placement_data['placement_description'] = $this->postData['placement_description'];

            $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            $placement_data['updated_datetime'] =  mdate($datestring, $time);

            $this->placement_model->update($placement_data, $where);

            $this->set_response($placement_data, REST_Controller::HTTP_OK);
        }
    }

    public function placement_delete($placement_id) {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $where = array(
                'placement_id' => $placement_id
            );

            $placement_data['is_deleted'] = '1';
            $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            $placement_data['deleted_datetime'] =  mdate($datestring, $time);

            $this->placement_model->update($placement_data, $where);

            $this->set_response($placement_data, REST_Controller::HTTP_OK);
        }
    }
}