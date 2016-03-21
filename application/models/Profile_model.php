<?php
Class Profile_model extends CI_Model
{
  function get_profile($id = FALSE)
  {
    if($id == FALSE)
    {
      $query = $this->db->get('sm_profiles');
      return $query->result_array();
    }
    $query = $this->db->get_where('sm_profiles', array('codus' => $id));
    return $query->row_array();
  } 
}
?>