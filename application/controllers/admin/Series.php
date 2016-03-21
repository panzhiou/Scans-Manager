 <?php

class Series extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("mangas_model","mangas_model");
        $this->load->model("news_model","news_model");
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
        $data['series'] = $this->mangas_model->get_mangas();
        $this->load->view('admin/list_series', $data); 
    }

    public function add()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['tipo'] = 'add_serie';
        $data['title'] = $this->lang->line('add_serie');
        $this->form_validation->set_rules('name', $this->lang->line('name'), 'required');
        $this->form_validation->set_rules('author', $this->lang->line('author'), 'required');
        $this->form_validation->set_rules('artist', $this->lang->line('artist'), 'required');
        $this->form_validation->set_rules('description', $this->lang->line('description'), 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $data['tipo'] = 'add_series';
            $data['title'] = $this->lang->line('add_news');
            $this->load->view('admin/add_series'); 
        }
        else
        {
            $slug = url_title($this->input->post('name'), '_', TRUE);
            $uniqid = uniqid();
            $path = "./content/comics/".$slug."_".$uniqid."/";
            if(!is_dir($path))
            {
                mkdir($path,0777);
            }

            $config['upload_path']   =   $path;
            $config['file_name']   =   'coverImage_'.$uniqid;
            $config['allowed_types'] =   "jpg|jpeg|png"; 
            $config['max_size']      =   "5000";
            $config['max_width']     =   "1907";
            $config['max_height']    =   "1280";
     
            $this->load->library('upload',$config);
     
            if(!$this->upload->do_upload("cover"))
            {
                echo $this->upload->display_errors();
                rmdir($path); // Error = new Uniqueid, so we need to delete this old dir who is now useless
            }
            else
            {
               $finfo = $this->upload->data();
               $this->mangas_model->insert_manga($uniqid, $finfo['file_name']);

               redirect('admin/series', 'refresh');
            }

        } // end/ if($this->form_validation->run() === FALSE)

    }

    public function edit($id=FALSE)
    {
        if($id == FALSE)
        {
            
        }
        else
        {
            $this->load->helper('form');
            $this->load->library('form_validation');
            $data['serie'] = $this->mangas_model->get_mangas($id);
            $this->load->view('admin/edit_series', $data); 
        }
    }

    public function update()
    {
        $id = $this->input->post('id'); // Set id variable
        if($this->input->post('adult') != 1) { $adult = 0;} else { $adult = 1;} // Set a variable for Adult
        if($this->input->post('hidden') != 1) { $hidden = 0;} else { $hidden = 1;} // Set a variable for Hidden
        $type = $this->input->post('type');
        $stub = url_title($this->input->post('name'), '_', TRUE); //Create a new stub
        $data['serie'] = $this->mangas_model->get_mangas($id); // Need it to get old values
        $uniqid = $data['serie']['uniqid'];
            

        $oldPath = "./content/comics/".$data['serie']['stub']."_".$uniqid;
        $oldcover = $data['serie']['thumbail'];
        $newPath = "./content/comics/".$stub."_".$uniqid;

        //If archive isn't uploaded then don't update it
        $newPath = "./content/comics/".$stub."_".$uniqid."/";
        $config['upload_path']   =   $newPath;
        $config['allowed_types'] =   "jpg|jpeg|png"; 
        $config['file_name']   =   'coverImage_'.$uniqid;
        $config['max_size']      =   "5000";
        $config['max_width']     =   "1907";
        $config['max_height']    =   "1280";
     
        $this->load->library('upload',$config);
        if(!$this->upload->do_upload('cover'))
        {
            //Make a data[] with the content to update
            $data = array(  
                'name' => $this->input->post('name'),
                'stub' => $stub,
                'hidden' => $hidden,
                'author' => $this->input->post('author'),
                'artist' => $this->input->post('artist'),
                'type' => $type,
                'status' => $this->input->post('status'),
                'description' => $this->input->post('description'),
                'adult' => $adult,
                'updated' => date('Y-m-d H:i:s')
            );

            $this->mangas_model->update_manga($id,$data);

            //Let's rename dir
            if(!is_dir($oldPath))
            {
                mkdir($oldPath,0777);
            }
            rename($oldPath, $newPath);

        }
        else {             
            $finfo = $this->upload->data();
            //Make a data[] with the content to update
            $data = array(
                'name' => $this->input->post('name'),
                'stub' => $stub,
                'hidden' => $hidden,
                'author' => $this->input->post('author'),
                'artist' => $this->input->post('artist'),
                'type' => $type,
                'status' => $this->input->post('status'),
                'description' => $this->input->post('description'),
                'thumbail' => $finfo['file_name'],
                'adult' => $adult,
                'updated' => date('Y-m-d H:i:s')
            );

            $this->mangas_model->update_manga($id,$data);

            //Let's rename dir
            if(!is_dir($oldPath))
            {
                mkdir($oldPath,0777);
            }
            rename($oldPath, $newPath);

            //Now delete thumb (if them exist, of course), because they're automatically created later
            if (file_exists($oldPath."/".$oldcover))
            {
                unlink($oldPath."/".$oldcover); // if exist, Delete file
            }
            if (file_exists($oldPath."/thumb_".$oldcover))
            {
                unlink($oldPath."/thumb_".$oldcover); // if exist, Delete thumb_ file
            }
            if (file_exists($oldPath."/thumb2_".$oldcover))
            {
                unlink($oldPath."/thumb2_".$oldcover); // if exist, delete thumb2_ file
            }

        } // end /if(! $this->upload->do_upload('cover'))

        redirect('admin/series/', 'refresh');
    }
}