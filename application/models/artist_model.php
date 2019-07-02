<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Artist Model
*/

class Artist_model extends CI_Model
{

	private $table_name = 'tbl_artist';

	/**
	* This function is get artists by where clause
	* @param  array $where: this is where clause
	* @return array $result: artists array
	*/

	public function getArtistsByWhere($where) {
		$this->db->order_by('artist_order','asc');
		$this->db->where($where);
		$query = $this->db->get($this->table_name);
		$result = $query->result_array();
		return $result;
	}

	/**
    * This function is used to add new artist
    * @param array $artist: this is array data to be added
    * @return number $insert_id: return id of row into table
    */

	public function addNewArtist($artist) {
		$this->db->trans_start();
        $this->db->insert($this->table_name, $artist);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
	} 

	/**
    * This function is used to update the artist information
    * @param array $artist : This is artist updated information
    * @param array $where : This is where clause
    */

	public function updateArtist($artist, $where) {
		$this->db->where($where);
        $this->db->update($this->table_name, $artist);
        return TRUE;
	}

	public function getArtistById($id) {
		$this->db->where('artist_id', $id);
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