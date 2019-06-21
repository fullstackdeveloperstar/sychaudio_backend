<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Song extends REST_Controller
{
    private $postData;
    private $header;

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('song_model');
        $this->postData = $this->request->body;
        $this->headers = $this->input->request_headers();
    }

    public function getallsongs_get() {
        $where = array();
        $songs = $this->song_model->getSongsByWhere($where);
        $this->set_response($songs, REST_Controller::HTTP_OK);
    }

    public function song_post() {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $song_data['song_title'] = $this->postData['song_title'];
            $song_data['song_thumb'] = $this->postData['song_thumb'];
            $song_data['song_music'] = $this->postData['song_music'];
            $song_data['song_artist'] = $this->postData['song_artist'];
            $song_data['song_performedby'] = $this->postData['song_performedby'];
            $song_data['song_mood'] = $this->postData['song_mood'];
            $song_data['song_genre'] = $this->postData['song_genre'];
            $song_data['song_pace'] = $this->postData['song_pace'];
            $song_data['song_instrument'] = $this->postData['song_instrument'];
            $song_data['song_playlist'] = $this->postData['song_playlist'];
            $song_data['song_vocals_inst'] = $this->postData['song_vocals_inst'];
            $song_data['song_duration'] = $this->postData['song_duration'];
            $song_data['song_bpm'] = $this->postData['song_bpm'];
            $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            $song_data['created_datetime'] =  mdate($datestring, $time);

            $song_id = $this->song_model->addNewSong($song_data);
            if($song_id) {
                $this->set_response($song_data, REST_Controller::HTTP_OK);    
            } else {
                $this->set_response($song_data, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);    
            }
        }
    }

    public function song_get($song_id) {
        $song_item = $this->song_model->getSongById($song_id);
    
        $this->set_response($song_item, REST_Controller::HTTP_OK);
    }

    public function songthumb_post() {
        $config['upload_path']          = './uploads/song/thumb/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 1024;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('song_thumb'))
        {
            $error = array('error' => $this->upload->display_errors());

            $this->set_response($error, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        else
        {
            $data = $this->upload->data();

            $return_data['url'] = base_url() . 'uploads/song/thumb/' . $data['file_name'];

            $this->set_response($return_data, REST_Controller::HTTP_OK);
        }
    }


    public function songmusic_post() {
        $config['upload_path']          = './uploads/song/music/';
        $config['allowed_types']        = 'mp3|wav';
        $config['max_size']             = 100000;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('song_music'))
        {
            $error = array('error' => $this->upload->display_errors());

            $this->set_response($error, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        else
        {
            $data = $this->upload->data();

            $return_data['url'] = base_url() . 'uploads/song/music/' . $data['file_name'];

            $this->set_response($return_data, REST_Controller::HTTP_OK);
        }
    }
}