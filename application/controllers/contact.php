<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

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

	function __construct()
	{
		parent::__construct();
		$this->load->model('contact_model');
		$this->lang->load('app');
	}

	public function index()
	{
		$this->load->helper('form');
		
		$lang = $this->lang->lang();
		//$this->validatorForm();		
		$form = form_open(
							base_url().$lang.'/contact/validatorForm', 
						array(
								'name' => 'form-contact',
								'role' => 'form',
								
						));
		
		$input = form_input(array(
				'name' => 'name',
              'id'    => 'name',
              'class' => "text",
              'placeholder' => lang('placename'), 
              

		));
		
		$email = form_input(array(
				'name' => 'email',
              'id'    => 'email',
              'class' => "text",
              'placeholder' => lang('placeemail')
		));
		
		$textarea = form_textarea(array(
								 'name' => 'message',
								 'id' => 'message',
								 'placeholder' => lang('placemensage')
								));

		$data= array(
						'form' => $form,
						'input' => $input,
						'textarea' => $textarea,
						'email' => $email,
					);

		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view('contact', $data);
		$this->load->view('templates/footer');
	}

	function validatorForm()
	{
		
		$this->load->library('form_validation');
		$config = array(
               array(
                     'field'   => 'name', 
                     'rules'   => 'required',
                     'label'  => lang('name')
                  ),
               array(
                     'field'   => 'email', 
                     'rules'   => 'required|valid_email',
                     'label'  => lang('placenemail')
                  ),
               array(
                     'field'   => 'message', 
                     'rules'   => 'required',
                     'label'  => lang('mensage')
                  ),   
            );
         $this->form_validation->set_rules($config);
        
		if(isset($_POST))
		{
			//var_dump($_POST);
			$data = array(	
							'name'=>array( 'value' => $_POST['name'], 'error' => false, 'error_message' => 'Name must not empty'),
							'email' => array( 'value' => $_POST['email'], 'error' => false, 'error_message' => 'Email must not empty'),
							'message' => array( 'value' => $_POST['message'], 'error' => false, 'error_message' => 'Text must not empty'),
							'validator' => false,
							);

			if($this->form_validation->run())
			{
					$this->contact_model->newContact($_POST['name'],$_POST['email'],$_POST['message'],'');
					$data['validator'] = true;
					$data['thank'] ="Thank you";
			}else
				{
					if(form_error('name') != '')
					{
						$data['name']['error'] = form_error('name');
					}
					
					if(form_error('email') != '')
					{
						$data['email']['error'] = form_error('email');
					}
					
					if(form_error('message') != '')
					{
						$data['message']['error'] = form_error('message');
					}
					//$this->form_validation->set_message('valid_email', 'The Email field must contain a valid email address.');

				}
			 //echo json_encode(validation_errors());
			 echo json_encode($data);
			
		}

		
	}
}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */