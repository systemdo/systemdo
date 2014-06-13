<?php 

Class Geoip{

private $geo ;

function getcsv()
{
	//echo __FILE__;	
	$this->geo = file(APPPATH.'libraries/Geoip/GeoIPCountryWhois.csv');
	print_r($this->geo);
}


function countryByip()
{
	foreach ($this->geo as $key => $value) {
		
	}
}

function getUserLanguage() {  
    $idioma =substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2); 
    
    return $idioma;  
} 

function getCountry()
{
	$user_ip = $_SERVER['REMOTE_ADDR'];
	$ch = curl_init("http://api.hostip.info/country.php?ip=$user_ip");
	//var_dump($ch);	
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$country_code = curl_exec($ch);

	return $country_code;
}
}
?>