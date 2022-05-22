<h3>KREDIT
<div style="float:right"> 
<a href="javascript:history.go(-1)" class="btn btn-success">KEMBALI</a>
<a href="<?=$url.$menu."kredit"?>" class="btn btn-primary"><i class="ti ti-eye"></i> LIST KREDIT</a>
<a href="<?=$url.$menu."kredit"?>&sub=tambah" class="btn btn-danger"><i class="ti ti-plus"></i> Tambah Kredit</a>
</div>


</h3>
<!-- <hr> -->

<?php 
if(isset($_GET['sub'])){
    $sub = $_GET['sub'];
    switch($sub){
        case"tambah":
             include"./php/view/kredit/tambah.php";
         break;
        case"edit":
             include"./php/view/kredit/edit.php";
        break;
        case"hapus":
             include"./php/view/kredit/hapus.php";
        break;
        case"setujui":
             include"./php/view/kredit/setuju.php";
        break;
        case"langganan":
             include"./php/view/kredit/pilih_paket.php";
        break;
        default:
        include"./php/view/kredit/list.php";
            //  echo"isi default";
            }
            
            
        }
        else{
            include"./php/view/kredit/list.php";
    // echo"isi default";
    // include"./php/view/wifi/tagihan.php";
}
?>
