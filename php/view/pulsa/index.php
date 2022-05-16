<?php
include"./php/proses/functionpulsa.php";
$pulsa = new Pulsa();
$pulsa->username($uname_api);
$pulsa->apikey($apiKey);


?>

<h3>PULSA / PPOB by MOBILE PULSA
<div style="float:right"> 
<!-- <a href="<?=$url.$menu?>wifi&sub=paket" class="btn btn-danger">Paket Wifi</a>
<a href="<?=menu('wifi','tambahpaket')?>" class="btn btn-info"><i class="ti ti-plus"></i> Paket</a> -->
<a href="<?=menu('pulsa','sinkron')?>" class="btn btn-info"><i class="ti ti-refresh"></i> Synchron Server</a>
<a href="<?=$url.$menu?>wifi&sub=tagihan" class="btn btn-success">Tagihan</a>
</div>


</h3>
<!-- <hr> -->

<?php 
if(isset($_GET['sub'])){
    $sub = $_GET['sub'];
    switch($sub){
        case"paket":
             include"./php/view/wifi/paket.php";
         break;
        case"tambahpaket":
             include"./php/view/wifi/tambahpaket.php";
         break;
        case"editpaket":
             include"./php/view/wifi/editpaket.php";
         break;
        case"sinkron":
             include"./php/view/pulsa/synchrone_pulsa.php";
         break;
        default:
             include"./php/view/pulsa/awalpulsa.php";
    }

    
}
else{
    include"./php/view/pulsa/awalpulsa.php";
}
?>
