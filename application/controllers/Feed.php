<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed extends CI_Controller {

    function Feed()
    {
        parent::__construct();
        $this->load->model("mangas_model","mangas_model");
        $this->load->model("chapters_model","chapters_model");
        $this->lang->load('reader_lang');
        $this->load->helper('xml');
    }

    function index()
    {
        $data['encoding'] = 'utf-8';
        $data['page_language'] = 'es-es';
        $data['creator_email'] = 'Manuel Gutiérrez Heredia';
        $data['mangas'] = $this->mangas_model->get_mangas();
        $data['chapters'] = $this->chapters_model->get_latest_chapter();
        header("Content-Type: application/rss+xml; charset=utf-8");
        $this->load->view('feed/rss', $data);
    }
}
?>