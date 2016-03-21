<?php
class Manga extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model("chapters_model","chapters_model");
                $this->load->model("mangas_model","mangas_model");
                $this->load->helper('url');
                $this->lang->load('reader_lang', $this->config->item('language'));
                $this->load->helper('date');
                $this->load->helper('inflector');
                $this->_init();
        }

        private function _init()
        {
                $this->output->set_template('default');
                $this->output->set_title($this->config->item('title_site'));
        }

        public function index($name = null)
        {
                if($name == NULL) 
                {
                        $this->load->js('assets/themes/default/js/isotope.pkgd.min.js');
                        // Load list of all comics
                        $this->output->prepend_title($this->lang->line('title_manga_directory'));
                        $data['url_actual'] = site_url("manga/");
                        $data['url_ch'] = site_url("reader/");
                        $data['mangas'] = $this->mangas_model->get_mangas(); 
                        $data['latest'] = $this->chapters_model->get_latest_chapter('limit',10);

                        $this->load->section('parallax', 'parallax');
                         
                        $this->load->view('front/manga_list', $data);
                }
                else
                {
                        //Load comic by Id
                        $data['manga_info'] = $this->mangas_model->get_mangas_by_stub($name);
                        $data['chapters'] = $this->chapters_model->get_chapters($data['manga_info']['codma']);
                        $data['mangas'] = $this->mangas_model->get_mangas_name_id();
                        $data['latest'] = $this->chapters_model->get_latest_chapter('limit',10);
                        $data['url_actual'] = site_url("reader/".$data['manga_info']['stub']."/");

                        if($data['manga_info'] == null || $data['manga_info']['hidden'] != 0)  
                        {
                                // if manga doesn't exist
                                show_404();
                        }
                        else{
                                $this->output->prepend_title($data['manga_info']['name']);

                                $this->load->css('assets/css/flag-icon.min.css');
                                
                                $this->load->section('parallax', 'parallax');
                                $this->load->section('sidebar', 'sidebar', $data);

                                $this->load->view('front/manga_index', $data);
                        }

                }
                
        }


        
}