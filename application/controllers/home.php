<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//$this->load->helper('language');

		$this->load->library('/Geoip/Geoip');

		$this->load->library('session');
		$infocliente = $this->session->all_userdata();
		$lang = $this->geoip->getUserLanguage();	
		//var_dump($this->geoip->getCountry());
		$this->lang->load('app');
		$this->lang->load('home');
		//var_dump(lang("welcome"));
		$this->load->view('templates/header');
		$this->load->view('home' ,$data = array('lang' => $lang));
		$this->load->view('templates/footer');


	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */