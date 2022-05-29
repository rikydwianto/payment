<?php 
$cek_user = mysqli_query($con,"select count(*) as total from barang where id_usaha='$id_usaha' order by id_barang desc limit 0,1");
$cek_user = mysqli_fetch_array($cek_user);

if($cek_user['total']==0){
    
    $no_user = 1;

} 
else{
    // $cek_user = mysqli_fetch_array($cek_user);
    $no_user = (int)$cek_user['total'] + 1;
    // echo $cek_user['username'];
}
$val_user = "BRG-".sprintf("%03d",$id_usaha).'-'. sprintf("%04d",$no_user);
?>
<h1 class="display-1">TAMBAH BARANG</h1>
<div class="row">
    <div class="container">
        <div class="col-md-8">
        <form method="post">
            <table class='table table-boredered'>
                <tr>
                    <td>NAMA BARANG</td>
                    <td>
                        <input type="text" required class='form-control' name='nama'>
                    </td>
                </tr>
                <tr>
                    <td>KODE BARANG
                        <br><code>tidak bisa dirubah</code>
                    </td>
                    <td>
                        <input type="text"  value='<?=$val_user?>' class='form-control' name='kode'>
                    </td>
                </tr>
                <tr>
                    <td>KATEGORI <br>
                    <code></code></td>
                    <td>
                        <input type="text" class='form-control' name='kategori'>
                    </td>
                </tr>
                
                <tr>
                    <td>HARGA BELI
                        
                    </td>
                    <td>
                        <input type="number" value='0' class='form-control' name='harga_beli'>
                    </td>
                </tr>
                
                <tr>
                    <td>HARGA JUAL
                        
                    </td>
                    <td>
                        <input type="number" value='0' class='form-control' name='harga_jual'>
                    </td>
                </tr>
         
                <tr>
                    <td>SATUAN</td>
                    <td>
                        <?=satuan()?>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name='tambah_barang' value='TAMBAH'class='btn btn-danger btn-lg'>
                    </td>
                </tr>
            </table>
        </form>
        </div>
    </div>
</div>
<?php
if(isset($_POST['tambah_barang'])){
    $nama = aman($_POST['nama']);
    $kode_barang = aman($_POST['kode']);
    $kategori = (aman($_POST['kategori']));
    $harga_beli = aman($_POST['harga_beli']);
    $harga_jual = aman($_POST['harga_jual']);
    $satuan = aman($_POST['satuan']);
    // dd($_POST);
    // $status = aman($_POST['status']);
    $insert = "INSERT INTO `barang` ( `kode_barang`,`nama_barang`, `kategori`, `harga_beli`, `harga_jual`, `satuan`,id_usaha)
     VALUES ('$kode_barang', '$nama', '$kategori', '$harga_beli', '$harga_jual','$satuan','$id_usaha'); ";
    $query = mysqli_query($con,$insert);
    if($query){
        swal('Berhasil ditambahkan','INFORMASI');
        $id_user  = mysqli_insert_id($con);
        pindah($url.$menu.'barang&sub=tambah');
    }
    else{
        $erro = htmlentities(mysqli_error($con));
        swal("Gagal ditambahkan, Error : $erro",'GAGAL',"warning");
       
    }

}