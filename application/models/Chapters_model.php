<?php
class Chapters_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    // Get chapter by chapter
    public function get_chapter($chapter)
	{
	    $query = $this->db->get_where('sm_chapters', array('chapter' => $chapter));
	    return $query->row_array();
	}

	public function get_chapter_lang($chapter, $lang)
	{
	    $query = $this->db->get_where('sm_chapters', array('chapter' => $chapter, 'language' => $lang));
	    return $query->row_array();
	}

	// Get latest ten chapters by chapter
	public function get_chapter_ten($chapter)
	{
		$this->db->limit(10);
	    $query = $this->db->get_where('sm_chapters', array('chapter' => $chapter));
	    return $query->row_array();
	}

	// Get latest chapter by manga
	public function get_last_chapter($manga)
	{
		$sql = "SELECT chapter FROM sm_chapters WHERE codma = $manga GROUP BY chapter  DESC LIMIT 1";
	    return $this->db->query($sql)->row_array();
	}

	// Get chapter all chapter or by manga
	public function get_chapters($manga = FALSE)
	{
	    if ($manga === FALSE) // get all
	    {
	        $query = $this->db->get('sm_chapters');
	        return $query->result_array();
	    }
	    
		$this->db->order_by("chapter", "desc");
		$query = $this->db->get_where('sm_chapters', array('codma' => $manga));

	    return $query->result_array();
	}

	// Get latest chapters
	public function get_latest_chapter()
	{
	    $sql = "SELECT * FROM sm_chapters GROUP BY created DESC";
	    return $this->db->query($sql)->result_array();
	}

	// Get latest ten chapters by manga
	public function get_latest_ten_chapter($manga)
	{
	    $sql = "SELECT * FROM sm_chapters WHERE codma = '$manga' GROUP BY created DESC LIMIT 10";
	    return $this->db->query($sql)->result_array();
	}

	public function get_latest_ten_chapter_lang($manga,$lang)
	{
	    $sql = "SELECT * FROM sm_chapters WHERE codma = '$manga' and language = '$lang' GROUP BY created DESC LIMIT 10";
	    return $this->db->query($sql)->result_array();
	}

	// Get chapter files (images) this return an array with name
	public function get_chapter_files($stub, $uniqid_manga, $chapter, $uniqid_chapter) {

		$dir = "./content/comics"."/".$stub."_".$uniqid_manga."/".$chapter."_".$uniqid_chapter."/";
		
		$file_array = get_filenames($dir);
		
		sort($file_array); // Add all to array
		
		return $file_array;
		
	}

	// Create a folder for Chapter when its okay
	public function create_chapter_dir($stub, $uniqid_manga, $chapter, $uniqid_chapter) {

		if (!is_dir('.'.DIRECTORY_SEPARATOR."content".DIRECTORY_SEPARATOR."comics".DIRECTORY_SEPARATOR.$stub."_".$uniqid_manga.DIRECTORY_SEPARATOR.$chapter."_".$uniqid_chapter)) {
			mkdir('.'.DIRECTORY_SEPARATOR."content".DIRECTORY_SEPARATOR."comics".DIRECTORY_SEPARATOR.$stub."_".$uniqid_manga.DIRECTORY_SEPARATOR.$chapter."_".$uniqid_chapter, 0777);
		}
	}

	// Remove folder and all content when we delete the chapter
	private function remove_chapter_dir($stub, $uniqid_manga, $chapter, $uniqid_chapter) {
		rmdir('.'.DIRECTORY_SEPARATOR."content".DIRECTORY_SEPARATOR."comics".DIRECTORY_SEPARATOR.$stub."_".$uniqid_manga.DIRECTORY_SEPARATOR.$chapter."_".$uniqid_chapter);
	}

	// Upload method, this get and insert all you need for chapter
	public function upload($codma, $stub, $uniqid_manga, $chapter, $uniqid_chapter, $lang) {

		// upload library configuration
		$config['upload_path'] = realpath('.'.DIRECTORY_SEPARATOR."content".DIRECTORY_SEPARATOR."comics".DIRECTORY_SEPARATOR.$stub."_".$uniqid_manga.DIRECTORY_SEPARATOR.$chapter."_".$uniqid_chapter);
		$config['allowed_types'] = 'zip|rar';
		$config['max_size']	= '40144';
		$where = array('codma' => $codma, 'chapter' => $chapter, 'language' => $lang);
		$query = $this->db->from('sm_chapters')->select('codch')->where($where)->get(); // check if the chapter already exists on the server
		if ($query->num_rows() == 0): // if it doesn't exists...
			$this->load->library('upload', $config);
			$this->create_chapter_dir($stub, $uniqid_manga, $chapter, $uniqid_chapter); // create a directory for the chapter
		if ($this->upload->do_upload() == FALSE) {
			$errors = array('error' => $this->upload->display_errors()); // save upload errors...
			if (!is_dir('.'.DIRECTORY_SEPARATOR."content".DIRECTORY_SEPARATOR."comics".DIRECTORY_SEPARATOR.$stub."_".$uniqid_manga.DIRECTORY_SEPARATOR.$chapter."_".$uniqid_chapter))
				$this->remove_chapter_dir($stub, $uniqid_manga, $chapter, $uniqid_chapter);
		} else {
			//Insert to DB
	        $data = array(
	            'codma' => $codma,
	            'codsc' => 1,
	            'chapter' => $this->input->post('chapter'),
	            'language' => $lang,
	            'name' => $this->input->post('name'),
	            'uniqid' => $uniqid_chapter,
	            'download1' => $this->input->post('link1'),
	            'download2' => $this->input->post('link2'),
	            'hidden' => 0,
	            'created' => date('Y-m-d H:i:s'),
            	'updated' => date('Y-m-d H:i:s')
	        );
	        $this->db->insert('sm_chapters', $data);

	        //Extract zip
	        $data = array('upload_data' => $this->upload->data());
	        $zip = new ZipArchive;
			$file = $data['upload_data']['full_path'];
			chmod($file,0777);

			if ($zip->open($file) === TRUE) {
    				$zip->extractTo('.'.DIRECTORY_SEPARATOR."content".DIRECTORY_SEPARATOR."comics".DIRECTORY_SEPARATOR.$stub."_".$uniqid_manga.DIRECTORY_SEPARATOR.$chapter."_".$uniqid_chapter);
    				$zip->close();
    				$errors = array('error' => '<p>File uploaded successfully</p>');
    				unlink($file);
			} else {
    				$errors = array('error' => '<p>Extract failed</p>');
			}
			
		}
		else:
			$errors = array('error' => '<p>The chapter already exists</p>');
		endif;
		return $errors;
	}
}