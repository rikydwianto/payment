<h1 class='display-2'>Stok Barang</h1>
<hr>

<table class='table table-bordered' id='table'>
    <thead>
        <tr>
            <th>NO</th>
            <th>KODE BARANG</th>
            <th>NAMA</th>
            <th>KATEGORI</th>
            <th>HARGA BELI</th>
            <th>HARGA JUAL</th>
            <th>STOK</th>
            <th>SATUAN</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    $qlist= mysqli_query($con,"SELECT * from barang where id_usaha='$id_usaha' and deleted is null ");
    while($barang = mysqli_fetch_array($qlist)){

    
    ?>
        <tr>
            <td><?=$no?></td>
            <td><?=$barang['kode_barang']?></td>
            <td><?=$barang['nama_barang']?></td>
            <td><?=$barang['kategori']?></td>
            <td><?=uang($barang['harga_beli'])?></td>
            <td><?=uang($barang['harga_jual'])?></td>
            <td><?=$barang['stok']?></td>
            <td><?=$barang['satuan']?></td>
           
            <td>
                <?php $link =(menu('barang','hapus',$barang['id_barang']));?>
                <a href="<?=menu('barang','stok',$barang['id_barang']);?>"  class="btn btn-success"><i class="ti-plus"></i> Stok</a>
                <!-- <a href="<?=menu('barang','edit',$barang['id_barang']);?>"  class="btn btn-warning"><i class="ti-pencil"></i></a> -->
                <a href="javascript:void(0)" onclick="konfirmasi('<?=$link?>','Apakah anda yakin menghapus <?=$barang['nama_barang']?> ini?');" class="btn btn-danger"><i class="ti-close"></i></a>

            </td>
        </tr>
    <?php 
    $no++;
    }
    ?>
    </tbody>
</table>