<h3>PEMBAYARAN
<div style="float:right"> 
<a href="<?=$url.$menu."pembayaran&sub=riwayat"?>" class="btn btn-primary">Riwayat Pembayaran</a>
<a href="<?=menu('pembayaran','tambahtagihan')?>" class="btn btn-danger">Tambah Tagihan</a>
</div>


</h3>
<!-- <hr> -->

<?php 
if(isset($_GET['sub'])){
    $sub = $_GET['sub'];
    switch($sub){
        case"bayar":
             include"./php/view/pembayaran/bayar.php";
         break;
        case"riwayat":
             include"./php/view/pembayaran/riwayat.php";
             break;
        case"tambahtagihan":
             include"./php/view/pembayaran/tambahtagihan.php";
             break;
        case"hapustagihan":
             include"./php/view/pembayaran/hapustagihan.php";
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
