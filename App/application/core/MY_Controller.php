<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $data = array();

	public function __construct()
	{
		parent::__construct();

		$this->data['site'] = array(
			'name'        => 'Bandlytics',
			'description' => 'Music analytics for artists and record labels.'
		);

		$this->parser->set_theme('bandlytics');
	}

	public function site_name($name = '')
	{
		if ($name == '')
		{
			return $this->data['site']['name'];
		}
		else
		{
			$this->data['site']['name'] = $name;
		}
	}

	public function page_id($id)
	{
		$this->data['page']['bodyid'] = $id;
	}	

	public function page_title($title)
	{
		$this->data['page']['title'] = $title;
	}

	public function page_description($description)
	{
		$this->data['page']['description'] = $description;	
	}

}

class Admin_Controller extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->parser->set_theme('admin');

		if (logged_in() AND !is_admin())
		{
			show_error('You have insufficient priveleges to access this resource.', 501);
		}
		elseif (!logged_in())
		{
			//show_error('You have insufficient priveleges to access this resource.', 501);	
		}

	}

}