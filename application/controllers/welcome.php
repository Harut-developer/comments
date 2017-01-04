<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$username = $this->input->post('userName');
		//Check user if not Add and login user
		if($username) {
			$this->load->model('users_model');
			$row = $this->users_model->get($username);
			if(empty($row)) {
				$id = $this->users_model->insert($username);
			} else {
				$id = $row['userid'];
			}
			$user = array(
					'id' => $id,
					'username' => $username
				);
			$this->session->set_userdata($user);
			redirect('/main/comments/1');
		}
		$this->load->view('welcome_message');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */