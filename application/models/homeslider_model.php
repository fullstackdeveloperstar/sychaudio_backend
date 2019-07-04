<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Home slider Model
*/

class Homeslider_model extends CI_Model
{

	private $table_name = 'tbl_homeslider';


	public function getSlidersByWhere($where) {
		$this->db->order_by('slider_order','asc');
		$this->db->where($where);
		$query = $this->db->get($this->table_name);
		$result = $query->result_array();
		return $result;
	}

	public function add($data) {
		$this->db->trans_start();
        $this->db->insert($this->table_name, $data);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
	} 

	public function update($data, $where) {
		$this->db->where($where);
        $this->db->update($this->table_name, $data);
        return TRUE;
    }
    
    public function getById($id) {
		$this->db->where('slider_id', $id);
		$this->db->limit(1);
		$query = $this->db->get($this->table_name);
		$result = $query->result_array();

		if(count($result) == 1) {
			return $result[0];
		} else {
			return false;
		}
    }
    
    public function getHomeSliders()
    {
        $this->db->where('slider_status', 1);
        $this->db->where('is_deleted', 0);
        $this->db->order_by('slider_order','asc');
        $query = $this->db->get($this->table_name);
        $result = $query->result_array();
        return $result;
    }
}