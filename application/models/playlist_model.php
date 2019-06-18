<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Playlist Model
*/

class Playlist_model extends CI_Model
{

	private $table_name = 'tbl_playlist';

	/**
	* This function is get playlist by where clause
	* @param  array $where: this is where clause
	* @return array $result: playlist array
	*/

	public function getPlaylistsByWhere($where) {
		$this->db->order_by('playlist_id','asc');
		$this->db->where($where);
		$query = $this->db->get($this->table_name);
		$result = $query->result_array();
		return $result;
	}

	/**
    * This function is used to add new playlist
    * @param array $playlist: this is array data to be added
    * @return number $insert_id: return id of row into table
    */

	public function addNewPlaylist($playlist) {
		$this->db->trans_start();
        $this->db->insert($this->table_name, $playlist);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
	} 

	/**
    * This function is used to update the playlist information
    * @param array $playlist : This is playlist updated information
    * @param array $where : This is where clause
    */

	public function updatePlaylist($playlist, $where) {
		$this->db->where($where);
        $this->db->update($this->table_name, $playlist);
        return TRUE;
	}

	public function getPlaylistById($id) {
		$this->db->where('playlist_id', $id);
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