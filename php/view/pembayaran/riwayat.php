<h3>Riwayat Pembayaran</h3>
<table class='table table-bordered' id='table'>
    <thead>
        <tr>
            <th>NO</th>
            <th>NAMA CUST</th>
            <th>PAKET</th>
            <th>PRIODE</th>
            <th>TGL</th>
            <th>NOMINAL</th>
            <th>METODE</th>
            <th>STATUS</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    $qriwayat = mysqli_query($con,"
    SELECT * FROM pembayaran p JOIN tb_user u ON p.id_user = u.id_user JOIN paket pp ON p.id_paket = pp.id_paket JOIN langganan l ON l.`id_langganan` = p.`id_langganan`
    ");
    while($r = mysqli_fetch_array($qriwayat)){
        
    ?>
        <tr>
            <td><?=$no++?></td>
            <td><?=$r['nama']?></td>
            <td><?=$r['nama_paket']?></td>
            <td><?=$bulan[$r['bulan']].'-'.$r['tahun']?></td>
            <td><?=$r['tgl_pembayaran']?></td>
            <td><?=uang($r['nominal'],'ya')?></td>
            <td><?=$r['payment_method']?></td>
            <td><?=$r['status_pembayaran']?></td>
            <td>#</td>
        </tr>
    <?php }
    ?>
    </tbody>
</table>