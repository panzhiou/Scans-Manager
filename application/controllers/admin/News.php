<?php

class News extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("news_model","news_model");
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
        $this->load->js('assets/themes/admin/js/jquery.dataTables.js');
        $this->load->css('assets/themes/admin/css/jquery.dataTables.min.css');
        $data['news'] = $this->news_model->get_news();
        $this->output->prepend_title($this->lang->line('news'));
        
        $this->load->view('admin/list_news', $data);

    }

    public function add()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->output->set_title($this->lang->line('add_news'));
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $data['tipo'] = 'add_news';
            $data['title'] = $this->lang->line('add_news');

            $this->load->view('admin/add_news'); 

        }
        else
        {
            $this->news_model->insert_news();
            redirect('admin/news/', 'refresh');
        }   
    }

    public function edit($id = null)
    {
        if($id==null)
        {
            $this->index();
        }
        else
        {
            $this->output->set_title($this->lang->line('edit_news'));

            $this->load->helper('form');
            $this->load->library('form_validation');
                            
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('text', 'Text', 'required');
                            
            $data['tipo'] = 'add_news';
            $data['title'] = $this->lang->line('edit_news');
            $data['new'] = $this->news_model->_get_new($id);

            $this->load->view('admin/edit_news', $data);
        }
        
    }

    public function update()
    {
        $id= $this->input->post('id');
        $slug = url_title($this->input->post('title'), '_', TRUE);
        $data = array(
                'title' => $this->input->post('title'),
                'slug' => $slug,
                'text' => $this->input->post('text'),
                'created' => date('Y-m-d H:i:s')
        );
        $this->news_model->update_new($id,$data);
        $data['tipo'] = 'edit_news';
        $data['title'] = $this->lang->line('edit_news');
        $data['news'] = $this->news_model->get_news();

        $this->load->view('admin/list_news', $data);
    }

    public function remove($id){
        $id= $this->input->post('id');
        $this->news_model->delete_news($id);

        redirect('admin/news/', 'refresh');
    }
}