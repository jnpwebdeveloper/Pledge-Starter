<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->library('Api');

		$lastfm_artist = $this->api->get_last_fm_artist('Thrice');
		$this->load->view('welcome_message', array('lastfm' => $lastfm_artist));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */