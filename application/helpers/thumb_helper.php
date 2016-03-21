<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Thumb()
 * A TimThumb-style function to generate image thumbnails on the fly.
 *
 * @author Darren Craig
 * @author Lozano Hernán <hernantz@gmail.com>
 * @access public
 * @param string $src
 * @param int $width
 * @param int $height
 * @param string $image_thumb
 * @return String
 *
 */


function thumb($src, $width, $height, $image_thumb = '') {

	// Get the CodeIgniter super object
	$CI =& get_instance();

	// get src file's dirname, filename and extension
	$path = pathinfo($src);

	// Path to image thumbnail
	if( !$image_thumb )
		$image_thumb = $path['dirname'] . "/thumb_" . $path['filename']."." . $path['extension'];

	if ( !file_exists($image_thumb) ) {

		// LOAD LIBRARY
		$CI->load->library('image_lib');

		// CONFIGURE IMAGE LIBRARY

		$config['image_library'] = 'gd2';
		$config['source_image']	= $path['dirname']."/".$path['filename'].".".$path['extension'];
		$config['new_image'] = $image_thumb;
		$config['maintain_ratio'] = TRUE;
		$config['width']	= $width;
		$config['height']	= $height;

		$CI->image_lib->initialize($config);
		$CI->image_lib->resize();
		$CI->image_lib->clear();

	}

	return basename($image_thumb);
}

/* End of file thumb_helper.php */
/* Location: ./application/helpers/thumb_helper.php */