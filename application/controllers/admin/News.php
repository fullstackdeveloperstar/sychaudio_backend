<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class News extends REST_Controller
{
    private $postData;
    private $header;

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('news_model');
        $this->postData = $this->request->body;
        $this->headers = $this->input->request_headers();
    }

    public function news_get()
    {
        
        $where = array();
        $news = $this->news_model->getNewsByWhere($where);
        
        $this->set_response($news, REST_Controller::HTTP_OK);
    
    }

    public function news_post() {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $news_data['news_title'] = $this->postData['news_title'];
            $news_data['news_thumb'] = $this->postData['news_thumb'];
            $news_data['news_content'] = $this->postData['news_content'];
            $news_data['news_status'] = $this->postData['news_status'];
            $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            $news_data['created_datetime'] =  mdate($datestring, $time);

            $news_id = $this->news_model->addNewNews($news_data);
            if($news_id) {
                $this->set_response($news_data, REST_Controller::HTTP_OK);    
            } else {
                $this->set_response($news_data, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);    
            }
        }
    }
}