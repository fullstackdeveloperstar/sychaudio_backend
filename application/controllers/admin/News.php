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
        $where = array(
            'is_deleted' => '0'
        );

        $news = $this->news_model->getNewsByWhere($where);
        
        $this->set_response($news, REST_Controller::HTTP_OK);
    
    }

    public function newspublished_get() {
        $where = array(
            'is_deleted' => '0',
            'news_status' => '0'
        );

        $news = $this->news_model->getNewsByWhere($where);
        
        $this->set_response($news, REST_Controller::HTTP_OK);
    }

    public function newsitem_get($news_id)
    {
        $newsItem = $this->news_model->getNewsById($news_id);
    
        $this->set_response($newsItem, REST_Controller::HTTP_OK);
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

    public function news_patch($news_id) {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $where = array(
                'news_id' => $news_id
            );

            $news_data['news_title'] = $this->postData['news_title'];
            $news_data['news_thumb'] = $this->postData['news_thumb'];
            $news_data['news_status'] = $this->postData['news_status'];
            $news_data['news_content'] = $this->postData['news_content'];

            $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            $news_data['updated_datetime'] =  mdate($datestring, $time);

            $this->news_model->updateNews($news_data, $where);

            $this->set_response($news_data, REST_Controller::HTTP_OK);
        }
    }

    public function news_delete($news_id) {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $where = array(
                'news_id' => $news_id
            );

            $news_data['is_deleted'] = '1';
            $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            $news_data['deleted_datetime'] =  mdate($datestring, $time);

            $this->news_model->updateNews($news_data, $where);

            $this->set_response($news_data, REST_Controller::HTTP_OK);
        }
    }

    public function newsthumb_post() {
        $config['upload_path']          = './uploads/news/thumb/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 10000;
        $config['max_width']            = 10240;
        $config['max_height']           = 10240;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('news_thumb'))
        {
            $error = array('error' => $this->upload->display_errors());

            $this->set_response($error, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        else
        {
            $data = $this->upload->data();

            $return_data['url'] = base_url() . 'uploads/news/thumb/' . $data['file_name'];

            $this->set_response($return_data, REST_Controller::HTTP_OK);
        }
    }

    public function changefeatured_post($news_id) {
        $news = $this->news_model->getNewsById($news_id);
        $this->set_response($news, REST_Controller::HTTP_OK);
        if($news) {
            $data = array(
                'is_featured' => 0
            );

            if($news['is_featured'] == 0) {
                $data['is_featured'] = 1;
            } else {
                $data['is_featured'] = 0;
            }

            $where = array(
                'news_id' => $news_id
            );

            $this->news_model->updateNews($data, $where);
            $this->set_response($data, REST_Controller::HTTP_OK);
        } else {
            $this->set_response(array('error'=> 'not exist'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}