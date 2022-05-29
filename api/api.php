<?php include "../config/setting.php" ;
?>
<?php include "../php/config/function.php" ?>
<?php include "../vendor/autoload.php"; ?>
<?php include "../php/config/koneksi.php"; ?>
<?php include"../php/proses/db.php";?>
<?php $id_usaha = $_SESSION['id_usaha'];
if(isset($_GET['pilih_barang'])){
   
    $key = $_GET['param'];
    if($key==""){
        // echo "<h3>Jangan dikosongkan</h3>";
        exit;

    }
    ?>
    <h3>Silahkan pilih barang</h3>
    <div class='col-md-7'>
    <ul class="list-group">
    <?php 
    $q=mysqli_query($con,"SELECT * from barang where id_usaha='$id_usaha' and (nama_barang like '%$key%' or kode_barang like'%$key%') and stok>0");
    if(!mysqli_num_rows($q)){
        echo "$key tidak ditemukan";
    }
    else{

        while($r=mysqli_fetch_array($q)){
            ?>
        <li class="list-group-item"><?=$r['kode_barang']?> - <?=$r['nama_barang']?> - <?=uang($r['harga_jual'],'ya')?> <code>> <?=$r['stok']?></code>
        <a href="javascript:void(0)" class="btn btn-danger" onclick="tambah_barang('<?=$r['id_barang']?>')" style="float: right;"><i class="ti ti-plus"></i> </a>
        </li>
        <?php
    }
}
    ?>
</ul>
    </div>
    <?php
}

if(isset($_GET['tambah_barang'])){
   $id = $_GET['id'];
   $kode = $_GET['kode'];
   $idtrx = $_GET['idbayar'];
   $cek_barang = mysqli_query($con,"select * from detail_transaksi where id_transaksi='$idtrx' and id_barang='$id'");
   if(mysqli_num_rows($cek_barang)){
       mysqli_query($con,"UPDATE detail_transaksi set qty=qty+1  where id_transaksi='$idtrx' and id_barang='$id' ");
   }
   else{
        $cek_barang = mysqli_query($con,"select * from barang where id_usaha='$id_usaha' and id_barang='$id'");
        $barang = mysqli_fetch_array($cek_barang);
       $input = mysqli_query($con,"INSERT into detail_transaksi(id_transaksi,id_barang,qty,harga_beli,harga_jual) values('$idtrx','$id',1,'$barang[harga_beli]','$barang[harga_jual]')");

   }
   echo mysqli_error($con);
//    echo"berhasil";
}
if(isset($_GET['hapusbarang'])){
   $id = $_GET['id'];
   $input = mysqli_query($con,"delete from detail_transaksi where id='$id'");
   echo mysqli_error($con);
//    echo"berhasil";
}


if(isset($_GET['ganti_qty'])){
   $id = $_GET['id'];
   $qty = $_GET['qty'];
      $input = mysqli_query($con,"update detail_transaksi set qty='$qty' where id='$id'");
   echo mysqli_error($con);
//    echo"berhasil";
}

if(isset($_GET['ganti_diskon'])){
   $id = $_GET['id'];
   $diskon = $_GET['diskon'];
      $input = mysqli_query($con,"update transaksi set diskon_rate='$diskon' where id_transaksi='$id'");
   echo mysqli_error($con);
//    echo"berhasil";
}

if(isset($_GET['bayar'])){
   $id = $_GET['idtrx'];
//    $diskon = $_GET['diskon'];
    $qbarang =mysqli_query($con,"SELECT *, d.harga_jual as harga_tampil from detail_transaksi d join barang b on b.id_barang=d.id_barang  where  d.id_transaksi='$id'");
    while($trx = mysqli_fetch_array($qbarang)){

        mysqli_query($con,"update barang set stok=stok-$trx[qty] where id_barang='$trx[id_barang]'");
    }
    
      $input = mysqli_query($con,"update transaksi set status='berhasil' where id_transaksi='$id'");
      echo "berhasil";
   echo mysqli_error($con);
//    echo"berhasil";
}

if(isset($_GET['ganti_harga'])){
   $id = $_GET['id'];
   $harga = $_GET['harga'];
      $input = mysqli_query($con,"update detail_transaksi set harga_jual='$harga' where id='$id'");
   echo mysqli_error($con);
//    echo"berhasil";
}


if(isset($_GET['transaksi'])){
    // $id = $_GET['id'];
    $kode = $_GET['kode'];
    $idtrx = $_GET['idbayar'];
    $trx = mysqli_query($con,"select * from transaksi where id_transaksi='$idtrx'");
    $trx = mysqli_fetch_array($trx);
    ?>
    <a href="javascript:tampil()" class="btn">refresh</a>
    <table class='table table-bordered'>
        <tr>
            <td>KODE TRANSAKSI</td>
            <td><?=$kode?></td>
            <td>TANGGAL TRANSAKSI</td>
            <td><?=date("Y-m-d")?></td>
        </tr>
    </table>
    <form action="">
        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th>NO</th>
                    <!-- <th>KODE BARANG</th> -->
                    <th>NAMA BARANG</th>
                    <th>QTY/HARGA</th>
                    <!-- <th>QTY</th> -->
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $qbarang =mysqli_query($con,"SELECT *, d.harga_jual as harga_tampil from detail_transaksi d join barang b on b.id_barang=d.id_barang  where  d.id_transaksi='$idtrx'");
               echo mysqli_error($con);
               $total_bayar =0;
               $total_qty = 0;
                while($list=mysqli_fetch_array($qbarang)){
                    $harga_tampil = $list['harga_tampil'];
                    if($harga_tampil<0 || $harga_tampil==null){
                        $harga_tampil=$list['harga_jual'];
                    }
                    ?>
                     <tr>
                        <td><?=$no++?></td>
                        <!-- <td><?=$list['kode_barang']?></td> -->
                        <td><?=$list['nama_barang']?></td>
                        <td><input type="number" style="width:100px ;"  name="qty[]" class='form-control' id='qty-<?=$list['id']?>' onchange="ganti_qty('<?=$list['id']?>')" value='<?=$list['qty']?>' min=1 max='<?=$list['stok']?>' id="">
                            <input type="number" name='harga[]' style="width:150px ;" class='form-control' id='harga-<?=$list['id']?>' onchange="ganti_harga('<?=$list['id']?>')" value='<?=$harga_tampil?>' >
                        </td>
                        <!-- <td>
                            
                            
                        </td> -->
                        <td>
                            <?php 
                            $total = $harga_tampil * $list['qty'];
                            $total_qty += $list['qty'];
                            $total_bayar +=$total;
                            echo $list['qty'].' X '.uang($harga_tampil,'ya').'<br/>';
                            echo uang($total,'ya');
                            ?>
                        </td>
                        <td>
                            <a href="javascript:void(0)" onclick="hapus_barang('<?=$list['id']?>')"  class="btn"><i class="ti ti-close"></i></a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">TOTAL</th>
                    <!-- <th colspan="1"><?=$total_qty?></th> -->
                    <th colspan="1"><?=uang($total_bayar,'ya')?></th>
                </tr>
            </tfoot>
        </table>
        <table class='table table-bordered'>
        <tr>
            <td colspan="3">TOTAL ITEM</td>
            <!-- <td></td> -->
            <!-- <td></td> -->
            <td><?=uang($total_qty,'t')?></td>
        </tr>
        <tr>
            <td colspan="3">TOTAL TRANSAKSI</td>
            <!-- <td></td> -->
            <!-- <td></td> -->
            <td><?=uang($total_bayar,'ya')?></td>
        </tr>
        <?php 
        $diskon = $trx['diskon_rate'];
        $total_diskon = ($total_bayar*($diskon/100));
        ?>
        <tr>
            <td>DISKON(%)</td>
            <td></td>
            <td>
                <input type="number" value="<?=$diskon?>" id='diskon' onchange="ganti_diskon('<?=$idtrx?>')" min=0 class='form-control' style="width:100px ;">
            </td>
            <td><?=uang($total_diskon,'ya')?></td>
        </tr>
        <tr>
            <td>TOTAL SETELAH DISKON</td>
            <td></td>
            <td>
            </td>
            <td><?=uang($total_bayar = $total_bayar - $total_diskon,'ya')?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
            </td>
            <td>
            <a href="javascript:void(0)" class="btn btn-lg btn-danger" onclick="bayar('<?=$idtrx?>')">Bayar</a>
            </td>
        </tr>
    </table>
    </form>
    <?php
}