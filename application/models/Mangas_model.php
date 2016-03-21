<?php
class Mangas_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('inflector');
    }

    // Get all series or by id
    public function get_mangas($id = FALSE)
	{
	    if ($id === FALSE)
	    {
	        $query = $this->db->get('sm_mangas');
	        return $query->result_array();
	    }
	    $query = $this->db->get_where('sm_mangas', array('codma' => $id));
	    return $query->row_array();
	}

    public function get_mangas_by_stub($stub = FALSE)
    {
        if ($stub === FALSE)
        {
            $query = $this->db->get('sm_mangas');
            return $query->result_array();
        }
        $query = $this->db->get_where('sm_mangas', array('stub' => $stub));
        return $query->row_array();
    }

    // Get name, id and stub of all series
    public function get_mangas_name_id()
    {
        $sql = "SELECT name, codma, stub FROM sm_mangas";
        return $this->db->query($sql)->result_array();
    }

    // insert series
	public function insert_manga($uniqid, $thumb)
    {
        $this->load->helper('url');
        if($this->input->post('adult') != 1) { $adult = 0;} else { $adult = 1;} // Set a variable for Adult
        if($this->input->post('hidden') != 1) { $hidden = 0;} else { $hidden = 1;} // Set a variable for Hidden
        $stub = url_title($this->input->post('name'), '_', TRUE); //Create a stub
        $data = array(
            'name' => $this->input->post('name'),
            'uniqid' => $uniqid,
            'stub' => $stub,
            'hidden' => $hidden,
            'author' => $this->input->post('author'),
            'artist' => $this->input->post('artist'),
            'type' => $this->input->post('type'),
            'status' => $this->input->post('status'),
            'description' => $this->input->post('description'),
            'thumbail' => $thumb,
            'adult' => $adult,
            'created' => date('Y-m-d H:i:s'),
            'updated' => date('Y-m-d H:i:s')
        );
        return $this->db->insert('sm_mangas', $data);
    }

    public function update_manga($id, $data)
    {
        $this->db->where('codma', $id);
        $this->db->update('sm_mangas', $data); 
    }

    // Search serie
    public function search($keyword)
    {
        $this->db->like('name',$keyword);
        $query  =   $this->db->get('sm_mangas');
        return $query->result_array();
    }


}