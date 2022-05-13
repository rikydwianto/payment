<h1 class="display-1">Hapus ...</h1>
<?php 
$id = aman(de($_GET['id']));
$hapus = mysqli_query($con,"delete from tb_user where id_user='$id'");
if($hapus){
    swal("Berhasil Dihapus");
    pindah(menu('pelanggan','list'));
}
else{
$erro = htmlentities(mysqli_error($con));
swal("Gagal dihapus, Error : $erro",'GAGAL',"warning");

}
?>