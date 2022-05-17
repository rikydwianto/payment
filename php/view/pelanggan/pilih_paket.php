<?php 
$id = aman(de($_GET['id']));
$user = mysqli_query($con,"select * from tb_user where id_user='$id'");
$r = mysqli_fetch_array($user);
?>
<h1 class='display-1'>Pilih Paket untuk <?=$r['nama']?></h1>
<?php

if(isset($_GET['nonaktif'])){
    $id_la = aman($_GET['id_la']);
    $non = mysqli_query($con,"update langganan set status='tidakaktif' where id_langganan='$id_la'");
    if($non){
        swal("Berhasil di NON-AKTIFKAN","INFORMASI!");
    }
    else swal("GAGAL,ADA MASALAH",'ERROR','warning');
}

if(isset($_GET['aktif'])){
    $id_la = aman($_GET['id_la']);
    $non = mysqli_query($con,"update langganan set status='aktif' where id_langganan='$id_la'");
    if($non){
        swal("Berhasil di AKTIFKAN","INFORMASI!");
    }
    else swal("GAGAL,ADA MASALAH",'ERROR','warning');
}

 $cek_langganan = mysqli_query($con,"select * from langganan l join paket p on p.id_paket=l.id_paket where id_user='$r[id_user]'");
 if(mysqli_num_rows($cek_langganan)>0){
     ?>
     <h2>Data Paket</h2>
     <table class='table table-bordered' id='table!'>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA PAKET</th>
                    <th>DESKRIPSI</th>
                    <th>KATEGORI</th>
                    <th>TARIF</th>
                    <th>TAGIHAN</th>
                    <th>JATUH <br> TEMPO</th>
                    <th>NON AKTIF</th>
                </tr>
            </thead>
            <tbody>
            <?php 
        while($row = mysqli_fetch_array($cek_langganan)){

        
        ?>
        <tr>
            <td><?=$no?></td>
            <td><?=$row['nama_paket']?></td>
            <td><?=$row['keterangan']?></td>
            <td><?=$row['kategori']?></td>
            <td><?=uang($row['tarif'],'ya')?></td>
            <td><?=uang($row['total_tagihan'],'ya')?></td>
            <td><?=($row['tgl_tempo'])?></td>
            <td>
            <?php
            if($row['status']=='aktif'){
                ?>
                <a href="javascript:konfirmasi('<?=menu('pelanggan','langganan',$id,'nonaktif&id_la='.$row['id_langganan'])?>','APAKAH ANDA YAKIN UNTUK MENONAKTIFKAN INI?')" class="btn btn-danger">NON-AKTIFKAN</a>
                <?php
            }
            if($row['status']=='tidakaktif'){
                ?>
                <a href="javascript:konfirmasi('<?=menu('pelanggan','langganan',$id,'aktif&id_la='.$row['id_langganan'])?>','APAKAH ANDA YAKIN UNTUK MENGAKTIFKAN INI?')" class="btn btn-info">AKTIFKAN</a>
                <?php
            }
             ?>
            </td>
        </tr>
        <?php 
        $no++;
        }
        ?>
     </table>
     <?php
     
 } else{
     echo"<h3 class='display-3 text-center'>Belum ada paket .</h3>";
 }
     if(isset($_POST['tmb_lang'])){
         $id_paket = $_POST['paket'];
         $tempo = $_POST['tempo'];
         $paket = paket($id_paket);
         $tagihan = $_POST['tagihan'];
         $id_usaha = $_POST['id_usaha'];
         if(empty($tagihan)){
             $tagihan = $paket['tarif'];
         }
         $text = "INSERT into langganan(id_user,id_paket,tgl_tempo,total_tagihan,mulai_langganan,status,id_usaha)
         values('$id','$id_paket','$tempo','$tagihan',curdate(),'aktif','$id_usaha')";
         $insert = mysqli_query($con,$text);
         echo $tagihan;
         if($insert){
             swal("PAKET $paket[nama_paket] Berhasil Ditambahkan! :) ","INFORMASI");
             pindah(menu('pelanggan','list'));
         }
         else{
             swal("Gagal ditambahkan",'GAGAL','warning');
         }
     }
     ?>
     <form action="" method="post">
         <h3 class='displaly-1'>Tambah</h3>
         <div class='justify-content-md-center'>

             <div class="col-md-8">
                 <table class="table">
                <tr>
                    <td>PAKET</td>
                    <td>
                    <select name="paket" required class='form-control' id="">
                        <option value="">SILAHKAN PILIH PAKET</option>
                        <?php 
                            $cek_paket = mysqli_query($con,"select * from paket where id_usaha='$id_usaha'");
                            while($row = mysqli_fetch_array($cek_paket)){
                                ?>
                                <option value="<?=$row['id_paket']?>"><?=strtoupper($row['kategori'].'-'.$row['nama_paket'].' | '.uang($row['tarif'],'ya'))?></option>
                                <?php
                            }
                        ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td>TGL JATUH TEMPO <br> TEMPO SETIAP BULAN</td>
                    <td>
                    <input type='number' class='form-control' type="submit" name='tempo' value="<?=date('j')?>">
                    </td>
                </tr>
                <tr>
                    <td>TOTAL TAGIHAN <br> JIKA DIKOSONGKAN AKAN SESUAI DENGAN PAKET</td>
                    <td>
                    <input type='number' class='form-control' type="submit" name='tagihan' value="">
                    </td>
                </tr>
                <tr>
                    <td>UNIT</td>
                    <td>
                    <?=select_usaha($con,$id_usaha)?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                    <input class='btn btn-info btn-lg' type="submit" name='tmb_lang' value="SIMPAN">
                    </td>
                </tr>
                
            </table>
        </div>    
    </div>
    
     </form>
     <?php
 
?>