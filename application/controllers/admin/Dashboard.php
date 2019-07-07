<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Dashboard extends REST_Controller
{
    private $postData;
    private $header;

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('homeslider_model');
        $this->load->model('video_model');
        
        $this->postData = $this->request->body;
        $this->headers = $this->input->request_headers();
    }

    public function admin_homesliders_get() {

        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $where['is_deleted'] = '0';
        
            $homesliders = $this->homeslider_model->getSlidersByWhere($where);

            $this->set_response($homesliders, REST_Controller::HTTP_OK);
        }
    }

    public function admin_homeslider_post() {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $sliderData = $this->postData;
            $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            $sliderData['created_datetime'] =  mdate($datestring, $time);
        
            $homesliders = $this->homeslider_model->add($sliderData);

            $this->set_response($sliderData, REST_Controller::HTTP_OK);
        }
    }

    public function admin_homeslider_delete($slider_id) {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {

            // $sliderData = $this->homeslider_model->getById($slider_id);
            // if(!$sliderData) {
            //     $this->set_response(array('error'=> 'not exist'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            // }
            $where['slider_id'] = $slider_id;

            $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            $sliderData['deleted_datetime'] =  mdate($datestring, $time);
            $sliderData['is_deleted'] = 1;
        
            $this->homeslider_model->update($sliderData, $where);

            $this->set_response($sliderData, REST_Controller::HTTP_OK);
        }
    }

    public function admin_homeslider_toggle_patch($slider_id) {
        // if(!AUTHORIZATION::checkAdminAuth()) {
        //     $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        // } else {
            $slider = $this->homeslider_model->getById($slider_id);
            if($slider) {
                $data = array(
                    'slider_status' => 0
                );
    
                if($slider['slider_status'] == 0) {
                    $data['slider_status'] = 1;
                } else {
                    $data['slider_status'] = 0;
                }
    
                $where = array(
                    'slider_id' => $slider_id
                );
    
                $this->homeslider_model->update($data, $where);
                $this->set_response($data, REST_Controller::HTTP_OK);
            } else {
                $this->set_response(array('error'=> 'not exist'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        // }
        
    }

    public function admin_homeslider_order_patch()
    {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $orders = $this->postData;
            foreach($orders as $order) {
                $where['slider_id'] = $order['slider_id'];
                
                $data['slider_order'] = $order['slider_order'];

                $this->homeslider_model->update($data, $where);
            }
            $this->set_response($orders, REST_Controller::HTTP_OK);
        }
    }

    public function homesliders_get()
    {
        $sliders = $this->homeslider_model->getHomeSliders();
        $return_data = [];
        foreach($sliders as $slider) {
            $return_data[] = $slider['slider_img'];
        }

        $this->set_response($return_data, REST_Controller::HTTP_OK);
    }

    public function admin_videos_get()
    {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
        
          $where['is_deleted'] = 0;
          $videos = $this->video_model->getByWhere($where);
          $this->set_response($videos, REST_Controller::HTTP_OK);
        }
    }

    public function admin_video_post() {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
        
            $id = $this->video_model->add($this->postData);
            if($id) {
                $this->set_response($this->postData, REST_Controller::HTTP_OK);
            } else {
                $this->set_response($this->postData, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);    
            }
            
        }
    }

    public function admin_video_patch($video_id) {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $where['video_id'] = $video_id;
            $id = $this->video_model->update($this->postData, $where);
            if($id) {
                $this->set_response($this->postData, REST_Controller::HTTP_OK);
            } else {
                $this->set_response($this->postData, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);    
            }
            
        }
    }

    public function admin_video_delete($video_id)
    {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
          $where['video_id'] = $video_id;
          $data['is_deleted'] = 1;
          $this->video_model->update($data, $where);
          $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function changevideofeatured_post($video_id) {
        $video = $this->video_model->getById($video_id);
        
        if($video) {
            $data = array(
                'is_featured' => 1
            );

            $where = array(
                'video_id' => $video_id
            );
            $this->video_model->update(array('is_featured' => 0), array('is_featured' => 1));
            $this->video_model->update($data, $where);
            $this->set_response($data, REST_Controller::HTTP_OK);
        } else {
            $this->set_response(array('error'=> 'not exist'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}