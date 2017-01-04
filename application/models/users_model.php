<?php
class Users_model extends CI_Model {

	/**
	* Get user by username
	* @param $username string
	* @return array
	*/
	function get($username) {
        $query = $this->db->get_where('users', array('username' => $username));
        return $query->row_array();
    }

    /**
    * Add user
    * @param $username string
    * @return int
    */
    function insert($username) {
    	$this->db->insert('users', array('username' => $username));
        return $this->db->insert_id();
    }

    /**
    * Update user
    * @param $data array
    * @param $where array
    */
    function update($data, $where) {
		$this->db->where($where);
    	$this->db->update('users', $data);
    }

    /**
    * Get Users By Condition
    * @param $condition
    * @return array
    */
    function getUsers($condition, $typing = false) {
    	if($typing) {
    		$this->db->select('*, TIMEDIFF(\''.date('Y-m-d H:i:s').'\', date) AS time_diff', false);
    	}
    	$query = $this->db->order_by('date', 'ASC')->get_where('users', $condition);
    	return $query->result_array();
    }
}
