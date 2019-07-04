<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
* LicenseRequest Model
*/

class License_request_model extends CI_Model
{

	private $table_name = 'tbl_license_request';

	public function addLicenseRequest($data) {
		$this->db->trans_start();
        $this->db->insert($this->table_name, $data);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
	} 
}