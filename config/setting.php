<?php 
$setting['nama'] = "Payment Method";
$setting['title'] = "Payment Method";
$setting['versi'] = "1.0.0.0";
$url = "http://localhost/payment/";
$host = 'localhost';
$username = 'root';
$password = '';
$db_name = 'payment'; // nama databasenya
$server = $_SERVER['HTTP_HOST'];
$index =  $_SERVER['REQUEST_URI'];
$port = ":8080/";
//$url = "http://localhost:8080/laporan/";
$url_balik = "http://".$server."/".$index;
$url = "http://".$server."".$index;
$menu ="index.php?menu=";
 date_default_timezone_set("Asia/Bangkok");
// error_reporting(0);
 $no=1;
 if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];
$url = $uri.'/';
 $url = "http://localhost/payment/";
  $uname_api   = "089657507293";
  $apiKey   = "57161c1414e2ac3b";


$get = $_GET;
foreach($get as $w){
	$cari_qu = preg_match("/'/u",$w);
	if($cari_qu){
		session_start();
		echo "<h1 style='text-align:center;font-size:100px'>HALLO !! :) <br/>TETAP SEMANGATT YA :)<br>HAPPY HACKING!!!</h1>";
		exit;
	}

}


if(isset($_GET['menu'])){
    $menu = $_GET['menu'];
	$bread = $menu;
}
else{
   
	$bread = "home";
}
$menu = "?menu=";
?>