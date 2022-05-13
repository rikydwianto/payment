<h3>USER / PELANGGAN
<div style="float:right"> 
<a href="javascript:history.go(-1)" class="btn btn-success">KEMBALI</a>
<a href="<?=$url.$menu."pelanggan"?>" class="btn btn-primary">LIST USER</a>
<a href="<?=$url.$menu."pelanggan"?>&sub=tambah" class="btn btn-danger"><i class="ti ti-plus"></i> Tambah Pelanggan</a>
</div>


</h3>
<!-- <hr> -->

<?php 
if(isset($_GET['sub'])){
    $sub = $_GET['sub'];
    switch($sub){
        case"tambah":
             include"./php/view/pelanggan/tambah.php";
         break;
        case"edit":
             include"./php/view/pelanggan/edit.php";
        break;
        case"hapus":
             include"./php/view/pelanggan/hapus.php";
        break;
        case"langganan":
             include"./php/view/pelanggan/pilih_paket.php";
        break;
        default:
        include"./php/view/pelanggan/list.php";
            //  echo"isi default";
            }
            
            
        }
        else{
            include"./php/view/pelanggan/list.php";
    // echo"isi default";
    // include"./php/view/wifi/tagihan.php";
}
?>
