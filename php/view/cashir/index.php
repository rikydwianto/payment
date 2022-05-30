<?php 
$cek_user = mysqli_query($con,"select count(*) as total from transaksi where id_usaha='$id_usaha' order by id_transaksi desc limit 0,1");
$cek_user = mysqli_fetch_array($cek_user);

if($cek_user['total']==0){
    
    $no_user = 1;

} 
else{
    // $cek_user = mysqli_fetch_array($cek_user);
    $no_user = (int)$cek_user['total'] + 1;
    // echo $cek_user['username'];
}
$val_user = "ORD-".sprintf("%03d",$id_usaha).'-'. sprintf("%04d",$no_user).'-'.date("Ymdhi");

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<h3>KASIR
<div style="float:right"> 
<a href="javascript:history.go(-1)" class="btn btn-success">KEMBALI</a>
<a href="<?=menu('cashir','rekap')?>" class="btn btn-info"><i class="ti ti-eye"></i> REKAP TRANSAKSI</a>
<!-- <a href="<?=$actual_link.'&kelola'?>" class="btn btn-danger"><i class="ti ti-unlock"></i> KELOLA KAS</a> -->
<!-- <a href="<?=menu('kas','tambah')?>" class="btn btn-primary"><i class="ti ti-plus"></i> KAS</a> -->
</div>
<?php
if(isset($_GET['kode_bayar'])){
    include"./php/view/cashir/transaksi.php";
}
else{
    if(isset($_GET['sub'])){
        $sub = $_GET['sub'];
        switch($sub){
            case"rekap":
                 include"./php/view/cashir/rekap_transaksi.php";
             break;
            default:
            include"./php/view/cashir/order_pending.php";
                //  echo"isi default";
                }
                
                
            }
            else{
                include"./php/view/cashir/order_pending.php";
        // echo"isi default";
        // include"./php/view/wifi/tagihan.php";
    }
    ?>
   
    <?php
}
