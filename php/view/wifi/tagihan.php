<h2>Tagihan Wi-fi belum dibayar</h2>
<hr>
<a href="<?=menu('wifi','tagihan','','')?>" class="btn btn-success">Tagihan belum dibayar</a>
<a href="<?=menu('wifi','tagihan','','filter=semua')?>" class="btn btn-info">Tampilkan semua tagihan</a>
<form method='ger' action="">

</form>
<table style='font-size:80%' class='table table-bordered' id='table'>
    <thead>
        <tr>
            <th>NO</th>
            <th>Nama</th>
            <th>Paket</th>
            <!-- <th>Tarif</th> -->
            <th>Tagihan</th>
            <th>Priode Tagihan</th>
            <th>Due</th>
            <th>Status Bayar</th>
            <th>Tgl Bayar</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
    <?php
$filter_qeury=" where  status='belumbayar'";
    if(isset($_GET['filter'])){
        $filter = $_GET['filter'];
        if($filter=='semua'){
            $filter_qeury='';
        }
    }
    $qtagihan = mysqli_query($con,"SELECT * from tagihan $filter_qeury");
    while($tagih = mysqli_fetch_array($qtagihan)){

        
        $priode = date("n");
        $tahun = date("Y");
        $tgl = date('j');
        $cek_tagihan = mysqli_query($con,"SELECT * FROM langganan l  JOIN tb_user u ON u.`id_user` = l.`id_user` 
         JOIN paket p ON p.`id_paket` = l.`id_paket`
          WHERE p.`kategori`='wifi' and u.status='aktif' and l.status='aktif'
          and l.id_user='$tagih[id_user]' and l.id_langganan='$tagih[id_langganan]'
           ");
        while($row = mysqli_fetch_array($cek_tagihan)){ 
        $jp = $row['tgl_tempo'];
        $due = ($tgl - $jp);
        $qcek_pembayaran = mysqli_query($con,"select * from pembayaran where status_pembayaran='lunas' and id_langganan='$row[id_langganan]' and bulan='$priode' and tahun='$tahun'");
    //EDIT DISINI UTUK PEMBAYRAN SETENGAH
        if(mysqli_num_rows($qcek_pembayaran)>0){
            $ket="sudah bayar";
            while($bayar = mysqli_fetch_array($qcek_pembayaran)){
                $ket = $bayar['status_pembayaran'];
                $tgl_bayar = $bayar['tgl_pembayaran'];
            }
            $due="";
        }else{
            $tgl_bayar="";
            $ket="belum bayar";
            if($tgl>$jp){
                
                $warna = 'RED';
            }
            else {
                $warna = '';
                
        
            }
        }
        $nama = $row['nama'];
        $tarif = $row['tarif'];
        $tempo = $row['tgl_tempo'];
        ?>
            <tr style='color:<?=$warna?>'>
                <td><?=$no++?></td>
                <td><?=$nama?></td>
                <td><?=$row['nama_paket']?></td>
                <!-- <td><?=uang($tarif,'ya')?></td> -->
                <td><?=uang($row['total_tagihan'],'ya')?></td>
                <td><?=($tempo)?> - <?=$bulan[$priode]?> - <?=$tahun?></td>
                <td><?=$due?></td>
                <td><?=$ket?></td>
                <td><?=$tgl_bayar?></td>
                <td>
                    <?php 
                    $text = "Hallo, Bapak/Ibu $nama \n Anda masih mempunyai tagihan Wifi Priode $bulan[$priode] - $tahun sebesar ".uang($tarif,'ya').", \n Jatuh tempo tanggal $tempo Segera lakukan pembayarannya, Terima Kasih";
                    $text = urlencode($text);
                    if(mysqli_num_rows($qcek_pembayaran)<1){
                        ?>
                    <a href="<?=menu('pembayaran','bayar',$row['id_langganan'],"kategori=wifi&priode=$priode&tahun=$tahun&id_tagih=$tagih[id_tagihan]")?>" class="btn btn-xs btn-success" title="BAYAR"><i class="ti-money"></i></a> | 
                    
                        <?php
                    }
                    else{
                        ?>
                        <a href="" class="btn btn-xs btn-primary" title="INVOICE"><i class="ti-notepad"></i></a> | 
                        <?php
                    }
                    ?>
                    <a href="https://wa.me/+62<?=(int)$row['no_hp']?>?text=<?=$text?>" title="KIRIM WHATSAPP" target="_blank" class="btn btn-xs btn-info"><i class="ti-sharethis"></i></a>
                    | <a href="javascript:konfirmasi('<?=menu('pembayaran','hapustagihan',$tagih['id_tagihan'])?>','Apakah yakin akan menghapus tagihan ini?')" title="HAPUS TAGIHAN"  class="btn btn-xs btn-danger"><i class="ti-close"></i></a>

                </td>
            </tr>
        <?php 
        }
    }
    ?>
    </tbody>
</table>
<script>
    function kirim(no){
        alert(no)
    }
</script>
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>
    
</script>