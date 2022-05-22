<h1 class='display-2'>Daftar Kredit</h1>
<hr>

<table class='table table-bordered' id='table'>
    <thead>
        <tr>
            <th>NO</th>
            <th>NAMA</th>
            <th>NO AKUN</th>
            <th>NOMINAL</th>
            <th>CICILAN</th>
            <th>JK</th>
            <th>TGL</th>
            <th>STATUS</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    $qlist= mysqli_query($con,"SELECT p.*, u.nama from pembiayaan p join tb_user u on u.id_user=p.id_user join paket pk on pk.id_paket=p.id_paket 
    where p.id_usaha='$id_usaha' ");
    while($user = mysqli_fetch_array($qlist)){

    
    ?>
        <tr>
            <td><?=$no?></td>
            <td><?=$user['nama']?></td>
            <td><?=$user['kode_pembiayaan']?></td>
            <td><?=uang($user['pembiayaan'],'ya')?></td>
            <td><?=uang($user['pokok']+$user['margin'],'ya')?></td>
            <td><?=$user['jangka_waktu']?></td>
            <td><?=$user['tgl_pembiayaan']?></td>
            <td>
                <?=$user['status']?>
            </td>
            <td>
                <?php $link =(menu('kredit','hapus',$user['id_pembiayaan']));?>
                
                <?php 
                if($user['status']!='disetujui'){
                    ?>
                <a href="<?=menu('kredit','edit',$user['id_user']);?>"  class="btn btn-warning"><i class="ti-pencil"></i></a>
                <a href="javascript:void(0)" onclick="konfirmasi('<?=$link?>','Apakah anda yakin menghapus Pembiayaan dengan nama user <?=$user['nama']?> ini?');" class="btn btn-danger"><i class="ti-close"></i></a>
                <a href="javascript:void(0)" onclick="konfirmasi('<?=menu('kredit','setujui',$user['id_pembiayaan'])?>','Apakah anda yakin untuk menyetujui pinjaman ini??')" class="btn btn-success"><i class="ti-check"></i> Setujui</a>
                    <?php
                }
                else{
                    ?>
                    
                    <?php
                }
                ?>

            </td>
        </tr>
    <?php 
    $no++;
    }
    ?>
    </tbody>
</table>