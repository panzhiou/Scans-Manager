<?php
class Reader extends CI_Controller {
 
        public function __construct()
        {
                parent::__construct();
                $this->load->model("chapters_model","chapters_model");
                $this->load->model("mangas_model","mangas_model");
                $this->load->helper('url_helper');
                $this->lang->load('reader_lang', $this->config->item('language'));
                $this->_init();
        }

        private function _init()
        {
                $this->output->set_template('reader');
        }

        public function index($name = null , $chapter = 0, $lang=null)
        {
                $this->load->helper('file');

                //Set some variable to do the things easy, or something...
                $data['manga'] = $this->mangas_model->get_mangas_by_stub($name);
                $data['chapter'] = $this->chapters_model->get_chapter_lang($chapter,$lang);
                $data['chapters'] = $this->chapters_model->get_latest_ten_chapter_lang($data['manga']['codma'],$lang);
                $data['url_manga'] = site_url("reader/".$name."/");
                $data['url_actual'] = site_url("reader/".$name."/".$chapter."/".$lang."/#1");

                // Need this for find url
                $stub = $data['manga']['stub'];
                $uniqid_manga = $data['manga']['uniqid'];
                $uniqid_chapter = $data['chapter']['uniqid'];

                $data['series']         = $data['manga']['codma'];
                $data['chapter_num']    = $chapter;
                //$data['sel_page']     = (int)$page; for index_
                $data['lastchapter']    = $this->chapters_model->get_last_chapter($data['manga']['codma']); //To check if the actual chapter is the latest
                $data['images_array']   = $this->chapters_model->get_chapter_files($stub, $uniqid_manga, $chapter, $uniqid_chapter); // Get pages from chapter
                $data['page_num']       = count($data['images_array']); // count total pages
                $data['dir']            = base_url()."/content/comics/".$stub."_".$uniqid_manga."/".$chapter."_".$uniqid_chapter."/"; // Set dir of path where are images hosted


                if($data['manga'] == null || $data['chapter'] == null ) 
                {
                        redirect('manga');
                }
                else{
                        $this->output->set_title($data['manga']['name']." :: ".$this->lang->line('chapter')." ".$chapter. " " . $this->config->item('title_site'));

                        $this->load->view('front/reader_index', $data);
                }
                
        }

        
}