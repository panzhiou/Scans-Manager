<?php
Class Position_model extends CI_Model
{
  function get_position($id = FALSE)
  {
    if($id == FALSE)
    {
      $query = $this->db->get('sm_position');
      return $query->result_array();
    }
    $query = $this->db->get_where('sm_position', array('codus' => $id));
    return $query->row_array();
  }


  function get_chapter_by_id($id, $codch= FALSE)
  {
    if($codch == FALSE)
    {
      $query = $this->db->get_where('sm_position', array('codus' => $id));
      return $query->result_array();
    }
    $query = $this->db->get_where('sm_position', array('codus' => $id,'codch' => $codch));
    return $query->row_array();
  }

  function get_position_by_id($id)
  {
    $this->db->select('position');
    $this->db->group_by("position"); 
    $query = $this->db->get_where('sm_position', array('codus' => $id));
    
    return $query->result_array();
  }
}
?>