<div class="container">
        <div class="row">
        <div class="col-md-7">
            <input type="text" readonly name="kode_bayar" value='<?=$val_user?>'id='kode_bayar' class='form-control'>
            <a href="<?=$actual_link.'&kode_bayar='.$val_user?>" class="btn btn-danger">Buat Pembayaran</a>
            <hr>
            <br>
            <?php 
            $cek_kode= mysqli_query($con,"select * from transaksi where id_usaha='$id_usaha' and status='pending'");
            echo mysqli_error($con);
            while($kode= mysqli_fetch_array($cek_kode)){
                ?>
                <a href="<?=$actual_link."&kode_bayar=".$kode['kode_transaksi']?>" class="">Gunakan kode lama <?=$kode['kode_transaksi']?></a><br>
                <?php
            }
            ?>
        </div>
        </div>
   </div>