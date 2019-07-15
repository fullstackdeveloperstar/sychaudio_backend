<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Auth extends REST_Controller
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


    /**
    * URL: http://localhost/auth/signup
    * Method: POST
    */

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
                $user['user_token'] = AUTHORIZATION::generateToken($user);

                $user['user_phone'] = $this->postData['user_phone'];
                $user['user_company'] = $this->postData['user_company'];
                $user['user_position'] = $this->postData['user_position'];
                $user['user_country'] = $this->postData['user_country'];
                $user['user_state'] = $this->postData['user_state'];
                $user['user_city'] = $this->postData['user_city'];
                $user['user_website_url'] = $this->postData['user_website_url'];
                $user['user_twitter_url'] = $this->postData['user_twitter_url'];
                $user['user_facebook_url'] = $this->postData['user_facebook_url'];
                $user['user_linkedin_url'] = $this->postData['user_linkedin_url'];
                $user['user_website_url'] = $this->postData['user_website_url'];
                $user['user_referred_by'] = $this->postData['user_referred_by'];

                $user_id = $this->user_model->addNewUser($user);
                
                if($user_id) {
                    $returnData['success'] = true;
                    $returnData['msg'] = "User is registered successfully!";
                    $returnData['user'] = $this->user_model->getUserById($user_id);

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


    public function login_post() {

        if(isset( $this->postData['email']) && isset( $this->postData['password'])) {
            $this->postData['email'] = filter_var($this->postData['email'], FILTER_VALIDATE_EMAIL);
            if( $this->postData['email'] == '') {
                $returnData['success'] = false;
                $returnData['msg'] = "Email is not valid!";
                $this->set_response($returnData, REST_Controller::HTTP_BAD_REQUEST);
            }
            
            $where['user_email'] = $this->postData['email'];
            $users = $this->user_model->getUsersByWhere($where);
            if(count($users) == 1) {
                $user = $users[0];
                if(verifyHashedPassword($this->postData['password'], $user['user_password'])) {
                    $user['user_token'] = AUTHORIZATION::generateToken($user);
                    $where['user_id'] = $user['user_id'];
                    $this->user_model->updateUser($user, $where);

                    $returnData['success'] = true;
                    $returnData['msg'] = "User is logged in successfully!";
                    $returnData['user'] = $user;

                    $this->set_response($returnData, REST_Controller::HTTP_OK);
                } else {
                    $returnData['success'] = false;
                    $returnData['msg'] = "Email or Password is not valid!";
                    $this->set_response($returnData, REST_Controller::HTTP_BAD_REQUEST);    
                }
            } else {
                $returnData['success'] = false;
                $returnData['msg'] = "Email or Password is not valid!";
                $this->set_response($returnData, REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $returnData['success'] = false;
            $returnData['msg'] = "Please input all register information.";
            $this->set_response($returnData, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}