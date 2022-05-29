<h1 class='display-1'>Pembayaran</h1>
<form method="post">
    <code>KOSONGKAN MARGIN DAN POKOK JIKA TIDAK BAYAR</code>
    <table class="table">
        <thead>
            <tr>
                <th>NO</th>
                <th>KODE</th>
                <th>NAMA</th>
                <th>POKOK</th>
                <th>MARGIN</th>
            </tr>
    </thead>
    <tbody>
    <?php 
    // $qlist= mysqli_query($con,"");
    $qcek = mysqli_query($con,"SELECT p.*, u.nama from pembiayaan p join tb_user u on u.id_user=p.id_user join paket pk on pk.id_paket=p.id_paket 
    where p.id_usaha='$id_usaha' and u.status='aktif' and p.status='disetujui'");
    while($tag = mysqli_fetch_array($qcek)){
        ?>
        <tr>
            <input type="hidden" name="id_pemb[]" value='<?=$tag['id_pembiayaan']?>' id="">
            <input type="hidden" name="kode_pemb[]" value='<?=$tag['kode_pembiayaan']?>' id="">
            <input type="hidden" name="is_user[]" value='<?=$tag['id_user']?>' id="">
            <td><?=$no++?></td>
            <td><?=$tag['kode_pembiayaan']?></td>
            <td><?=$tag['nama']?></td>
            <td>
                <input type="number" name="pokok[]" class='form-control' value="<?=$tag['pokok']?>" id="">
            </td>
            <td>
                
                <input type="number" name="margin[]" class='form-control' value="<?=$tag['margin']?>" id="">
            </td>
        </tr>
        <?php
    }
    ?>

    </tbody>
    <tfoot>
        <tr>
            <td colspan="4"></td>
            <td>
                <input type="submit" value="BAYAR" name='bayar' class='btn btn-success'>
            </td>
        </tr>
    </tfoot>
    <?php 
    ?>
    </table>
    <?php 
    
    if(isset($_POST['bayar'])){
        $total_pokok = 0;
        $total_margin = 0;
        $hitung = count($_POST['id_pemb']);
        for($i=0;$i<$hitung;$i++){
            $id_pemb = $_POST['id_pemb'][$i];
            $kode = $_POST['kode_pemb'][$i];
            $margin = $_POST['margin'][$i];
            $pokok = $_POST['pokok'][$i];
            $tgl=date("Y-m-d");
            if($pokok==0 && $margin==0){
               
            }
            else{
                //MASUKAN PROSES PEMBAYARAN PER NASABAH
                $total_pokok += $pokok;
                $total_margin += $margin;
            }
            
            // echo $kode;
        }
        $total_semua = $total_margin + $total_pokok;
        mysqli_query($con,"INSERT into `kas`(akun,keterangan,masuk,status,payment_method,tanggal_kas,id_usaha)
        values('101','KAS - Penerimaan ','$total_semua','debit','KAS','$tgl','$id_usaha');
        ");
        $id_kas= mysqli_insert_id($con);
        mysqli_query($con,"INSERT into `jurnal`(akun,keterangan,masuk,status,payment_method,tanggal_kas,id_usaha,refrensi,urutan)
                values('101','KAS','$total_pokok','debit','KAS','$tgl','$id_usaha','kas-$id_usaha-$id_kas','1');
                ");
        mysqli_query($con,"INSERT into `jurnal`(akun,keterangan,keluar,status,payment_method,tanggal_kas,id_usaha,refrensi,urutan)
        values('1031','Penerimaan pokok','$total_pokok','kredit','KAS','$tgl','$id_usaha','kas-$id_usaha-$id_kas','2');
        ");
        mysqli_query($con,"INSERT into `jurnal`(akun,keterangan,masuk,status,payment_method,tanggal_kas,id_usaha,refrensi,urutan)
                values('101','KAS','$total_margin','debit','KAS','$tgl','$id_usaha','kas-$id_usaha-$id_kas','1');
                ");
        mysqli_query($con,"INSERT into `jurnal`(akun,keterangan,keluar,status,payment_method,tanggal_kas,id_usaha,refrensi,urutan)
        values('410','Penerimaan Margin','$total_margin','kredit','KAS','$tgl','$id_usaha','kas-$id_usaha-$id_kas','3');
        ");
        swal("BERHASIL",'INFORMASI','success');
        pindah(menu('home'));
    }
    ?>
</form>