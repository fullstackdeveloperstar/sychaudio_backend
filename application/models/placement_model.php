<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Placement Model
*/

class Placement_model extends CI_Model
{

	private $table_name = 'tbl_placement';

	public function getByWhere($where) {
		$this->db->order_by('placement_id','asc');
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
		$this->db->where('placement_id', $id);
		$this->db->limit(1);
		$query = $this->db->get($this->table_name);
		$result = $query->result_array();

		if(count($result) == 1) {
			return $result[0];
		} else {
			return false;
		}
	}
}