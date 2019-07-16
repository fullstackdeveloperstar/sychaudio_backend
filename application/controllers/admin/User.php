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
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $headers = $this->input->request_headers();

            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            
            $admin_user = $this->user_model->getUserById($decodedToken->user_id);

            $this->set_response($admin_user, REST_Controller::HTTP_OK);
        }
    }

    public function getallusers_get() {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $where = array(
                'is_deleted' => '0'
            );
            $users = $this->user_model->getUsersByWhere($where);
            $this->set_response($users, REST_Controller::HTTP_OK);
        }
    }

    public function user_patch($user_id) {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $where = array(
                'user_id' => $user_id
            );

            $user_data['user_email'] = $this->postData['user_email'];
            $user_data['user_name'] = $this->postData['user_name'];
            $user_data['is_verified'] = $this->postData['is_verified'];
            $user_data['user_role'] = $this->postData['user_role'];
            $user_data['user_avatar'] = $this->postData['user_avatar'];

            $user_data['user_phone'] = $this->postData['user_phone'];
            $user_data['user_company'] = $this->postData['user_company'];
            $user_data['user_position'] = $this->postData['user_position'];
            $user_data['user_country'] = $this->postData['user_country'];
            $user_data['user_state'] = $this->postData['user_state'];
            $user_data['user_city'] = $this->postData['user_city'];
            $user_data['user_website_url'] = $this->postData['user_website_url'];
            $user_data['user_twitter_url'] = $this->postData['user_twitter_url'];
            $user_data['user_facebook_url'] = $this->postData['user_facebook_url'];
            $user_data['user_linkedin_url'] = $this->postData['user_linkedin_url'];
            $user_data['user_website_url'] = $this->postData['user_website_url'];
            $user_data['user_referred_by'] = $this->postData['user_referred_by'];

            $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            $user_data['updated_datetime'] =  mdate($datestring, $time);

            $this->user_model->updateUser($user_data, $where);

            $this->set_response($user_data, REST_Controller::HTTP_OK);
        }
    }

    public function user_post() {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $user_data['user_email'] = $this->postData['user_email'];
            $user_data['user_name'] = $this->postData['user_name'];
            $user_data['is_verified'] = $this->postData['is_verified'];
            $user_data['user_role'] = $this->postData['user_role'];
            $user_data['user_avatar'] = $this->postData['user_avatar'];

            $user_data['user_phone'] = $this->postData['user_phone'];
            $user_data['user_company'] = $this->postData['user_company'];
            $user_data['user_position'] = $this->postData['user_position'];
            $user_data['user_country'] = $this->postData['user_country'];
            $user_data['user_state'] = $this->postData['user_state'];
            $user_data['user_city'] = $this->postData['user_city'];
            $user_data['user_website_url'] = $this->postData['user_website_url'];
            $user_data['user_twitter_url'] = $this->postData['user_twitter_url'];
            $user_data['user_facebook_url'] = $this->postData['user_facebook_url'];
            $user_data['user_linkedin_url'] = $this->postData['user_linkedin_url'];
            $user_data['user_website_url'] = $this->postData['user_website_url'];
            $user_data['user_referred_by'] = $this->postData['user_referred_by'];

            $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            $user_data['created_datetime'] =  mdate($datestring, $time);

            $user_id = $this->user_model->addNewUser($user_data);
            if($user_id) {
                $this->set_response($user_data, REST_Controller::HTTP_OK);    
            } else {
                $this->set_response($user_data, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);    
            }
        }
    }

    public function user_delete($user_id) {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $where = array(
                'user_id' => $user_id
            );

            $user_data['is_deleted'] = '1';
            $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            $user_data['deleted_datetime'] =  mdate($datestring, $time);

            $this->user_model->updateUser($user_data, $where);

            $this->set_response($user_data, REST_Controller::HTTP_OK);
        }
    }

    public function useravatar_post() {
        $config['upload_path']          = './uploads/user/avatar/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 10000;
        $config['max_width']            = 10240;
        $config['max_height']           = 10240;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('user_avatar'))
        {
            $error = array('error' => $this->upload->display_errors());

            $this->set_response($error, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        else
        {
            $data = $this->upload->data();

            $return_data['url'] = base_url() . 'uploads/user/avatar/' . $data['file_name'];

            $this->set_response($return_data, REST_Controller::HTTP_OK);
        }
    }
}