<h4>Daftar Paketan Wifi</h4>
<hr>
<table class='table table-bordered' id='table'>
    <thead>
        <tr>
            <th>NO</th>
            <th>NAMA PAKET</th>
            <th>TARIF</th>
            <th>DESKRIPSI</th>
            <th>KATEGORI</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $cek_paket = mysqli_query($con,"select * from paket where kategori='wifi'");
        while($row = mysqli_fetch_array($cek_paket)){

        
        ?>
        <tr>
            <td><?=$no?></td>
            <td><?=$row['nama_paket']?></td>
            <td><?=uang($row['tarif'])?></td>
            <td><?=$row['keterangan']?></td>
            <td><?=$row['kategori']?></td>
            <td>
                <a href="javascript:void(0);" data-url='<?=$menu_al."act=hapus&id=$row[id_paket]"?>' id='klik_<?=$no?>' onclick="confirm_aksi('<?=$no?>','link')" class="btn btn-danger"><i class="ti-close"></i></a>
                <a href="<?=$menu_al."act=edit&id=$row[id_paket]"?>" class="btn btn-warning"><i class="ti-pencil"></i></a>
            </td>
        </tr>
        <?php 
        $no++;
        }
        ?>
    </tbody>
</table>
<?php 
if(isset($_GET['act'])){
    $act = $_GET['act'];
    if($act=='hapus'){
        $id=aman($_GET['id']);
       $hapus = mysqli_query($con,"delete from paket where id_paket='$id'");
       if($hapus){
           swal("Berhasil Dihapus");
           pindah($menu_al);
       }
       else{
           swal("gagal dihapus". mysqli_error($con),"warning",'Gagal');
       }
    }
}
?>
