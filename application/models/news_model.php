<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
* News Model
*/

class News_model extends CI_Model
{

	private $table_name = 'tbl_news';

	/**
	* This function is get news by where clause
	* @param  array $where: this is where clause
	* @return array $result: news array
	*/

	public function getNewsByWhere($where) {
		$this->db->order_by('news_id','asc');
		$this->db->where($where);
		$query = $this->db->get($this->table_name);
		$result = $query->result_array();
		return $result;
	}

	/**
    * This function is used to add new news
    * @param array $news: this is array data to be added
    * @return number $insert_id: return id of row into table
    */

	public function addNewNews($news) {
		$this->db->trans_start();
        $this->db->insert($this->table_name, $news);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
	} 

	/**
    * This function is used to update the news information
    * @param array $news : This is news updated information
    * @param array $where : This is where clause
    */

	public function updateNews($news, $where) {
		$this->db->where($where);
        $this->db->update($this->table_name, $news);
        return TRUE;
	}

	public function getNewsById($id) {
		$this->db->where('news_id', $id);
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