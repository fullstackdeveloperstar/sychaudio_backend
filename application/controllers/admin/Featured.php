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
        
        $this->postData = $this->request->body;
        $this->headers = $this->input->request_headers();
    }

    public function all_get()
    {   
        $whereFeatured = array(
            'is_featured' => 1,
            'is_deleted' => 0
        );
        
        $data['recently_added_songs'] = $this->song_model->getRecentlyAddedSongs();

        $data['featured_artists'] = $this->artist_model->getArtistsByWhere($whereFeatured);

        $data['featured_news'] = $this->news_model->getNewsByWhere($whereFeatured);

        $this->set_response($data, REST_Controller::HTTP_OK);
    
    }
}