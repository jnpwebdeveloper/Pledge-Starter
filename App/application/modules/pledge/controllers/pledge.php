<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pledge extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('pledge_m');
	}


}

/* End of file project.php */
/* Location: ./application/modules/pledge/controllers/pledge.php */