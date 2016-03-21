<?php

class Chapter extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("mangas_model","mangas_model");
        $this->load->model("news_model","news_model");
        $this->load->model("chapters_model","chapters_model");
        $this->load->helper('url_helper');
        $this->lang->load('admin_lang', $this->config->item('language'));
        $this->load->helper('inflector');
        
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

    public function index(){
        $this->load->js('assets/themes/admin/js/jquery.dataTables.js');
        $this->load->css('assets/themes/admin/css/jquery.dataTables.min.css');
        $data['chapters'] = $this->chapters_model->get_latest_chapter();
        $data['mangas'] = $this->mangas_model->get_mangas();
        $this->output->prepend_title(plural($this->lang->line('chapter')));
        
        $this->load->view('admin/list_chapters', $data);
    }

    public function add()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['mangas'] = $this->mangas_model->get_mangas();
        $this->form_validation->set_rules('chapter', 'chapter', 'trim|required|integer');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $data['errors'] = '';

        if ($this->form_validation->run() !== FALSE)
        {
            $chapter = $this->input->post('chapter');
            $codma = $this->input->post('series');
            $lang = $this->input->post('language');
            $data['manga'] = $this->mangas_model->get_mangas($codma);
            $stub = $data['manga']['stub'];
            $uniqid_manga = $data['manga']['uniqid'];
            $uniqid_chapter = uniqid();

            $this->chapters_model->create_chapter_dir($stub, $uniqid_manga, $chapter, $uniqid_chapter);
            $data['errors'] = $this->chapters_model->upload($codma, $stub, $uniqid_manga, $chapter, $uniqid_chapter, $lang);

            $data['tipo'] = 'add_chapter';
            $data['title'] = $this->lang->line('add_chapter');
            $this->load->view('admin/add_chapter', $data); 

        }
        else{
            $data['tipo'] = 'add_chapter';
            $data['title'] = $this->lang->line('add_chapter');
            $this->load->view('admin/add_chapter', $data);
        }
    }

    public function remove($id)
    {
        $id= $this->input->post('id');
        $this->chapters_model->remove_chapter($id);

        redirect('admin/chapter/', 'refresh');
    }

    public function edit($id)
    {
        if($id == FALSE)
        {
            
        }
        else
        {
            $this->load->helper('form');
            $this->load->library('form_validation');
            $data['mangas'] = $this->mangas_model->get_mangas_name_id();
            $data['chapter'] = $this->chapters_model->get_chapter($id);
            $this->load->view('admin/edit_chapter', $data); 
        }
    }

    public function update()
    {
        $id = $this->input->post('id'); // Set id variable
        $codma = $this->input->post('type');
        $data['serie'] = $this->mangas_model->get_mangas($id); // Need it to get old values
        $data['chapter'] = $this->chapter_model->get_chapter($id); // Need it to get old values            

        $path = "./content/comics/".$data['serie']['stub']."_".$data['serie']['uniqid']."/".$chapter['chapter']."_".$chapter['uniqid'];


        //If archive isn't uploaded then don't update it
        $config['upload_path']   =   $path;
        $config['allowed_types'] = 'zip|rar';
        $config['max_size'] = '40144';
     
        $this->load->library('upload',$config);
        if(!$this->upload->do_upload('cover'))
        {
            //Make a data[] with the content to update
            $data = array(
                'codma' => $this->input->post('codma'),
                'chapter' => $this->input->post('chapter'),
                'language' => $this->input->post('language'),
                'name' => $this->input->post('name'),
                'uniqid' => $chapter['uniqid'],
                'download1' => $this->input->post('link1'),
                'download2' => $this->input->post('link2'),
                'hidden' => 0,
                'updated' => date('Y-m-d H:i:s')
            );

            $this->chapters_model->update_chapter($id,$data);

            //Let's rename dir
            if(!is_dir($path))
            {
                mkdir($path,0777);
            }
            $newPath = "./content/comics/".$data['serie']['stub']."_".$data['serie']['uniqid']."/".$this->input->post('chapter')."_".$chapter['uniqid'];
            rename($path, $newPath);

        }
        else {             
            $finfo = $this->upload->data();
            //Make a data[] with the content to update
            $data = array(
                'codma' => $this->input->post('codma'),
                'chapter' => $this->input->post('chapter'),
                'language' => $this->input->post('language'),
                'name' => $this->input->post('name'),
                'uniqid' => $chapter['uniqid'],
                'download1' => $this->input->post('link1'),
                'download2' => $this->input->post('link2'),
                'hidden' => 0,
                'updated' => date('Y-m-d H:i:s')
            );

            $this->chapters_model->update_chapter($id,$data);

            $newPath = "./content/comics/".$data['serie']['stub']."_".$data['serie']['uniqid']."/".$this->input->post('chapter')."_".$chapter['uniqid'];
            //Let's delete the old path and make a new one!
            if(!is_dir($newPath))
            {
                mkdir($newPath,0777);
            }
            $this->chapters_model->remove_chapter_dir($data['serie']['stub'], $data['serie']['uniqid'], $chapter['chapter'], $chapter['uniqid']);
            

            //Extract zip
            $data = array('upload_data' => $this->upload->data());
            $zip = new ZipArchive;
            $file = $data['upload_data']['full_path'];
            chmod($file,0777);

            if ($zip->open($file) === TRUE) {
                    $zip->extractTo($newPath);
                    $zip->close();
                    $errors = array('error' => '<p>File uploaded successfully</p>');
                    unlink($file);
            } else {
                    $errors = array('error' => '<p>Extract failed</p>');
            }
            

        } // end /if(! $this->upload->do_upload('cover'))

        redirect('admin/chapter/', 'refresh');
    }
}