<?php 
$cek_user = mysqli_query($con,"select count(*) as total, id_pembiayaan,kode_pembiayaan from pembiayaan where  id_usaha='$id_usaha' order by id_pembiayaan desc limit 0,1");
$cek_user = mysqli_fetch_array($cek_user);

if($cek_user['total']==0){
    
    $no_user = 1;

} 
else{
    // $cek_user = mysqli_fetch_array($cek_user);
    $no_user = (int)$cek_user['id_pembiayaan'] + 1;
    // echo $cek_user['username'];
}
$val_user = "pemb-".sprintf("%03d",$id_usaha).'-'. sprintf("%04d",$no_user);
?>
<h1 class="display-1">PENGAJUAN KREDIT</h1>
<div class="row">
    <div class="container">
        <div class="col-md-8">
        <!-- CARI NASABAH -->
        <?php
        if(!isset($_GET['kirim'])){
            ?>
            <form method="get" action="">
            <input type="hidden" name='menu' value='kredit'>
            <input type="hidden" name='sub' value='tambah'>
            <table class='table'>
                <tr>
                    <td>NASABAH</td>
                    <td>
                        <select name="id" class='form-control' required id="">
                            <option value="" >PILIH NASABAH</option>
                            <?php 
                            $quser=mysqli_query($con,"select * from tb_user where id_usaha ='$id_usaha' and status='aktif' and level='cust' order by id_user asc");
                            while($user = mysqli_fetch_array($quser)){
                                ?>
                            <option value="<?=base64_encode(sprintf("%09d",$user['id_user']))?>"><?=$user['username']?> - <?=$user['nama']?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <input type="submit" value='Pilih' class='btn btn-primary' name='kirim'>
                    </td>
                </tr>
            </table>
        </form>
            <?php
        }
        else{

        
        $id = aman(de($_GET['id']));
        $cek_user = mysqli_query($con,"SELECT * from tb_user where id_usaha='$id_usaha' and id_user='$id'");
        $user = mysqli_fetch_array($cek_user);
        echo mysqli_error($con);
        ?>
        <form method="post">
            <table class='table table-boredered'>
                <tr>
                    <td>NAMA PELANGGAN</td>
                    <td>
                        <input type="text" value="<?=$user['nama']?>" required class='form-control' name='nama'>
                    </td>
                </tr>
                <tr>
                    <td>KODE PEMBIAYAAN
                        <br><code>Tidak bisa dirubah</code>
                    </td>
                    <td>
                        <input type="text" readonly value='<?=$val_user?>' class='form-control' name='kode_pemb'>
                    </td>
                </tr>
                <tr>
                    <td>PRODUK <br>
                    <!-- <code> tanpa 0896 didepan(896)</code></td> -->
                    <td>
                    <select name="paket" required class='form-control' id="">
                        <option value="">SILAHKAN PILIH PAKET</option>
                        <?php 
                            $cek_paket = mysqli_query($con,"select * from paket where id_usaha='$id_usaha' and kategori='kredit'");
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
                    <td>NOMINAL
                        <!-- <br><code>bisa dikosongkan</code> -->
                        
                    </td>
                    <td>
                        <input type="number" value='0' class='form-control' name='nominal'>
                    </td>
                </tr>
                <tr>
                    <td>MARGIN
                        <!-- <br><code>bisa dikosongkan</code> -->
                        
                    </td>
                    <td>
                        <input type="number" value='25' class='form-control' name='rate'>
                    </td>
                </tr>
                
                <tr>
                    <td>Jangka Waktu(Hari)</td>
                    <td>
                        <input type="number" value='25' class='form-control' name='jk'>
                    </td>
                </tr>
                <tr>
                    <td>TANGGAL</td>
                    <td>
                      <input type="date" value='<?=date("Y-m-d")?>' name="tgl" class='form-control'id="">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name='tambah_user' value='TAMBAH'class='btn btn-danger btn-lg'>
                    </td>
                </tr>
            </table>
        </form>
        <?php 
        }
        ?>
        </div>
    </div>
</div>
<?php
if(isset($_POST['tambah_user'])){
    $id_paket  = $_POST['paket'];
    $jk  = $_POST['jk'];
    $kode_pemb  = $_POST['kode_pemb'];
    $nominal  = $_POST['nominal'];
    $tgl  = $_POST['tgl'];
    $rate  = $_POST['rate'];
    $pokok = ($nominal)/$jk;
    $margin = ($nominal*($rate/100))/$jk;

    $insert = "INSERT INTO `pembiayaan` (`id_user`, `id_paket`, `kode_pembiayaan`, `pembiayaan`, `sisa_saldo`, `pokok`, `margin`, `ke`, `rill`, `jangka_waktu`, `status`, `id_usaha`, `tgl_pembiayaan`,rate)
     VALUES ('$id', '$id_paket', '$kode_pemb', '$nominal', '$nominal', '$pokok', '$margin', '0', '0', '$jk', 'pending', '$id_usaha', '$tgl','$rate'); 
     ";
    $query = mysqli_query($con,$insert);
    if($query){
        swal('Berhasil ditambahkan, Silahkan Pilih Paket','INFORMASI');
        $id_user  = mysqli_insert_id($con);
        pindah($url.$menu.'kredit&sub=list');
    }
    else{
        $erro = htmlentities(mysqli_error($con));
        swal("Gagal ditambahkan, Error : $erro",'GAGAL',"warning");
       
    }

}