<?php 
$id = aman(de($_GET['id']));
$user = mysqli_query($con,"select * from barang where id_barang='$id'");
$r = mysqli_fetch_array($user);
?>
<h1 class='display-1'>TAMBAH STOK BARANG <?=$r['nama_barang']?></h1>
<?php

     if(isset($_POST['tmb_stok'])){
        //  $id = $_POST['paket'];
        $stok_baru = $_POST['stok_baru'];
        $stok = $_POST['stok'];
        $tgl = $_POST['tgl'];
        $barang = $_POST['barang'];
        $text = "update barang set stok='$stok' where id_barang='$id' and id_usaha='$id_usaha'";
         $insert = mysqli_query($con,$text);
         echo mysqli_error($con);
         if($insert){
             mysqli_query($con,"INSERT into riwayat_barang(id_barang,tgl,masuk,id_usaha) VALUES('$id','$tgl','$stok_baru','$id_usaha')");
             swal("STOK Berhasil Ditambahkan! :) ","INFORMASI");
             mysqli_query($con,"INSERT into `jurnal`(akun,keterangan,keluar,status,payment_method,tanggal_kas,id_usaha,refrensi,urutan)
             values('101','KAS','$barang','kredit','KAS','$tgl','$id_usaha','pembelian-stok','2');
             ");
            mysqli_query($con,"INSERT into `jurnal`(akun,keterangan,masuk,status,payment_method,tanggal_kas,id_usaha,refrensi,urutan)
            values('102','persediaan stok barang ','$barang','debit','KAS','$tgl','$id_usaha','pembelian-stok','1');
            ");
             pindah(menu('barang','list'));
         }
         else{
             swal("Gagal ditambahkan",'GAGAL','warning');
         }
     }
     if(isset($_POST['tmb_stok_kas'])){
        //  $id = $_POST['paket'];
        $stok_baru = $_POST['stok_baru'];
        $stok = $_POST['stok'];
        $tgl = $_POST['tgl'];
        $barang = $_POST['barang'];
        $text = "update barang set stok='$stok' where id_barang='$id' and id_usaha='$id_usaha'";
         $insert = mysqli_query($con,$text);
         echo mysqli_error($con);
         if($insert){
             mysqli_query($con,"INSERT into riwayat_barang(id_barang,tgl,masuk,id_usaha) VALUES('$id','$tgl','$stok_baru','$id_usaha')");
             swal("STOK Berhasil Ditambahkan! :) ","INFORMASI");

             mysqli_query($con,"INSERT into `kas`(akun,keterangan,keluar,status,payment_method,tanggal_kas,id_usaha)
             values('101','KAS','$barang','kredit','KAS','$tgl','$id_usaha');
             ");
             mysqli_query($con,"INSERT into `jurnal`(akun,keterangan,keluar,status,payment_method,tanggal_kas,id_usaha,refrensi,urutan)
             values('101','KAS','$barang','kredit','KAS','$tgl','$id_usaha','pembelian-stok','2');
             ");
            mysqli_query($con,"INSERT into `jurnal`(akun,keterangan,masuk,status,payment_method,tanggal_kas,id_usaha,refrensi,urutan)
            values('102','persediaan stok barang ','$barang','debit','KAS','$tgl','$id_usaha','pembelian-stok','1');
            ");
             pindah(menu('barang','list'));
         }
         else{
             swal("Gagal ditambahkan",'GAGAL','warning');
         }
     }
     
     ?>
     <form action="" method="post">
         <div class='justify-content-md-center'>

             <div class="col-md-12">
                 <table class="table">
               
                <tr>
                    <td>TANGGAL</td>
                    <td>
                    <input type='date' class='form-control' type="submit" name='tgl' value="<?=date('Y-m-d')?>">
                    </td>
                </tr>
                <tr>
                    <td>STOK MASUK</td>
                    <td>
                    <input type='number' class='form-control' type="submit" id='stok_baru' name='stok_baru' value="">
                    </td>
                </tr>
                <tr>
                    <td>TOTAL STOK</td>
                    <td>
                        <input type='hidden' readonly class='form-control' type="submit" id='harga_barang' name='barang' value="<?=$r['harga_beli']?>">
                    <input type='hidden' readonly class='form-control' type="submit" id='stok_lama' name='stok' value="<?=$r['stok']?>">
                    <input type='number' class='form-control' type="submit" id='stok' name='stok' value="<?=$r['stok']?>">
                </td>
            </tr>
            <tr>
                <td>TOTAL BARANG</td>
                <td>
                        <input type='number' readonly class='form-control' type="submit" id='total_barang' name='barang' >
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                    <input class='btn btn-info btn-lg' type="submit" name='tmb_stok' value="TAMBAH">
                    <input class='btn btn-danger btn-lg' type="submit" name='tmb_stok_kas' value="TAMBAH TAMBAH DENGAN KAS">
                    </td>
                </tr>
                
            </table>
        </div>    
    </div>
    
     </form>
     <div class="">
         <div class="">
         <h1 class='display-1'>RIWAYAT STOK <?=$r['nama_barang']?></h1>

                <table id='table'>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>TGL</th>
                            <th>MASUK</th>
                            <th>KELUAR</th>
                            <th>ID PEMBELIAN</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $user = mysqli_query($con,"select * from barang where id_barang='$id'");
                    $r = mysqli_fetch_array($user);
                    $qriwayat = mysqli_query($con,"select * from riwayat_barang where id_usaha='$id_usaha' and id_barang='$id'");
                    while($riwayat=mysqli_fetch_array($qriwayat)){
                        ?>
                        <tr>
                        <th><?=$no++?></th>
                        <th><?=$riwayat['tgl']?></th>
                        <th><?=$riwayat['masuk']?></th>
                        <th><?=$riwayat['keluar']?></th>
                        <th><?=$riwayat['id_pembelian']?></th>
                    </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
         </div>
     </div>
     <?php
 
?>

<script>
    $(document).ready(function(){
        $("#stok_baru").on("input",function(){
            let stok_baru = parseInt($(this).val())
            let stok_lama =parseInt( $("#stok_lama").val());
            let harga_beli =parseInt( $("#harga_barang").val());
            $("#stok").val(stok_baru + stok_lama)
            $("#total_barang").val(stok_baru*harga_beli)
        })
    })
</script>