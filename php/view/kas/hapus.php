<h1 class="display-1">Hapus ...</h1>
<?php 
$id = aman(de($_GET['id']));
$tangkap = urldecode($_GET['url']);
$hapus = mysqli_query($con,"delete from kas where id_kas='$id'");
if($hapus){
    swal("Berhasil Dihapus");
    pindah($tangkap);
}
else{
$erro = htmlentities(mysqli_error($con));
swal("Gagal dihapus, Error : $erro",'GAGAL',"warning");

}
?>