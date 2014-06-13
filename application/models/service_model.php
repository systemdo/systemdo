<?php 

class Service_model extends CI_Model {
    
    public $name;
    public $email;
    public $text;
    public $country;	
    
    function __construct()
    {
        parent::__construct();
    }

    function newSevice($name,$email, $text, $country)
    {
    	
    	$this->name = $name;
    	$this->email = $email;
    	$this->text = $text;
    	$this->country = $country;

    	$data = array(
    					'name'=>$this->db->escape_str($name),
    					'email'=>$this->db->escape_str($email),
    					'country'=>$country,
    					'text'=>$this->db->escape_str($text),
    				);
    	return $this->db->insert('service',$data);
    }

    function setName($name)
    {
    	$this->name = $name;
    }

    function setEmail($email)
    {
    	$this->email = $email;
    }

    function setText($text)
    {
    	$this->text = $text;
    }

    function setCountry($country)
    {
    	$this->country= $country;
    }
}
?>