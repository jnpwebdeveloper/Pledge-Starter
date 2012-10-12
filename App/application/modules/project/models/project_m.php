<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project_m extends CI_Model {

	public function get_recent_project()
	{
		// Get a project ordered by ID, descending for last row
		$project = $this->db->where('status', 'active')->order_by('id', 'DESC')->get('projects', 1, 0);

		// Return the project or FALSE
		return ($project->num_rows() == 1) ? $project->row() : FALSE;

		// Free the memory back up, query is over
		$project->free_result();
	}

	public function get($project_id)
	{
		// Get a project ordered by ID, descending for last row
		$project = $this->db->where('status', 'active')->where('id', $project_id)->get('projects', 1, 0);

		// Return the project or FALSE
		return ($project->num_rows() == 1) ? $project->row() : FALSE;

		// Free the memory back up, query is over
		$project->free_result();	
	}

	public function get_all($results = 10, $page = 0, $status = 'active')
	{
		// Get projects ordered by last row first
		$projects = $this->db->where('status', $status)->order_by('id', 'DESC')->get('projects', $results, $page);

		// Return the projects or FALSE
		return ($project->num_rows() >= 1) ? $project->result() : FALSE;

		// Free the memory back up, query is over
		$project->free_result();	
	}

	public function insert($data)
	{
		// Insert into database
		$this->db->insert('projects', $data);
	}

	public function update($data)
	{
		$project_id = $data['id'];
		unset($data['id']);

		$this->db->where('id', $project_id)->update($data);
	}

}