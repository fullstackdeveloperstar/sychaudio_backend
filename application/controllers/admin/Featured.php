<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Featured extends REST_Controller
{
    private $postData;
    private $header;

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('artist_model');
        $this->load->model('news_model');
        $this->load->model('song_model');
        $this->load->model('video_model');
        $this->load->model('playlist_model');
        $this->load->model('musicreview_model');
        
        $this->postData = $this->request->body;
        $this->headers = $this->input->request_headers();
    }

    public function all_get()
    {   
        $whereFeatured = array(
            'is_featured' => 1,
            'is_deleted' => 0
        );
        
        $data['recently_added_songs'] = [];
        $recently_added_songs = $this->song_model->getRecentlyAddedSongs();
        foreach($recently_added_songs as $song) {
            $song['song_artist'] = $this->artist_model->getArtistById($song['song_artist']);
            $data['recently_added_songs'][] = $song;
        }

        $data['featured_artists'] = $this->artist_model->getArtistsByWhere($whereFeatured);

        $data['featured_news'] = $this->news_model->getNewsByWhere($whereFeatured);

        $data['featured_videos'] = $this->video_model->getByWhere($whereFeatured);

        $data['featured_playlists'] = $this->playlist_model->getPlaylistsByWhere($whereFeatured);

        $data['music_review'] = $this->musicreview_model->get();
        

        $featured_songs = $this->song_model->getSongsByWhere($whereFeatured);
        $data['featured_songs'] = [];
        foreach($featured_songs as $song) {
            $song['song_artist'] = $this->artist_model->getArtistById($song['song_artist']);
            $data['featured_songs'][] = $song;
        }
        $this->set_response($data, REST_Controller::HTTP_OK);
    
    }
}