<?php
class Comments_model extends CI_Model {

	/**
	* Get comments by condition
	* @param $condition array
	* @return array
	*/
	function get($condition) {
        $query = $this->db->select('c.description, c.date, u.username')->join('users u', 'u.userid=c.userid')->order_by('date', 'ASC')->get_where('comments c', $condition);
        return $query->result_array();
    }

    /**
    * Add new comment
    * @param $data array
    */
    function insert($data) {
    	$this->db->insert('comments', $data);
    }
}
