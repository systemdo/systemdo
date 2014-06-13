<?php 

class Contact_model extends CI_Model {

    public $name;
    public $email;
    public $message;
    public $country;	
    
    function __construct()
    {
        parent::__construct();
    }

    function newContact($name,$email, $message, $country)
    {
    	
    	$this->name = $name;
    	$this->email = $email;
    	$this->message = $message;
    	$this->country = $country;

    	$data = array(
    					'name'=>$name,
    					'email'=>$email,
    					'country'=>$country,
    					'message'=>$message,
    				);
    	return $this->db->insert('contact',$data);
    }

    function setName($name)
    {
    	$this->name = $name;
    }

    function setEmail($email)
    {
    	$this->email = $email;
    }

    function setMessage($message)
    {
    	$this->message = $message;
    }

    function setCountry($country)
    {
    	$this->country= $country;
    }
}
?>