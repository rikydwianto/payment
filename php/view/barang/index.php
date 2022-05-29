<h3>STOK BARANG
<div style="float:right"> 
<a href="javascript:history.go(-1)" class="btn btn-success">KEMBALI</a>
<a href="<?=$url.$menu."barang"?>" class="btn btn-primary">STOK</a>
<a href="<?=$url.$menu."barang"?>&sub=tambah" class="btn btn-danger"><i class="ti ti-plus"></i> Tambah barang</a>
</div>


</h3>
<!-- <hr> -->

<?php 
if(isset($_GET['sub'])){
    $sub = $_GET['sub'];
    switch($sub){
        case"tambah":
             include"./php/view/barang/tambah.php";
         break;
        case"edit":
             include"./php/view/barang/edit.php";
        break;
        case"hapus":
             include"./php/view/barang/hapus.php";
        break;
        case"stok":
             include"./php/view/barang/stok.php";
        break;
        default:
        include"./php/view/barang/list.php";
            //  echo"isi default";
            }
            
            
        }
        else{
            include"./php/view/barang/list.php";
    // echo"isi default";
    // include"./php/view/wifi/tagihan.php";
}
?>
