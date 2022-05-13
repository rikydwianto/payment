<?php
$id_langganan =aman($_GET['id']);
$priode =aman($_GET['priode']);
$tahun =aman($_GET['tahun']);
$cek_tagihan = mysqli_query($con,"SELECT * FROM langganan l  JOIN tb_user u ON u.`id_user` = l.`id_user`  JOIN paket p ON p.`id_paket` = l.`id_paket` WHERE l.id_langganan='$id_langganan'");
$pel= (mysqli_fetch_array($cek_tagihan));
$nama_pel = $pel['nama'];
$nama_paket = strtoupper("( $pel[kategori])-". $pel['nama_paket']);
$harga_paket = $pel['tarif'];
$selisih = $pel['tgl_tempo'] - date("j");
if($selisih>0)
{
    $ket = "Sudah lewat $selisih hari";
}
else{
    $ket = "belum lewat jatuh tempo ";
}
?>
<div class="row">
    <div class="col-md-10">
    <form id='form_bayar' method="post">
        
        <div class="col-md-6">
            <table class='table'>
            <tr>
                <td>NAMA PELANGGAN</td>
                <td><input type="text" readonly value='<?=$nama_pel?>' class='form-control'></td>
            </tr>
            <tr>
                <td>NAMA PAKET</td>
                <td><input type="text" readonly value='<?=$nama_paket?>' class='form-control'></td>
            </tr>
            <tr>
                <td>HARGA PAKET</td>
                <td><input type="text" readonly value='<?=uang($harga_paket,'ya')?>' class='form-control'></td>
            </tr>
            <tr>
                <td>PRIODE</td>
                <td><input type="text" readonly value='<?=$bulan[$priode]?> - <?=$tahun?>' class='form-control'></td>
            </tr>
            <tr>
                <td>JATUH TEMPO</td>
                <td><input type="text" readonly value='<?=$pel['tgl_tempo']?>-<?=$bulan[$priode]?> - <?=$tahun?>' class='form-control'></td>
            </tr>
        </table>
        </div>
        
        <div class="col-md-6">
            <table class='table'>
            <tr>
                <td>TOTAL TAGIHAN</td>
                <td><input type="number" name='bayar' min='<?=($harga_paket)?>' value='<?=$pel['total_tagihan']?>' class='form-control'></td>
            </tr>
            <tr>
                <td>TANGGAL</td>
                <td><input type="date" name='tgl' value='<?=date("Y-m-d")?>' class='form-control'></td>
            </tr>
                <tr>
                    <td>KETERANGAN</td>
                    <td><input type="text" readonly value='<?=$ket?>' class='form-control'></td>
                </tr>
            <tr>
                <td>METODE PEMBAYARAN</td>
                <td>
                   <?=select_metode($con)?>
                </td>
            </tr>
            
            <tr>
                <td>BAYAR</td>
                <td>
                   <input type="submit" name='tmb_bayar' value='BAYAR' class='btn btn-lg btn-danger'>
                   <a href="javascript:history.go(-1)" class="btn btn-info btn-lg"> <i class="ti ti-arrow-left"></i> KEMBALI</a>
                </td>
            </tr>

        </table>
        </div>
        
    </div>    
</form>
</div>
<?php
if(isset($_POST['tmb_bayar'])){
    $tagihan = $_POST['bayar'];
    $tgl = $_POST['tgl'];
    $metode = $_POST['metode'];
    $qbayar = "INSERT INTO `pembayaran` (`id_user`, `id_paket`, `id_langganan`, `nominal`, `status_pembayaran`, `pembayaran`, `payment_method`, `bulan`, `tahun`, `tgl_pembayaran`) 
            VALUES ('$pel[id_user]', '$pel[id_paket]', '$pel[id_langganan]', '$tagihan', 'full', 'wifi', '$metode', '$priode', '$tahun', '2022-05-12');     ";
    $q = mysqli_query($con,$qbayar);
    if($q)
    {
        mysqli_query($con,"INSERT into `kas`(akun,keterangan,nominal,status,payment_method,tanggal_kas)
                        values('401','penerimaan pembayaran wifi an $nama_pel','$tagihan','sukses','$metode','$tgl');
        ");
        swal("Berhasil dibayar, Terimakasih","success","Berhasil");
        pindah("$url.$menu"."pembayaran");
    }
    else{
        swal("Gagal dibayarkan. Error ". mysqli_error($con),"warning","GAGAL");
        
    }
}
?>