<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class User extends REST_Controller
{
    private $postData;
    private $header;

    public function __construct()
    {
        parent::__construct();
        
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } 

        $this->load->model('user_model');
        $this->postData = $this->request->body;
        $this->headers = $this->input->request_headers();
    }

    /**
    * URL: /admin/user
    * Method: Get
    * Detail: get the admin profile.
    */

    public function index_get() {
        $headers = $this->input->request_headers();

        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        
        $admin_user = $this->user_model->getUserById($decodedToken->user_id);

        $this->set_response($admin_user, REST_Controller::HTTP_OK);
    }    
}