<h3>USER / PELANGGAN
<div style="float:right"> 
<a href="<?=$url.$menu."pelanggan"?>" class="btn btn-primary">Riwayat Pembayaran</a>
<a href="<?=$menu_al?>act=tambah" class="btn btn-danger">Tambah Tagihan</a>
</div>


</h3>
<!-- <hr> -->

<?php 
if(isset($_GET['sub'])){
    $sub = $_GET['sub'];
    switch($sub){
        case"bayar":
             include"./php/view/pelanggan/bayar.php";
         break;
        case"riwayat":
             include"./php/view/pembayaran/riwayat.php";
             break;
             default:
             echo"isi default";
            }
            
            
        }
        else{
            include"./php/view/pembayaran/riwayat.php";
    // echo"isi default";
    // include"./php/view/wifi/tagihan.php";
}
?>