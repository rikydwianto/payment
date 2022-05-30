<?php
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
            
        <div class="container" style="font-size:80% ;">
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
                let total_diskon = $("#total_diskon").val();
                let total_bayar = $("#total_bayar").val();
                $.get(url_api+"api.php?bayar&idtrx="+id+"&total_diskon="+total_diskon+"&total_bayar="+total_bayar,(data)=>{

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
