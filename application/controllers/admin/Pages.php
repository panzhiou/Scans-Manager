<?php

class Pages extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("mangas_model","mangas_model");
        $this->load->model("chapters_model","chapters_model");
        $this->load->helper('url_helper');
        $this->lang->load('admin_lang', $this->config->item('language'));
        
        $this->load->database();
        $this->load->library(array('ion_auth','form_validation'));
        $this->load->helper(array('url','language'));

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->_init();
        $this->lang->load('auth');
    }

    private function _init()
    {
        $this->output->set_template('admin');
        $this->output->set_title($this->lang->line('logo_header'));
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
        {
            // redirect them to the home page because they must be an administrator to view this
            return show_error($this->lang->line('error_noadmin'));
        }
        else {
            $user = $this->ion_auth->user()->row();
            $this->data['login_username'] = $user->username;

        }

        $this->load->section('user_details', 'admin/user_details', $this->data);
    }

    public function index()
    {

        $this->load->view('admin/add_pages');

    }

    

}