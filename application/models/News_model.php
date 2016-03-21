<?php
class News_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function record_count() {
        return $this->db->count_all("sm_news");
    }

    // Get all news or by slug
    public function get_news($limit=null,$offset=null)
	{
        if($limit==null && $offset==null)
        {
            $query = $this->db->get('sm_news');
            return $query->result_array(); 
        }
        $query = $this->db->get('sm_news',$limit,$offset);
        return $query->result_array(); 
	}

    // Get news by id
    public function get_new($id, $slug)
    {
        $query = $this->db->get_where('sm_news', array('codnews' => $id,'slug' => $slug));
        return $query->row_array();
    }

    // Insert news
	public function insert_news()
    {
        $this->load->helper('url');
        $slug = url_title($this->input->post('title'), '_', TRUE);
        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'text' => $this->input->post('text'),
            'created' => date('Y-m-d H:i:s')
        );
        return $this->db->insert('sm_news', $data);
    }

    // Update a news
    public function update_new($id, $data)
    {
        $this->db->where('codnews', $id);
        $this->db->update('sm_news', $data); 
    }
}