<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Auth extends REST_Controller
{
    private $postData;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->postData = $this->request->body;
    }

    /**
     * URL: http://localhost/auth/token
     * Method: GET
     */

    public function token_get()
    {
        $tokenData = array();
        $tokenData['id'] = 1; //TODO: Replace with data for token
        $output['token'] = AUTHORIZATION::generateToken($tokenData);
        $this->set_response($output, REST_Controller::HTTP_OK);
    }

    /**
     * URL: http://localhost/auth/token
     * Method: POST
     * Header Key: Authorization
     * Value: Auth token generated in GET call
     */
    public function token_post()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $this->set_response($decodedToken, REST_Controller::HTTP_OK);
                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    public function signup_post() {
       
        if(isset( $this->postData['email']) && isset( $this->postData['password']) && isset( $this->postData['c_password'])) {
            $this->postData['email'] = filter_var($this->postData['email'], FILTER_VALIDATE_EMAIL);
            if( $this->postData['email'] == '') {
                $returnData['success'] = false;
                $returnData['msg'] = "Email is not valid!";
                $this->set_response($returnData, REST_Controller::HTTP_BAD_REQUEST);
            }
            
            if( $this->postData['password'] !=  $this->postData['c_password']) {
                $returnData['success'] = false;
                $returnData['msg'] = "Password is not matched!";
                $this->set_response($returnData, REST_Controller::HTTP_BAD_REQUEST);
            }

            if($this->user_model->checkEmailExist( $this->postData['email'])) {
                $returnData['success'] = false;
                $returnData['msg'] = "This email is exist already!";
                $this->set_response($returnData, REST_Controller::HTTP_BAD_REQUEST);
            } else {
                $user['user_email'] = $this->postData['email'];
                $user['user_password'] = getHashedPassword( $this->postData['password']);

                $user_id = $this->user_model->addNewUser($user);
                
                if($user_id) {
                    $returnData['success'] = true;
                    $returnData['msg'] = "User is registered successfully!";
                    $this->set_response($returnData, REST_Controller::HTTP_OK);
                } else {
                    $returnData['success'] = false;
                    $returnData['msg'] = "Database Error!";
                    $this->set_response($returnData, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }
            }

        } else {
            $returnData['success'] = false;
            $returnData['msg'] = "Please input all register information.";
            $this->set_response($returnData, REST_Controller::HTTP_BAD_REQUEST);
        }

      
        
        
    }
}