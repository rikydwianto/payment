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
    $kode = $akun[0];
    
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
    // $text="select curdate()";
    $query = mysqli_query($con,$text);
    $id_kas = mysqli_insert_id($con);
    // echo $id_kas;
    $cari_coa = cari_coa($akun);
    if($query){
        if($kode == 1 || $kode == 5){
            if($status=='debit'){
                echo"harus bertambah";
                mysqli_query($con,"INSERT into `jurnal`(akun,keterangan,masuk,status,payment_method,tanggal_kas,id_usaha,refrensi,urutan)
                values('$akun','$cari_coa','$nominal','debit','KAS','$tgl','$id_usaha','kas-$id_usaha-$id_kas','2');
                ");
                mysqli_query($con,"INSERT into `jurnal`(akun,keterangan,keluar,status,payment_method,tanggal_kas,id_usaha,refrensi,urutan)
                values('101','KAS','$nominal','kredit','KAS','$tgl','$id_usaha','kas-$id_usaha-$id_kas','1');
                ");

            }
            else{
                echo"harus berkurang";
                mysqli_query($con,"INSERT into `jurnal`(akun,keterangan,keluar,status,payment_method,tanggal_kas,id_usaha,refrensi,urutan)
                values('101','KAS','$nominal','kredit','KAS','$tgl','$id_usaha','kas-$id_usaha-$id_kas','2');
                ");
                mysqli_query($con,"INSERT into `jurnal`(akun,keterangan,masuk,status,payment_method,tanggal_kas,id_usaha,refrensi,urutan)
                values('$akun','$cari_coa','$nominal','debit','KAS','$tgl','$id_usaha','kas-$id_usaha-$id_kas','1');
                ");

            }
        }


        if($kode == 2 || $kode == 3 || $kode == 4){
            if($status=='debit'){
                echo"harus berkurang";
                mysqli_query($con,"INSERT into `jurnal`(akun,keterangan,keluar,status,payment_method,tanggal_kas,id_usaha,refrensi,urutan)
                values('$akun','$cari_coa','$nominal','kredit','KAS','$tgl','$id_usaha','kas-$id_usaha-$id_kas','2');
                ");
                mysqli_query($con,"INSERT into `jurnal`(akun,keterangan,masuk,status,payment_method,tanggal_kas,id_usaha,refrensi,urutan)
                values('101','KAS','$nominal','debit','KAS','$tgl','$id_usaha','kas-$id_usaha-$id_kas','1');
                ");

            }
            else{
                echo"harus bertambah   ";
                mysqli_query($con,"INSERT into `jurnal`(akun,keterangan,keluar,status,payment_method,tanggal_kas,id_usaha,refrensi,urutan)
                values('101','KAS','$nominal','kredit','KAS','$tgl','$id_usaha','kas-$id_usaha-$id_kas','2');
                ");
                mysqli_query($con,"INSERT into `jurnal`(akun,keterangan,masuk,status,payment_method,tanggal_kas,id_usaha,refrensi,urutan)
                values('$akun','$cari_coa','$nominal','debit','KAS','$tgl','$id_usaha','kas-$id_usaha-$id_kas','1');
                ");

            }
        }


        swal('Berhasil ditambahkan','INFORMASI');
        pindah(menu('kas'));
    }
    else{
        $erro = htmlentities(mysqli_error($con));
        swal("Gagal ditambahkan, Error : $erro",'GAGAL',"warning");
       
    }

}