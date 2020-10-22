<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Playlist extends REST_Controller
{
    private $postData;
    private $header;

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('playlist_model');
        $this->load->model('song_model');
        $this->load->model('artist_model');
        $this->postData = $this->request->body;
        $this->headers = $this->input->request_headers();
    }

    public function playlist_get()
    {   
        $where = array(
            'is_deleted' => '0'
        );
        $playlist = $this->playlist_model->getPlaylistsByWhere($where);
        
        $this->set_response($playlist, REST_Controller::HTTP_OK);
    
    }

    public function playlistitem_get($playlist_id)
    {

        $playlistItem = $this->playlist_model->getPlaylistById($playlist_id);
        $songsWhere = array(
            // 'song_playlist' => $playlist_id,
            'is_deleted' => '0'
        );
        $tempsongs = $this->song_model->getSongsByWhere($songsWhere);
        $songs = array();
        foreach($tempsongs as $tempsong) {
            if($tempsong['song_playlist']) {
                $playlists = explode(',', $tempsong['song_playlist']);
                if (in_array($playlist_id, $playlists)){
                    $songs[] = $tempsong;
                }
            }
        }

        $return_data = array();
        foreach($songs as $song) {
            $song['song_key_writers'] =  json_decode($song['song_key_writers']);
            $song['song_artist'] = $this->artist_model->getArtistById($song['song_artist']);
            $return_data[] = $song;
        }

        $playlistItem['songs'] = $return_data;

        $this->set_response($playlistItem, REST_Controller::HTTP_OK);
    }

    public function playlist_post() {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $playlist_data['playlist_title'] = $this->postData['playlist_title'];
            $playlist_data['playlist_thumb'] = $this->postData['playlist_thumb'];
            $playlist_data['playlist_note'] = $this->postData['playlist_note'];
            $playlist_data['playlist_status'] = $this->postData['playlist_status'];
            $playlist_data['playlist_spotify_embed'] = $this->postData['playlist_spotify_embed'];
            
            $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            $playlist_data['created_datetime'] =  mdate($datestring, $time);

            $playlist_id = $this->playlist_model->addNewPlaylist($playlist_data);
            if($playlist_id) {
                $this->set_response($playlist_data, REST_Controller::HTTP_OK);    
            } else {
                $this->set_response($playlist_data, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);    
            }
        }
    }

    public function playlistwithitem_post() {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $playlist_data['playlist_title'] = $this->postData['playlist_title'];
            $playlist_data['playlist_thumb'] = $this->postData['playlist_thumb'];
            $playlist_data['playlist_note'] = $this->postData['playlist_note'];
            $playlist_data['playlist_status'] = $this->postData['playlist_status'];
            $playlist_data['playlist_spotify_embed'] = $this->postData['playlist_spotify_embed'];

            $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            $playlist_data['created_datetime'] =  mdate($datestring, $time);

            $playlist_id = $this->playlist_model->addNewPlaylist($playlist_data);
            if($playlist_id) {
                foreach($this->postData['songs'] as $song) {
                    $where = array(
                        'song_id' => $song['song_id']
                    );
                    if($song['song_playlist']) {
                        $data['song_playlist'] = $song['song_playlist'].','.$playlist_id;
                    } else {
                        $data['song_playlist'] = $playlist_id;
                    }

                    $this->song_model->updateSong($data, $where);
                }

                $this->set_response($this->postData, REST_Controller::HTTP_OK);    
            } else {
                $this->set_response($playlist_data, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);    
            }
        }
    }

    public function playlist_patch($playlist_id) {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $where = array(
                'playlist_id' => $playlist_id
            );

            $playlist_data['playlist_title'] = $this->postData['playlist_title'];
            $playlist_data['playlist_thumb'] = $this->postData['playlist_thumb'];
            $playlist_data['playlist_note'] = $this->postData['playlist_note'];
            $playlist_data['playlist_status'] = $this->postData['playlist_status'];
            $playlist_data['playlist_spotify_embed'] = $this->postData['playlist_spotify_embed'];

            $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            $playlist_data['updated_datetime'] =  mdate($datestring, $time);

            $this->playlist_model->updatePlaylist($playlist_data, $where);

            $this->set_response($playlist_data, REST_Controller::HTTP_OK);
        }
    }

    public function playlist_delete($playlist_id) {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $where = array(
                'playlist_id' => $playlist_id
            );

            $playlist_data['is_deleted'] = '1';
            $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            $playlist_data['deleted_datetime'] =  mdate($datestring, $time);

            $this->playlist_model->updatePlaylist($playlist_data, $where);

            $this->set_response($playlist_data, REST_Controller::HTTP_OK);
        }
    }

    public function playlistthumb_post() {
        $config['upload_path']          = './uploads/playlist/thumb/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 10000;
        $config['max_width']            = 10240;
        $config['max_height']           = 10240;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('playlist_thumb'))
        {
            $error = array('error' => $this->upload->display_errors());

            $this->set_response($error, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        else
        {
            $data = $this->upload->data();

            $return_data['url'] = base_url() . 'uploads/playlist/thumb/' . $data['file_name'];

            $this->set_response($return_data, REST_Controller::HTTP_OK);
        }
    }

    public function changefeatured_post($playlist_id) {
        $playlist = $this->playlist_model->getPlaylistById($playlist_id);
        $this->set_response($playlist, REST_Controller::HTTP_OK);
        if($playlist) {
            $data = array(
                'is_featured' => 1
            );

            $where = array(
                'playlist_id' => $playlist_id
            );

            $this->playlist_model->updatePlaylist(array('is_featured' => 0), array('is_featured' => 1));

            $this->playlist_model->updatePlaylist($data, $where);
            $this->set_response($data, REST_Controller::HTTP_OK);
        } else {
            $this->set_response(array('error'=> 'not exist'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}