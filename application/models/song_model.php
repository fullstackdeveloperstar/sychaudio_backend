<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Song Model
*/

class Song_model extends CI_Model
{

	private $table_name = 'tbl_songs';

	/**
	* This function is get songs by where clause
	* @param  array $where: this is where clause
	* @return array $result: songs array
	*/

	public function getSongsByWhere($where) {
		$this->db->order_by('song_id','asc');
		$this->db->where($where);
		$query = $this->db->get($this->table_name);
		$result = $query->result_array();
		return $result;
	}

	/**
    * This function is used to add new song
    * @param array $song: this is array data to be added
    * @return number $insert_id: return id of row into table
    */

	public function addNewSong($song) {
		$this->db->trans_start();
        $this->db->insert($this->table_name, $song);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
	} 

	/**
    * This function is used to update the song information
    * @param array $song : This is song updated information
    * @param array $where : This is where clause
    */

	public function updateSong($song, $where) {
		$this->db->where($where);
        $this->db->update($this->table_name, $song);
        return TRUE;
	}

	public function getSongById($id) {
		$this->db->where('song_id', $id);
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