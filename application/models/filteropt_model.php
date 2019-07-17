<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Filter option Model
*/

class Filteropt_model extends CI_Model
{

    public $table_mood = 'tbl_mood';
    
    public $table_genre = 'tbl_genre';

    public $table_pace = 'tbl_pace';

    public $table_instruments = 'tbl_instruments';

    public $table_key = 'tbl_key';

	public function getFilterOptionsByWhere($where, $table_name) {
		$this->db->where($where);
		$query = $this->db->get($table_name);
		$result = $query->result_array();
		return $result;
    }

    public function add($data, $table_name) {
        $this->db->trans_start();
        $this->db->insert($table_name, $data);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    public function update($data, $where, $table_name)
    {
        $this->db->where($where);
        $this->db->update($table_name, $data);
        return TRUE;
    }

    public function delete($where, $table_name)
    {
        $this->db->where($where);
        $this->db->delete($table_name);
    }
}