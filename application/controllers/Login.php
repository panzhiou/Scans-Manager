<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
	   parent::__construct();
	}

	function index()
	{
		if(!$this->session->userdata('logged_in'))
		{
	   	$this->load->helper(array('form'));
	   	$data['title'] = 'Login';
	   	$data['tipo'] = 'Login';
	   	$this->load->view('login/login_view');
	   }
	   else
	   {
	   		redirect('admin/dashboard', 'refresh');
	   }
	}

}

?>