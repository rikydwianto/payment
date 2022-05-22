<?php 
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<h3>BUKU KAS
<div style="float:right"> 
<a href="javascript:history.go(-1)" class="btn btn-success">KEMBALI</a>
<a href="<?=menu('kas','list')?>" class="btn btn-info"><i class="ti ti-eye"></i> KAS</a>
<a href="<?=$actual_link.'&kelola'?>" class="btn btn-danger"><i class="ti ti-unlock"></i> KELOLA KAS</a>
<a href="<?=menu('kas','tambah')?>" class="btn btn-primary"><i class="ti ti-plus"></i> KAS</a>
</div>


</h3>
<!-- <hr> -->

<?php 
if(isset($_GET['sub'])){
    $sub = $_GET['sub'];
    switch($sub){
        case"tambah":
             include"./php/view/kas/tambah.php";
         break;
        case"hapus":
             include"./php/view/kas/hapus.php";
         break;
        default:
        include"./php/view/kas/daftarkas.php";
            //  echo"isi default";
            }
            
            
        }
else{
    include"./php/view/kas/daftarkas.php";
    
    // echo"isi default";
    // include"./php/view/wifi/tagihan.php";
}
?>
