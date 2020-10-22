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
        $this->load->model('song_model');
        $this->postData = $this->request->body;
        $this->headers = $this->input->request_headers();
    }

    public function artists_get()
    {
        $where = array(
            'is_deleted' => '0'
        );
        $artists = $this->artist_model->getArtistsByWhere($where);
        $return_data = array();
        foreach($artists as $artist) {
            $artist['artist_members'] = json_decode($artist['artist_members']);
            $return_data[] = $artist;
        }
        $this->set_response($return_data, REST_Controller::HTTP_OK);
    }

    public function artist_get($artist_id)
    {
        $artist = $this->artist_model->getArtistById($artist_id);
        $return_data = array();

        $artist['artist_members'] = json_decode($artist['artist_members']);

        $songsWhere = array(
            'song_artist' => $artist_id,
            'is_deleted' => '0'
        );

        $songs = $this->song_model->getSongsByWhere($songsWhere);
        $return_data = array();
        foreach($songs as $song) {
            $song['song_key_writers'] =  json_decode($song['song_key_writers']);
            $song['song_artist'] = $this->artist_model->getArtistById($song['song_artist']);
            $return_data[] = $song;
        }

        $artist['songs'] = $return_data;
    
        $this->set_response($artist, REST_Controller::HTTP_OK);
    }

    public function artist_post()
    {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $artist = $this->postData;
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
            $artist_data['artist_contact'] = $this->postData['artist_contact'];
            $artist_data['artist_from'] = $this->postData['artist_from'];
            $artist_data['artist_website_url'] = $this->postData['artist_website_url'];
            
            $artist_data['artist_twitter'] = $this->postData['artist_twitter'];
            $artist_data['artist_facebook'] = $this->postData['artist_facebook'];
            $artist_data['artist_myspace'] = $this->postData['artist_myspace'];
            $artist_data['artist_youtube'] = $this->postData['artist_youtube'];
            $artist_data['artist_itunes'] = $this->postData['artist_itunes'];
            $artist_data['artist_lastfm'] = $this->postData['artist_lastfm'];
            $artist_data['artist_soundcloud'] = $this->postData['artist_soundcloud'];
            $artist_data['artist_bandcamp'] = $this->postData['artist_bandcamp'];
            $artist_data['artist_instagram'] = $this->postData['artist_instagram'];
            $artist_data['artist_spotify'] = $this->postData['artist_spotify'];
            $artist_data['artist_otherurl1'] = $this->postData['artist_otherurl1'];
            $artist_data['artist_otherurl2'] = $this->postData['artist_otherurl2'];
            $artist_data['artist_vocal'] = $this->postData['artist_vocal'];
            $artist_data['artist_genre'] = $this->postData['artist_genre'];
            $artist_data['artist_status'] = $this->postData['artist_status'];
            $artist_data['artist_spotify_embed'] = $this->postData['artist_spotify_embed'];
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
        $config['max_size']             = 10000;
        $config['max_width']            = 10240;
        $config['max_height']           = 10240;

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

    public function changefeatured_post($artist_id) {
        $artist = $this->artist_model->getArtistById($artist_id);
        $this->set_response($artist, REST_Controller::HTTP_OK);
        if($artist) {
            $data = array(
                'is_featured' => 1
            );

            $where = array(
                'artist_id' => $artist_id
            );

            $this->artist_model->updateArtist(array('is_featured' => 0), array('is_featured' => 1));

            $this->artist_model->updateArtist($data, $where);
            $this->set_response($data, REST_Controller::HTTP_OK);
        } else {
            $this->set_response(array('error'=> 'not exist'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function changeorder_patch() {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $orders = $this->postData;
            // $orders = json_encode($orders);
            // $artist_id = $this->artist_model->addNewArtist($artist);
            foreach($orders as $order) {
                $where['artist_id'] = $order['artist_id'];
                
                $data['artist_order'] = $order['artist_order'];

                $this->artist_model->updateArtist($data, $where);
            }
            $this->set_response($orders, REST_Controller::HTTP_OK);
        }
    }
}