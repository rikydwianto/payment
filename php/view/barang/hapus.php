<h1 class="display-1">Hapus ...</h1>
<?php 
$id = aman(de($_GET['id']));
$hapus = mysqli_query($con,"update barang set deleted=CURRENT_TIMESTAMP where id_barang='$id'");
if($hapus){
    swal("Berhasil Dihapus");
    pindah(menu('barang','list'));
}
else{
$erro = htmlentities(mysqli_error($con));
swal("Gagal dihapus, Error : $erro",'GAGAL',"warning");

}
?>