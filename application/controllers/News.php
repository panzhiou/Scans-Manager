<?php
class News extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model("news_model","news_model");
                $this->load->model("mangas_model","mangas_model");
                $this->load->model("chapters_model","chapters_model");
                $this->load->helper('url');
                $this->lang->load('reader_lang', $this->config->item('language'));
                $this->load->helper('text');
                $this->load->library("pagination");
                $this->_init();
        }

        private function _init()
        {
                $this->output->set_template('default');
                $this->output->set_title($this->config->item('title_site'));
        }

        public function index($offset=0)
        {
                $config = array();
                $config["base_url"] = base_url() . "news/";
                $config["total_rows"] = $this->news_model->record_count();
                $config["per_page"] = 1;
                $config["uri_segment"] = $offset;
                $config['num_tag_open'] = '<li class="waves-effect">';
                $config['full_tag_open'] = '<ul class="pagination">';
                $config['full_tag_close'] = '</ul>';
                $config['num_tag_close'] = '</li>';
                $config['next_tag_open'] = '<li class="waves-effect">';
                $config['next_tag_close'] = '</li>';
                $config['next_link'] = '<i class="material-icons">chevron_right</i>';
                $config['prev_tag_open'] = '<li class="disabled">';
                $config['prev_tag_close'] = '</li>';
                $config['prev_link'] = '<li class="waves-effect"><i class="material-icons">chevron_left</i></li>';
                $config['cur_tag_open'] = '<li class="active"><a href="#!">';
                $config['cur_tag_close'] = '</a></li>';

                $this->pagination->initialize($config);

                
                $data['news'] = $this->news_model->get_news($config['per_page'],$offset);
                $data["links"] = $this->pagination->create_links();

                $this->load->view("front/news_index", $data);

                // Data for Sidebar
                $data['latest'] = $this->chapters_model->get_latest_chapter();
                $data['mangas'] = $this->mangas_model->get_mangas_name_id();
                $this->output->prepend_title($this->lang->line('title_news'));

                $this->load->section('sidebar', 'sidebar', $data);
                $this->load->section('parallax', 'parallax');
        }

        public function view($id, $slug = NULL)
        {

                $data['news_item'] = $this->news_model->get_new($id, $slug);

                if (empty($data['news_item']))
                {
                        show_404();
                }
                else
                {
                        $data['latest'] = $this->chapters_model->get_latest_chapter('limit',10);
                        $data['mangas'] = $this->mangas_model->get_mangas_name_id();
                        $data['title'] = $data['news_item']['title'];
                        $this->output->prepend_title($data['news_item']['title']);
                        $data['tipo'] = 'news_single';

                        $this->load->section('sidebar', 'sidebar', $data);
                        $this->load->section('parallax', 'parallax');
                        
                        $this->load->view('front/news_view', $data);
                }
        }

}