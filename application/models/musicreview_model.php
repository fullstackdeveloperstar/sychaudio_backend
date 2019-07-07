<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
* MusicReview Model
*/

class Musicreview_model extends CI_Model
{

    private $table_name = 'tbl_musicreview';

    public function get() {
		$this->db->where('musicreview_id', 1);
		$query = $this->db->get($this->table_name);
		$result = $query->result_array();
		return $result[0];
    }
    
    public function save($data) {
        $this->db->where('musicreview_id', 1);
        $this->db->update($this->table_name, $data);
        return true;
    }
}