<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Location Model
*/

class Location_model extends CI_Model
{

    public $table_country = 'countries';
    public $table_state = 'states';
    public $table_city = 'cities';

	public function getCountries() {
		$query = $this->db->get($this->table_country);
		$result = $query->result_array();
		return $result;
    }

    public function getStates($country_id) {
        $this->db->where('country_id', $country_id);
        $query = $this->db->get($this->table_state);
		$result = $query->result_array();
		return $result;
    }

    public function getCities($state_id) {
        $this->db->where('state_id', $state_id);
        $query = $this->db->get($this->table_city);
		$result = $query->result_array();
		return $result;
    }
}