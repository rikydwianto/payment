<?php 
$cek_user = mysqli_query($con,"select count(*) as total from transaksi where id_usaha='$id_usaha' order by id_transaksi desc limit 0,1");
$cek_user = mysqli_fetch_array($cek_user);

if($cek_user['total']==0){
    
    $no_user = 1;

} 
else{
    // $cek_user = mysqli_fetch_array($cek_user);
    $no_user = (int)$cek_user['total'] + 1;
    // echo $cek_user['username'];
}
$val_user = "ORD-".sprintf("%03d",$id_usaha).'-'. sprintf("%04d",$no_user).'-'.date("Ymdhi");

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<h3>KASIR
<div style="float:right"> 
<!-- <a href="javascript:history.go(-1)" class="btn btn-success">KEMBALI</a>
<a href="<?=menu('kas','list')?>" class="btn btn-info"><i class="ti ti-eye"></i> KAS</a>
<a href="<?=$actual_link.'&kelola'?>" class="btn btn-danger"><i class="ti ti-unlock"></i> KELOLA KAS</a>
<a href="<?=menu('kas','tambah')?>" class="btn btn-primary"><i class="ti ti-plus"></i> KAS</a> -->
</div>
<?php
if(isset($_GET['kode_bayar'])){
    $val_user = $_GET['kode_bayar'];
    $cari_kode=mysqli_query($con,"SELECT * FROM transaksi where id_usaha='$id_usaha' and kode_transaksi='$val_user'");
    
    if(!mysqli_num_rows($cari_kode)){
        mysqli_query($con,"INSERT INTO `transaksi` (`kode_transaksi`, `tgl_transaksi`, `keterangan`, `total_bayar`, `id_usaha`, `id_user`, `waktu_transaksi`, `status`) 
        VALUES ('$val_user', curdate(), 'masih proses', '0', '$id_usaha', '$uid', now(), 'pending'); ");
        echo mysqli_error($con);
       pindah('');
    }
    else{
        mysqli_query($con,"UPDATE transaksi set tgl_transaksi=curdate() where id_usaha='$id_usaha' and id_transaksi='$val_user'");
    }
    $trx =mysqli_fetch_array($cari_kode);
    ?>
            
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php 
                    
                    ?>
                    <input type="text" readonly name="kode_bayar" value='<?=$val_user?>'id='kode_bayar' class='form-control'>
                    <input type="search" name="barang" id='barang' oninput="pilih_barang()" class='form-control' placeholder="Masukan Kode barang/nama barang" id="">
                </div>
                <div class="col-md-12">
                    <div id="tampil">

                    </div>
                    <hr>
                </div>
                <div class="col-md-12">
                    <div id="tampil1">

                    </div>
                </div>
            </div>
        </div>

        <script>
            let url_api = "<?=$url?>"+"api/";
            let kode_bayar = "<?=$val_user?>";
            let idbayar = "<?=$trx['id_transaksi']?>";

       
function berhasil(){
    Swal.fire({
    position: 'top-end',
    icon: 'success',
    title: 'Disimpan',
    showConfirmButton: false,
    timer: 300
    })
}

        function pilih_barang(){
            
                const param = $("#barang").val();
                $.get(url_api+"api.php?pilih_barang&param="+param,(data)=>{

                    $("#tampil").html(data);
                    // $("#tampil1").html(data);
                   
            })
            tampil()
        }


        function tambah_barang(id){
            $("#barang").val('');
            $("#tampil").html('tunggu');
            setTimeout(()=>{
                $("#tampil").html('ditambahkan ke keranjang');
                berhasil()
            },1000);

            $.get(url_api+"api.php?tambah_barang&id="+id+"&kode="+kode_bayar+"&idbayar="+idbayar,(data)=>{

                $("#tampil").html(data);
                tampil()
            })
            tampil()

        }

        function ganti_qty(id){
           const qty = $("#qty-"+id).val();
           $.get(url_api+"api.php?ganti_qty&id="+id+"&qty="+qty,(data)=>{
            berhasil();
               
            })
            setTimeout(() => {
                tampil()
            }, 200);
        }

        function ganti_diskon(id){
            
           const diskon = $("#diskon").val();
        //    alert(id)
           $.get(url_api+"api.php?ganti_diskon&id="+id+"&diskon="+diskon,(data)=>{
            berhasil();

               
            })
            setTimeout(() => {
                tampil()
            }, 200);
        }

        function ganti_harga(id){
           const harga = $("#harga-"+id).val();
           $.get(url_api+"api.php?ganti_harga&id="+id+"&harga="+harga,(data)=>{
            //    alert(data)
            berhasil();

               
            })
            setTimeout(() => {
                tampil()
            }, 200);
        }


        function tampil(){
            $.get(url_api+"api.php?transaksi&kode="+kode_bayar+"&idbayar="+idbayar,(data)=>{

            $("#tampil1").html(data);
            // tampil()
            })
        }

        function hapus_barang(id){
            $.get(url_api+"api.php?hapusbarang&id="+id,(data)=>{
            berhasil();
                            
                })
                setTimeout(() => {
                    tampil()
                }, 200);
        }

        function bayar(id){
            Swal.fire({
            title: 'Apakah yakin untuk menyelesaikan Transaksi ini??',
            // showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Save',
            denyButtonText: `Don't save`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.get(url_api+"api.php?bayar&idtrx="+id,(data)=>{

                    Swal.fire(data, '', 'info')
                    window.location.href='<?=menu('cashir')?>'
                    })
                
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
            })

            
        }
        tampil();
        </script>
    <?php
}
else{
    ?>
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
    <?php
}