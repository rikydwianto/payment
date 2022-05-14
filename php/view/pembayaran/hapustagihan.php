<h1 class="display-1">Menghapus Tagihan...</h1>
<?php 
$id = aman(de($_GET['id']));
$hapus = mysqli_query($con,"delete from tagihan where id_tagihan='$id'");
if($hapus){
    swal("Berhasil Dihapus");
    pindah(menu('wifi','tagihan'));
}
else{
$erro = htmlentities(mysqli_error($con));
swal("Gagal dihapus, Error : $erro",'GAGAL',"warning");

}
?>