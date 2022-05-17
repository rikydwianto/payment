<h1 class='display-1'>POSTING BUKU KAS</h1><hr>

<div class="col-12">
    <div class="col-md-8  ">
    <form method="post">
        <table class='table'>
            <tr>
                <td>AKUN NO.</td>
                <td>
                    <?=coa()?>
                </td>
            </tr>
            <tr>
                <td>KETERANGAN</td>
                <td>
                    <input type="text" name="keterangan" id="" class='form-control'>
                </td>
            </tr>
            <tr>
                <td>NOMINAL</td>
                <td>
                    <input type="number" name="nominal" id="" class='form-control'>
                </td>
            </tr>
            <tr>
                <td>TANGGAL TRANSAKSI</td>
                <td>
                    <input type="date" value='<?=date('Y-m-d')?>' name="tgl" id="" class='form-control'>
                </td>
            </tr>
            <tr>
                <td>STATUS</td>
                <td>
                    <?=debitkredit()?>
                </td>
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
                    <input type="submit" value="SIMPAN" name='tmb_kas' class='btn btn-danger'>
                </td>
            </tr>
        </table>
    </form>
    </div>
</div>

<?php
if(isset($_POST['tmb_kas'])){
    $akun = $_POST['coa'];
    $ket = $_POST['keterangan'];
    $nominal = $_POST['nominal'];
    $status = $_POST['pemasukan'];
    $tgl = $_POST['tgl'];
    $id_usaha = $_POST['id_usaha'];
    if($status=='debit'){
        $text =" INSERT INTO `kas` (`akun`, `keterangan`, `masuk`, `status`, `payment_method`, `tanggal_kas`,id_usaha) 
        VALUES ('$akun', '$ket', '$nominal', 'debit', 'KAS', '$tgl','$id_usaha'); ";
    }else{
        $text =" INSERT INTO `kas` (`akun`, `keterangan`, `keluar`, `status`, `payment_method`, `tanggal_kas`,id_usaha) 
        VALUES ('$akun', '$ket', '$nominal', 'kredit', 'KAS', '$tgl','$id_usaha'); ";
    }
    $query = mysqli_query($con,$text);
    if($query){
        swal('Berhasil ditambahkan','INFORMASI');
        pindah(menu('kas'));
    }
    else{
        $erro = htmlentities(mysqli_error($con));
        swal("Gagal ditambahkan, Error : $erro",'GAGAL',"warning");
       
    }

}