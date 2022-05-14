<h3>WIFI
<div style="float:right"> 
<a href="<?=$url.$menu?>wifi&sub=paket" class="btn btn-danger">Paket Wifi</a>
<a href="<?=menu('wifi','tambahpaket')?>" class="btn btn-info"><i class="ti ti-plus"></i> Paket</a>
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
        default:
             include"./php/view/wifi/tagihan.php";
    }

    
}
else{
    include"./php/view/wifi/tagihan.php";
}
?>
