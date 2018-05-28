<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	function _licencja($nazwa,$klucz)
	{
	
	$CI =& get_instance();
	$c = curl_init();
	curl_setopt($c, CURLOPT_URL, 'http://app.maczek.info/lic.php');
	curl_setopt($c, CURLOPT_POST, 1);
	curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($c, CURLOPT_POSTFIELDS, 'klucz='.$klucz.'&domena='.$_SERVER["SERVER_NAME"].'&ip='.$_SERVER["SERVER_ADDR"].'&nazwa='.$nazwa);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
	curl_getinfo($c);
	$result = curl_exec($c);
	curl_close($c);
	if(substr($result,0,5) == "error")
		die("Nielegalna kopia oprogramowania!<br/>Skontaktuj się ze sprzedawcą.");
	}
?>