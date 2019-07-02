<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class About extends REST_Controller
{
    private $postData;
    private $header;

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('about_model');
        $this->postData = $this->request->body;
        $this->headers = $this->input->request_headers();
    }

    public function index_get() {
        $about = $this->about_model->get();
        $this->set_response($about, REST_Controller::HTTP_OK);
    }

    public function index_post()
    {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $about = $this->postData;
           
            $this->about_model->save($about);
            $this->set_response($about, REST_Controller::HTTP_OK);
        }
    }
}