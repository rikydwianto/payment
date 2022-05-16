
<h1 class='dispkay-1'>ARUS KAS</h1>
<?php 
$date  = date("Y-m-d");
$date_banding  = date("Y-m-d");
$date_sebelum = date('Y-m-d', strtotime('-1 days', strtotime($date)));
$cek_saldo = mysqli_query($con,"SELECT SUM(masuk)-SUM(keluar) AS saldo_kemarin FROM kas WHERE tanggal_kas<'$date'");
$cek_saldo = $saldo_awal = mysqli_fetch_array($cek_saldo)['saldo_kemarin'];
?>
<table class="table table-bordered" id="table!">
    <thead>
        <tr>
            <th>NO</th>
            <th>AKUN</th>
            <th>URAIAN</th>
            <th>DEBIT</th>
            <th>KREDIT</th>
            <th>SALDO</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="3">SALDO AWAL</td>

            <td><?=uang($cek_saldo,'ya')?></td>
            <td><?=uang(0,'ya')?></td>
            <td><?=uang($cek_saldo,'ya')?></td>
        </tr>
        <?php
        $total_masuk = 0;
        $total_keluar = 0;
        $cek_kas = mysqli_query($con,"SELECT * from kas where tanggal_kas>='$date' and tanggal_kas<='$date_banding'"); 
        while($kas = mysqli_fetch_array($cek_kas)){
            $kat = $kas['status'];
            $masuk =$kas['masuk'];
            $keluar = $kas['keluar'];
            $total_masuk += $masuk;
            $total_keluar += $keluar;
            if($kat=='debit'){
                $cek_saldo = $cek_saldo + $masuk;
            }
            else {
                $cek_saldo = $cek_saldo - $kas['keluar'];
                
            }
            ?>
             <tr>
                <td><?=$no++?></td>
                <td><?=$kas['akun']?></td>
                <td><?=$kas['keterangan']?></td>
                <td><?=uang($masuk,'ya')?></td>
                <td><?=uang($keluar,'ya')?></td>
                <td><?=uang($cek_saldo,'ya')?></td>
                <td>
                    <?php 
                    if(isset($_GET['kelola'])){
                        ?>
                    <a href="javascript:void()" onclick="konfirmasi('<?=menu('kas','hapus',$kas['id_kas'])?>','Apakah yakin akan menghapus KAS ini? setelah dihapus tidak dapat dikembalikan')" class="btn btn-danger"><i class="ti ti-close"></i></a>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <?php 
        }
        ?>
            <tr>
                <th><?=$no++?></th>
                <th colspan="2">TOTAL</th>
                <th><?=uang($total_semua = $total_masuk+$saldo_awal,'ya')?></th>
                <th><?=uang($total_keluar,'ya')?></th>
                <th><?=uang($total_semua-$total_keluar,'ya')?></th>
            </tr>
    </tbody>
</table>

