<h1 class='display-1'>TAMBAH PAKET</h1>
<hr>

<form method="post">
    <div class="col-md-6">
    <table class='table'>
        <tr>
            <td>NAMA PAKET</td>
            <td><input type="text" name="nama_paket" id="" class='form-control'></td>
        </tr>
        <tr>
            <td>KETERANGAN</td>
            <td><textarea type="text" name="keterangan" id="" class='form-control'></textarea></td>
        </tr>
        <tr>
            <td>TARIF</td>
            <td><input type="number" name="tarif" id="" class='form-control'></td>
        </tr>
        <tr>
            <td>KATEGORI</td>
            <td><input type="text" name="kategori" value="wifi" id="" class='form-control'></td>
        </tr>
        <tr>
            <td>UNIT</td>
            <td>
                <?=select_usaha($con,$id_usaha)?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type="submit" name="tmb_paket" id="" class='btn btn-success'>
                <input type="reset"  id="" class='btn btn-danger'>
            </td>
        </tr>
    </table>
    </div>
</form>
<?php 
if(isset($_POST['tmb_paket'])){
    $nama = $_POST['nama_paket'];
    $keterangan = $_POST['keterangan'];
    $tarif = $_POST['tarif'];
    $id_usaha = $_POST['id_usaha'];
    $kategori = $_POST['kategori'];
    $q = "INSERT into paket(nama_paket,tarif,keterangan,kategori,id_usaha) 
    values('$nama','$tarif','$keterangan','$kategori','$id_usaha')";
    if(mysqli_query($con,$q)){
        swal("BERHASIL DITAMBAHKAN");
    }
    else swal("Gagal Ditambahkan.",'','warning');
}
?>