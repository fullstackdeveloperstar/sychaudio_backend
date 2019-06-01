<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
* User Model
*/

class User_model extends CI_Model
{

	private $table_name = 'tbl_user';

	/**
	* This function is get users by where clause
	* @param  array $where: this is where clause
	* @return array $result: users array
	*/

	public function getUsersByWhere($where) {
		$this->db->order_by('user_id','asc');
		$query = $this->db->get($this->table_name);
		$result = $query->result_array();
		return $result;
	}

	/**
    * This function is used to add new user
    * @param array $user: this is array data to be added
    * @return number $insert_id: return id of row into table
    */

	public function addNewUser($user) {
		$this->db->trans_start();
        $this->db->insert($this->table_name, $user);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
	} 

	/**
    * This function is used to update the user information
    * @param array $user : This is user updated information
    * @param array $where : This is where clause
    */

	public function updateUser($user, $where) {
		$this->db->where($where);
        $this->db->update($this->table_name, $user);
        return TRUE;
	}

	public function checkEmailExist($email) {
		$this->db->where('user_email', $email);
		$query = $this->db->get($this->table_name);
		$result = $query->result_array();

		if(count($result) > 0) {
			return true;
		} else {
			return false;
		}
	}
}