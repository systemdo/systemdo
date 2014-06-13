<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller {

	
	private $game;
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
		$this->load->model('service_model');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->buildQuestionsAndAnswerds();
		$this->lang->load('app');
		$this->lang->load('services');
	}
	

	public function index()
	{
		$this->load->helper('form');
		
		$lang = $this->lang->lang();
		//$this->validatorForm();		
		$form = form_open(
							base_url().$lang.'/service/validatorForm', 
						array(
								'name' => 'form-service',
								'role' => 'form',
								
						));
		
		$input = form_input(array(
				'name' => 'name',
              'id'    => 'name',
              'class' => "form-control",
              'placeholder' => lang("placename"), 
              

		));
		
		$email = form_input(array(
				'name' => 'email',
              'id'    => 'email',
              'class' => "form-control",
              'placeholder' => lang("placeemail")
		));
		
		$textarea = form_textarea(array(
								 'name' => 'text',
								 'id' => 'text',
								 'class' => 'form-control',
								 //'placeholder' => "Enter what you think"
								));

		$data= array(
						'form' => $form,
						'input' => $input,
						'textarea' => $textarea,
						'email' => $email,
						'lang' => $lang
					);

		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view('service', $data);
		$this->load->view('templates/footer');
	}

	function validatorForm()
	{
		
		$lang = $this->lang->lang();
		$config = array(
               array(
                     'field'   => 'name', 
                     'rules'   => 'required',
                     'label'  => lang('name'),
                  ),
               array(
                     'field'   => 'email', 
                     'rules'   => 'required|valid_email',
                     'label'  => lang('email'),
                  ),
               array(
                     'field'   => 'text', 
                     'rules'   => 'required',
                     'label'  => lang('text'),
                  ),   
            );
         $this->form_validation->set_rules($config);
        
		if(isset($_POST))
		{
			//var_dump($_POST);
			$data = array(	
							'name'=>array( 'value' => $_POST['name'], 'error' => false, 'error_message' => 'Name must not empty'),
							'email' => array( 'value' => $_POST['email'], 'error' => false, 'error_message' => 'Email must not empty'),
							'text' => array( 'value' => $_POST['text'], 'error' => false, 'error_message' => 'Text must not empty'),
							'validator' => false,
							);
			if($this->form_validation->run())
			{
					$this->service_model->newSevice($_POST['name'],$_POST['email'],$_POST['text'],'');
					$data['validator'] = true;
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
					
					if(form_error('text') != '')
					{
						$data['text']['error'] = form_error('text');
					}
					//$this->form_validation->set_message('valid_email', 'The Email field must contain a valid email address.');

				}
			 //echo json_encode(validation_errors());
			 echo json_encode($data);
			
		}

		
	}

	function questions()
	{
		$this->load->helper('form');
		$lang= $this->lang->lang();
		
		$session = $this->session->userdata('questions');
		if($session)
			redirect(base_url().$lang.'/service/question/'.$this->session->userdata('question'));

		$form = form_open(
							base_url().$lang.'/service/questions', 
						array(
								'name' => 'form-questions',
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
              'placeholder' => lang('placeemail'), 
		));
		
	
		$data= array(
						'form' => $form,
						'input' => $input,
						'email' => $email,
						'lang' => $lang
					);

		
		//after send the email 
		$config = array(
               array(
                     'field'   => 'name', 
                     'rules'   => 'required||min_length[5]',
                     'label'  => lang('name')
                  ),
               array(
                     'field'   => 'email', 
                     'rules'   => 'required|valid_email',
                     'label'  => lang('email')
                  ),
            );
         $this->form_validation->set_rules($config);

		if(isset($_POST))
		{
		
			if($this->form_validation->run())
			{
				$this->session->set_userdata('questions' ,array('email' => htmlentities($_POST['email']), 'name' =>htmlentities($_POST['name'])));
				$this->session->set_userdata('question' , 1);
				redirect(base_url().$lang.'/service/question/1' );
			}	

		}	

		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view('questions', $data);
		$this->load->view('templates/footer');

	}
	
	
	/*playing*/
	function question($number)
	{

		$this->load->helper('form');
		$lang= $this->lang->lang();
		$session = $this->session->userdata('questions');
		$session2 = $this->session->userdata('question');
		

		//var_dump($this->session->all_userdata());
		
		
		if(!$session)
		{
			redirect(base_url().$lang.'/service/questions');die();
		}
		else{
				if($session2 != $number){
					//var_dump($session2['question']);
					//die('hola2');
					redirect(base_url().$lang.'/service/questions/'.$session2);die();	
				}
			}
			//die('hols12');
		//var_dump($_POST);
		//var_dump(array_keys($_POST));

		//die();
		//played and answers
		if(isset($_POST) && count($_POST) > 0)
		{
			$post_question = $_POST;
			$key = array_keys($post_question);
			switch ($key[0]) {
				case 'question1':
					$this->session->set_userdata('answer1', array('1' => $post_question['question1']['opccion']) );
					$this->session->set_userdata('question' ,2);
					redirect(base_url().$lang.'/service/questions/2');die();	
				break;
				case 'question2':
					$this->session->set_userdata('answer2', array('2' => $post_question['question2']['opccion']) );
					$this->session->set_userdata('question' ,3);
					redirect(base_url().$lang.'/service/questions/3');die();
				break;
				case 'question3':
					$this->session->set_userdata('answer3', array('3' => $post_question['question3']['opccion']) );
					$this->session->set_userdata('question' ,'end');
					redirect(base_url().$lang.'/service/end');die();
				break;
				
				default:
					
					break;
			}
		}
		$form = form_open(
							base_url().$lang.'/service/question/'.$number, 
						array(
								'name' => 'form-questions',
								'role' => 'form',
								
						));
		
		//question
		switch ($number) {
			case '1':
				$question = "What you think about php?";
				$opccions = array('1'=>'It \'sheap',  '2' => 'Too much expansive', '3' => 'old language');
			break;
			case '2':
				$question = "What do you wanted for your website?";
				$opccions = array('1'=>'Colour site',  '2' => 'Buy things', '3' => 'Dinamic site');
			break;
			case '3':
				$question = "What do you think about tecnology";
				$opccions = array('1'=>'Dificult',  '2' => 'easy', '3' => 'Scheat');
			break;
			
			default:
				redirect(base_url().$lang.'/service/end');die();
			break;
		}
		 
				
		$opccion1 = form_radio(array(
				'name' => 'question'.$number.'[opccion]',
              'id'    => 'question'.$number.'[opccion]',
              'class' => "",
              'value' =>'1'
		));
		$opccion2 = form_radio(array(
				'name' => 'question'.$number.'[opccion]',
              'id'    => 'question'.$number.'[opccion]',
              'class' => "",
              'value' =>'2'
		));
		$opccion3 = form_radio(array(
				'name' => 'question'.$number.'[opccion]',
              'id'    => 'question'.$number.'[opccion]',
              'class' => "",
              'value' =>'3'
		));
		
		
		$data= array(
						'form' => $form,
						'number'=> $number,
						'question' => $question,
						'opccions' => $opccions,
						'opccion1' => $opccion1,
						'opccion2' => $opccion2,
						'opccion3' => $opccion3,
						'name'=> $session['name'],
						'email'=> $session['email'],
					);

		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view('question1', $data);
		$this->load->view('templates/footer');

	} 

	function end()
	{
		$lang = $this->lang->lang();
		//echo '<pre>';
//var_dump($this->session->userdata('answer2'));
//var_dump($this->game);
		$answer1 = $this->session->userdata('answer1');
		$answer2 = $this->session->userdata('answer2');
		$answer3 = $this->session->userdata('answer3');
		
		if(!$answer1 && !$answer2 && !$answer3 )
		{
			redirect(base_url().$lang.'/service/question');
		}
		

		$data = array(
						'thanks' => 'Thanks to participate',
						'message' => 'For question: ', 
						'message1'=> 'You answer us: ',
						'lang' => $lang,
						'played' => 
						array(
								'1' =>array($this->game[1]['question'] => $this->game[1]['answer'][$answer1[1]]), 
								'2'=>array($this->game[2] ['question']=> $this->game[2]['answer'][$answer2[2]]),
							 	'3' => array($this->game[3]['question'] => $this->game[3]['answer'][$answer3[3]]),
							 )
					);

		//$this->session->unset_userdata('question');
		//$this->session->unset_userdata('questions');
		//var_dump($data['played']);
		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view('thanks_question', $data);
		$this->load->view('templates/footer');

		$this->session->sess_destroy();
	} 

	function buildQuestionsAndAnswerds()
	{
		$this->game = array( 
								'1' => array('question' =>'What you think about php?', 'answer' => array( '1'=>'It \'sheap', '2'=> 'Too much expansive', '3'=>'old language')),
								'2'=> array('question' =>"What do you wanted for your website?", 'answer' => array('1'=>'Colour site',  '2' => 'Buy things', '3' => 'Dinamic site')),
								'3'=> array( 'question' =>"What do you think about tecnology", 'answer' => array('1'=>'Dificult',  '2' => 'easy', '3' => 'Scheat'))
							);

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */