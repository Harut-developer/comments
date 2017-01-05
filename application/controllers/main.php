<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class main extends CI_Controller {

	public function index()
	{
		redirect('/');
	}

	/** 
	* Show Comments by item
	* @param $item_id integer
	*/
	public function comments($item_id = '') {
		$login = $this->session->userdata('id');
		if($login) {
			if ($item_id) {
				$this->load->model('comments_model');
				$new_comment = $this->input->post('comment');
				if($new_comment) {
					$this->load->model('users_model');
					$this->comments_model->insert(array('item_id' => $item_id, 'description' => $new_comment, 'userid' => $login, 'date' => date('Y-m-d H:i:s')));
					//change status typeing after inserted
					$this->users_model->update(array('typing' => 0), array('userid' => $login));
					redirect('/main/comments/'.$item_id);
				}
				$data = $this->comments_model->get(array('item_id' => $item_id));
				$this->load->view('comments', array('comments' => $data, 'item_id' => $item_id));
			} else {
				redirect('/main/comments/1');
			}
		} else {
			redirect('/');
		}
	}

	/**
	* set typing
	*/
	public function isTyping() {
		$id = $this->session->userdata('id');
		$this->load->model('users_model');
		$this->users_model->update(array('typing' => 1, 'date' => date('Y-m-d H:i:s')), array('userid' => $id));
	}

	/**
	* convert time to sec
	* @param $time string
	* @return int
	*/
	private function TimeToSec($time) {
	    $sec = 0;
	    foreach (array_reverse(explode(':', $time)) as $k => $v) $sec += pow(60, $k) * $v;
	    return $sec;
	}
	/**
	* Get users when typing
	*/
	public function getTypingUsers() {
		$id = $this->session->userdata('id');
		$this->load->model('users_model');
		$users = $this->users_model->getUsers(array('typing' => 1, 'userid !=' => $id), true);

		foreach ($users as $key=>$user) {
			$sec = $this->TimeToSec($user['time_diff']);
			//change typing status when note updated.
			if($sec > 60) {
				$this->users_model->update(array('typing' => 0), array('userid' => $user['userid']));
				unset($users[$key]);
			}
		}
		return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($users));
	}

	/**
	* Get new comments
	*/
	public function getNewComments() {
		$time = $this->input->get('time');
		$count = $this->input->get('count');
		$item_id = $this->input->get('item_id');
		$this->load->model('comments_model');
		$new_comments = $this->comments_model->getNewComments($time, $item_id);

		if($count == 'count') {
			$data = array('count'=>count($new_comments));
		} else {
			$data = $new_comments;
		}

		return $this->output
	            ->set_content_type('application/json')
	            ->set_output(json_encode($data));
	}

}