<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class Song extends REST_Controller
{
    private $postData;
    private $header;

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('song_model');
        $this->load->model('artist_model');
        $this->load->model('license_request_model');
        $this->postData = $this->request->body;
        $this->headers = $this->input->request_headers();
    }

    public function getallsongs_get() {
        $where = array(
            'is_deleted' => '0'
        );
        $songs = $this->song_model->getSongsByWhere($where);
        $return_data = [];
        foreach($songs as $song) {
            $song['song_key_writers'] =  json_decode($song['song_key_writers']);
            $song['song_artist'] = $this->artist_model->getArtistById($song['song_artist']);
            $return_data[] = $song;
        }
        $this->set_response($return_data, REST_Controller::HTTP_OK);
    }

    public function song_post() {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $song_data['song_title'] = $this->postData['song_title'];
            $song_data['song_thumb'] = $this->postData['song_thumb'];
            $song_data['song_music'] = $this->postData['song_music'];
            $song_data['song_music_wav'] = $this->postData['song_music_wav'];
            $song_data['song_music_inst'] = $this->postData['song_music_inst'];
            $song_data['song_artist'] = $this->postData['song_artist'];
            $song_data['song_performedby'] = $this->postData['song_performedby'];
            $song_data['song_mood'] = $this->postData['song_mood'];
            $song_data['song_genre'] = $this->postData['song_genre'];
            $song_data['song_pace'] = $this->postData['song_pace'];
            $song_data['song_instrument'] = $this->postData['song_instrument'];
            $song_data['song_playlist'] = $this->postData['song_playlist'];
            $song_data['song_vocals_inst'] = $this->postData['song_vocals_inst'];
            $song_data['song_key'] = $this->postData['song_key'];
            $song_data['song_duration'] = $this->postData['song_duration'];
            $song_data['song_bpm'] = $this->postData['song_bpm'];
            $song_data['song_key_writers'] = json_encode($this->postData['song_key_writers']);
            $song_data['song_album_name'] =  $this->postData['song_album_name'];
            $song_data['song_release'] =  $this->postData['song_release'];
            $song_data['song_original_cover'] =  $this->postData['song_original_cover'];
            $song_data['song_explicit'] =  $this->postData['song_explicit'];
            $song_data['song_language'] =  $this->postData['song_language'];
            $song_data['song_comments_notes'] =  $this->postData['song_comments_notes'];
            $song_data['song_status'] =  $this->postData['song_status'];
            $song_data['song_music_lyrics'] =  $this->postData['song_music_lyrics'];
            
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


    public function song_patch($song_id) {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $where = array(
                'song_id' => $song_id
            );

            $song_data['song_title'] = $this->postData['song_title'];
            $song_data['song_thumb'] = $this->postData['song_thumb'];
            $song_data['song_music'] = $this->postData['song_music'];
            $song_data['song_music_wav'] = $this->postData['song_music_wav'];
            $song_data['song_music_inst'] = $this->postData['song_music_inst'];
            $song_data['song_artist'] = $this->postData['song_artist'];
            $song_data['song_performedby'] = $this->postData['song_performedby'];
            $song_data['song_mood'] = $this->postData['song_mood'];
            $song_data['song_genre'] = $this->postData['song_genre'];
            $song_data['song_pace'] = $this->postData['song_pace'];
            $song_data['song_instrument'] = $this->postData['song_instrument'];
            $song_data['song_playlist'] = $this->postData['song_playlist'];
            $song_data['song_vocals_inst'] = $this->postData['song_vocals_inst'];
            $song_data['song_key'] = $this->postData['song_key'];
            $song_data['song_duration'] = $this->postData['song_duration'];
            $song_data['song_bpm'] = $this->postData['song_bpm'];
            $song_data['song_key_writers'] = json_encode($this->postData['song_key_writers']);
            $song_data['song_album_name'] =  $this->postData['song_album_name'];
            $song_data['song_release'] =  $this->postData['song_release'];
            $song_data['song_original_cover'] =  $this->postData['song_original_cover'];
            $song_data['song_explicit'] =  $this->postData['song_explicit'];
            $song_data['song_language'] =  $this->postData['song_language'];
            $song_data['song_comments_notes'] =  $this->postData['song_comments_notes'];
            $song_data['song_status'] =  $this->postData['song_status'];
            $song_data['song_music_lyrics'] =  $this->postData['song_music_lyrics'];

            $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            $song_data['updated_datetime'] =  mdate($datestring, $time);

            $this->song_model->updateSong($song_data, $where);

            $this->set_response($song_data, REST_Controller::HTTP_OK);
        }
    }

    public function song_get($song_id) {
        $song_item = $this->song_model->getSongById($song_id);
        $song_item['song_key_writers'] = json_decode($song_item['song_key_writers']);
        $this->set_response($song_item, REST_Controller::HTTP_OK);
    }

    public function song_delete($song_id) {
        if(!AUTHORIZATION::checkAdminAuth()) {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $where = array(
                'song_id' => $song_id
            );

            $song_data['is_deleted'] = '1';
            $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            $song_data['deleted_datetime'] =  mdate($datestring, $time);

            $this->song_model->updateSong($song_data, $where);

            $this->set_response($song_data, REST_Controller::HTTP_OK);
        }
    }

    public function songthumb_post() {
        $config['upload_path']          = './uploads/song/thumb/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 10000;
        $config['max_width']            = 10240;
        $config['max_height']           = 10240;

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

    public function changefeatured_post($song_id) {
        $song = $this->song_model->getSongById($song_id);
        $this->set_response($song, REST_Controller::HTTP_OK);
        if($song) {
            $data = array(
                'is_featured' => 1
            );

            $where = array(
                'song_id' => $song_id
            );
            $this->song_model->updateSong(array('is_featured' => 0), array('is_featured' => 1));
            $this->song_model->updateSong($data, $where);
            $this->set_response($data, REST_Controller::HTTP_OK);
        } else {
            $this->set_response(array('error'=> 'not exist'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function license_post() {
        $this->license_request_model->addLicenseRequest($this->postData);
        $this->set_response($this->postData, REST_Controller::HTTP_OK);
    }

    public function download_get($id) {
        // $s3 = new AmazonS3('AKIA3HSX63WV3I3B2ND7', 'y5bq/wcSaiHe2t1h9+yIroLtx/z0bKRP/SPdE4TR');
        // $objInfo = $s3->get_object_headers('music-sync', '0Mrk5utC-good-trouble-picture.jpg');
        // $obj = $s3->get_object('music-sync', '0Mrk5utC-good-trouble-picture.jpg');

        // header('Content-type: ' . $objInfo->header['_info']['content_type']);
        // echo $obj->body;


        $bucket = 'music-sync';
        $keyname = $id;

        $s3 = new S3Client([
            'version' => 'latest',
            'region'  => 'us-east-2',
            'credentials' => [
                'key'    => "AKIA3HSX63WV3I3B2ND7",
                'secret' => "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",
            ]
        ]);

        try {
            // Get the object.
            $result = $s3->getObject([
                'Bucket' => $bucket,
                'Key'    => $keyname
            ]);

            // Display the object in the browser.
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=".$keyname);
            echo $result['Body'];
        } catch (S3Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }
    }
}