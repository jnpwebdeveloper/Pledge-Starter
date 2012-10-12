<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pledge_m extends CI_Model {

	public function insert($data)
	{	
		// Create a slug
		$data['slug'] = url_title($data['name'], '-', TRUE);

		// Insert into database
		$this->db->insert('projects', $data);
	}

}