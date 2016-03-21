<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	function __construct()
	{
	   	parent::__construct();
	   	$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));
       	$this->lang->load('reader_lang', $this->config->item('language'));
       	$this->lang->load('auth'); 
       	$this->_init();
	}

	private function _init()
    {
        $this->output->set_template('default');
        $this->output->set_title($this->config->item('title_site'));
    }

	function index($id = null)
	{
		$this->data['user'] = $this->ion_auth->user($id)->row();


		//$data['title'] = $this->lang->line('title_profile')." ".$data['profile']['display_name'];
		$data['tipo'] = 'profile';

        $this->load->view('front/profile_index', $this->data); 

	}

	function staff()
	{
		$this->output->prepend_title($this->lang->line('title_staff'));
		$this->data['users'] = $this->ion_auth->users()->result();
			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}

        $this->load->view('front/profile_staff', $this->data);

	}

}

?>