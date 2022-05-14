<h1 class="display-1">Hapus ...</h1>
<?php 
$id = aman(de($_GET['id']));
$hapus = mysqli_query($con,"delete from kas where id_kas='$id'");
if($hapus){
    swal("Berhasil Dihapus");
    pindah(menu('kas',''));
}
else{
$erro = htmlentities(mysqli_error($con));
swal("Gagal dihapus, Error : $erro",'GAGAL',"warning");

}
?>