<h3>WIFI
<div style="float:right"> 
<a href="<?=$url.$menu?>wifi&sub=paket" class="btn btn-danger">Paket Wifi</a>
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
        default:
             include"./php/view/wifi/tagihan.php";
    }

    
}
else{
    include"./php/view/wifi/tagihan.php";
}
?>
