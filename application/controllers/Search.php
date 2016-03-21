<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

	function __construct()
	{
	   parent::__construct();
	   $this->load->model("mangas_model","mangas_model");
       $this->load->model("chapters_model","chapters_model");
	   $this->load->helper('url_helper');
       $this->lang->load('reader_lang');
	}

	function index()
	{
		$data['title'] = $this->lang->line('title_search');
        $data['tipo'] = 'search';
        $data['url_actual'] = site_url("manga/"); //Set a base
        // Data for Sidebar
        $data['latest'] = $this->chapters_model->get_latest_chapter();
        $data['mangas'] = $this->mangas_model->get_mangas_name_id();

		$keyword    =   $this->input->post('search');
        $data['results']    =   $this->mangas_model->search($keyword);

		$this->load->view('templates/header', $data);
        $this->load->view('templates/nav');
        $this->load->view('templates/banner');
        $this->load->view('result_view',$data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/footer', $data);
	}

}

?>