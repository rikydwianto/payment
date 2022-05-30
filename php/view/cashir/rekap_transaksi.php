<div class="container" style="font-size:80% ;">
    <div class="row">
        <div class="col-md-12">
            <h1>Rekap Transaksi dan posting ke KAS</h1>
            <table class="table table-bordered">
                <thead>
                   <tr>
                        <th>NO</th>
                        <th>KODE ORDER</th>
                        <th>TANGGAL</th>
                        <th>QTY</th>
                        <th>TOTAL POKOK</th>
                        <th>TOTAL DISKON</th>
                        <th>TOTAL BAYAR</th>
                        <th>KEUNTUNGAN</th>
                        <th>KETERANGAN</th>
                   </tr>
                </thead>
                <tbody>
                    <?php 
                    $total_untung = 0;
                    $total_uang = 0;
                    $total_qty=0;
                    $total_diskon_semua=0;
                    $total_pokok_semua=0;
                    $trx =mysqli_query($con,"SELECT SUM(d.`qty`) as total_qty,t.* FROM transaksi	t JOIN detail_transaksi d ON d.`id_transaksi`=t.`id_transaksi`where t.id_usaha='$id_usaha' and t.status='berhasil' and t.posting_jurnal='belum' group by id_transaksi");
                    while($t =mysqli_fetch_array($trx)){
                        $cek = mysqli_query($con,"select * from detail_transaksi where id_transaksi='$t[id_transaksi]'  ");
                        $total_pokok = 0;
                        while($barang = mysqli_fetch_array($cek)){
                            $total_pokok += $barang['qty'] * $barang['harga_beli'];
                        }
                        
                        ?>
                        <tr>
                            <td><?=$no++?></td>
                            <td><?=$t['kode_transaksi']?></td>
                            <td><?=$t['tgl_transaksi']?></td>
                            <td><?=$t['total_qty']?></td>
                            <td><?=uang($total_pokok,'ya')?></td>
                            <td><?=uang($total_diskon =$t['diskon_total'],'ya')?></td>
                            <td><?=uang($total_bayar=$t['total_bayar'],'ya')?></td>
                            <td><?=uang($total_bayar-$total_pokok,'ya')?></td>
                            <td></td>
                        </tr>
                       

                        <?php
                        $total_uang += $total_bayar;
                        $total_untung += $total_bayar-$total_pokok;
                        $total_qty +=$t['total_qty'];
                        $total_pokok_semua += $total_pokok;
                        $total_diskon_semua += $total_diskon;
                    }
                    ?>
                    <?php 
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">TOTAL</th>
                        <th><?=$total_qty?></th>
                        <th><?=uang($total_pokok_semua,'ya')?></th>
                        <th><?=uang($total_diskon_semua,'ya')?></th>
                        <th><?=uang($total_uang,'ya')?></th>
                        <th><?=uang($total_untung,'ya')?></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
            
        </div>
    </div>
</div>