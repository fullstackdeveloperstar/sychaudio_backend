<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Contact extends REST_Controller
{
    private $postData;
    private $header;

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('contact_model');
        $this->postData = $this->request->body;
        $this->headers = $this->input->request_headers();
    }

    public function index_get() {
        $contact = $this->contact_model->get();
        $this->set_response($contact, REST_Controller::HTTP_OK);
    }

    public function index_post()
    {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $contact = $this->postData;
           
            $this->contact_model->save($contact);
            $this->set_response($contact, REST_Controller::HTTP_OK);
        }
    }
}