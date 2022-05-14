<h1 class='display-1'>EDIT Paket</h1>
<hr>
<?php 
$id=aman(de($_GET['id']));
if(isset($_POST['edit_paket'])){
    $nama = $_POST['nama_paket'];
    $keterangan = $_POST['keterangan'];
    $tarif = $_POST['tarif'];
    $kategori = $_POST['kategori'];
    $q = "UPDATE `payment`.`paket` SET `tarif` = '$tarif', kategori='$kategori', nama_paket='$nama',keterangan='$keterangan' WHERE `id_paket` = '$id';     ";
    if(mysqli_query($con,$q)){
        swal("BERHASIL DISIMPAN");
        pindah(menu('wifi','paket'));
    }
    else swal("Gagal Ditambahkan.",'','warning');
}
?>
<?php 


 $cek_paket = mysqli_query($con,"select * from paket where id_paket='$id' ");
 $row = mysqli_fetch_array($cek_paket);
?>
<form method="post">
    <div class="col-md-6">
    <table class='table'>
        <tr>
            <td>NAMA PAKET</td>
            <td><input type="text" value="<?=$row['nama_paket']?>" name="nama_paket" id="" class='form-control'></td>
        </tr>
        <tr>
            <td>KETERANGAN</td>
            <td><textarea type="text" name="keterangan" id="" class='form-control'><?=$row['keterangan']?></textarea></td>
        </tr>
        <tr>
            <td>TARIF</td>
            <td><input type="number" name="tarif" id="" class='form-control'  value="<?=$row['tarif']?>"></td>
        </tr>
        <tr>
            <td>KATEGORI</td>
            <td><input type="text" name="kategori" value="wifi" id="" class='form-control'  value="<?=$row['kategori']?>"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type="submit" name="edit_paket" id="" class='btn btn-success'>
                <input type="reset"  id="" class='btn btn-danger'>
            </td>
        </tr>
    </table>
    </div>
</form>
