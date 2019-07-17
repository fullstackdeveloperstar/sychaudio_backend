<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Social Model
*/

class Social_model extends CI_Model
{

    private $table_name = 'tbl_social';

    public function get() {
		$this->db->where('social_id', 1);
		$query = $this->db->get($this->table_name);
		$result = $query->result_array();
		return $result[0];
    }
    
    public function save($data) {
        $this->db->where('social_id', 1);
        $this->db->update($this->table_name, $data);
        return true;
    }
}