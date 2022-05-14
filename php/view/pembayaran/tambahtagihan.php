<h1 class='display-1'>Tambah Tagihan</h1>
<hr>
<form id='kirim' method="post">

<table style='font-size:80%' class='table table-bordered' id='table!'>
    <thead>
        <tr>
            <th>NO</th>
            <th>Nama</th>
            <th>Paket</th>
            <th>Tarif</th>
            <th>Tagihan</th>
            <th>Priode Tagihan</th>
            <th>Due</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
    <?php    
    $priode = date("n");
    $tahun = date("Y");
    $tgl = date('j');
    $total=0;
    $total_tarif=0;
    $cek_tagihan = mysqli_query($con,"SELECT * FROM langganan l  JOIN tb_user u ON u.`id_user` = l.`id_user`  JOIN paket p ON p.`id_paket` = l.`id_paket` WHERE p.`kategori`='wifi' and u.status='aktif' and l.status='aktif' ");
    while($row = mysqli_fetch_array($cek_tagihan)){ 
    $cek_bayar = mysqli_query($con,"select * from tagihan where id_user='$row[id_user]' and id_langganan='$row[id_langganan]' and priode='$priode' and tahun='$tahun' #and status='belumbayar'");
    if(!mysqli_num_rows($cek_bayar))
    {
     
    
        $jp = $row['tgl_tempo'];
    $due = ($tgl - $jp);
  
    $nama = $row['nama'];
    $tarif = $row['tarif'];
    $tempo = $row['tgl_tempo'];
    ?>
        <tr style='color:<?=$warna?>'>
            <td><?=$no++?></td>
            <td><?=$nama?></td>
            <td><?=$row['nama_paket']?></td>
            <td><?=uang($tarif,'ya')?></td>
            <td><?=uang($row['total_tagihan'],'ya')?></td>
            <td><?=($tempo)?> - <?=$bulan[$priode]?> - <?=$tahun?></td>
            <td><?=$due?></td>
            <td>
                <input type="hidden" name="id_langganan[]" value='<?=$row['id_langganan']?>' id="">
                <input type="hidden" name="id_user[]" value='<?=$row['id_user']?>' id="">
                <input type="hidden" name="priode[]" value='<?=$priode?>' id="">
                <input type="hidden" name="tahun[]" value='<?=$tahun?>' id="">
            </td>
        </tr>
    <?php 
    $total_tarif += $tarif;
    $total += $row['total_tagihan'];
    }
    }
    ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">TOTAL </td>
            <td><?=uang($total_tarif,'ya')?></td>
            <td><?=uang($total,'ya')?></td>
            <td>
                <input type="submit" id='tanya' onclick='tanya()' name='buat_tagihan' class="btn btn-danger btn-lg" value='BUAT TAGIHAN'>
            </td>
        </tr>
    </tfoot>
</table>
</form>
<?php 
if(isset($_POST['buat_tagihan'])){
    $id_lang  =$_POST['id_langganan'];
    $no=0;
    for($i=0;$i<count($id_lang);$i++){
       $id_langganan = $id_lang[$i];
       $id_user=$_POST['id_user'][$i];
       $priode=$_POST['priode'][$i];
       $tahun=$_POST['tahun'][$i];
       $q[]="INSERT into tagihan(id_langganan,id_user,status,priode,tahun)
       values('$id_langganan','$id_user','belumbayar','$priode','$tahun');";
       $no++;
    }
    $tex  = implode("",($q));
    $insert = mysqli_multi_query($con,$tex);
    
    if($insert){
        swal("Berhasil Membuat $no Tagiha, Sekarang anda akan diarahkan ke menu tagihan","INFORMASI");
        pindah(menu('wifi'));
    }
    else swal('Gagal ditambahkan','INFORMASI','warning');
}
?>
