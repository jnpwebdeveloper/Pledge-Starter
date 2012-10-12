<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('project_m');
	}

	public function index()
	{
		$this->page_value('project', $this->project_m->get_recent_project());

		$this->parser->parse('project', $this->data);
	}

	public function view($project_id)
	{
		$this->parser->parse('project', $this->data);	
	}
}

/* End of file project.php */
/* Location: ./application/modules/project/controllers/project.php */