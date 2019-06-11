<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Artist extends REST_Controller
{
    private $postData;
    private $header;

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('artist_model');
        $this->postData = $this->request->body;
        $this->headers = $this->input->request_headers();
    }

    public function artists_get()
    {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $where = array();
            $artists = $this->artist_model->getArtistsByWhere($where);
            $return_data = array();
            foreach($artists as $artist) {
                $artist['artist_key_writers'] = json_decode($artist['artist_key_writers']);
                $artist['artist_members'] = json_decode($artist['artist_members']);
                $return_data[] = $artist;
            }
            $this->set_response($return_data, REST_Controller::HTTP_OK);
        }
    }

    public function artist_post()
    {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $artist = $this->postData;
            $artist['artist_key_writers'] = json_encode($artist['artist_key_writers']);
            $artist['artist_members'] = json_encode($artist['artist_members']);
            $artist_id = $this->artist_model->addNewArtist($artist);
            $this->set_response($artist, REST_Controller::HTTP_OK);
        }
    }

    public function artist_patch($artist_id) {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $where = array(
                'artist_id' => $artist_id
            );

            $artist_data['artist_name'] = $this->postData['artist_name'];
            $artist_data['artist_avatar'] = $this->postData['artist_avatar'];
            $artist_data['artist_bio'] = $this->postData['artist_bio'];
            $artist_data['artist_status'] = $this->postData['artist_status'];
            $artist_data['artist_key_writers'] = json_encode($this->postData['artist_key_writers']);
            $artist_data['artist_members'] = json_encode($this->postData['artist_members']);
            $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            $artist_data['updated_datetime'] =  mdate($datestring, $time);

            $this->artist_model->updateArtist($artist_data, $where);

            $this->set_response($artist_data, REST_Controller::HTTP_OK);
        }
    }

    public function artist_delete($artist_id) {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $where = array(
                'artist_id' => $artist_id
            );

            $artist_data['is_deleted'] = '1';
            $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            $artist_data['deleted_datetime'] =  mdate($datestring, $time);

            $this->artist_model->updateArtist($artist_data, $where);

            $this->set_response($artist_data, REST_Controller::HTTP_OK);
        }
    }

    public function artistavatar_post() {
        $config['upload_path']          = './uploads/artist/avatar/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 1024;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('artist_avatar'))
        {
            $error = array('error' => $this->upload->display_errors());

            $this->set_response($error, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        else
        {
            $data = $this->upload->data();

            $return_data['url'] = base_url() . 'uploads/artist/avatar/' . $data['file_name'];

            $this->set_response($return_data, REST_Controller::HTTP_OK);
        }
    }
}