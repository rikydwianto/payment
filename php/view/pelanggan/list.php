<h1 class='display-2'>Daftar User</h1>
<hr>

<table class='table table-bordered' id='table'>
    <thead>
        <tr>
            <th>NO</th>
            <th>NAMA</th>
            <th>USERNAME</th>
            <th>NO HP</th>
            <th>LEVEL</th>
            <th>STATUS</th>
            <th>LANGGANAN</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    $qlist= mysqli_query($con,"select * from tb_user where id_usaha='$id_usaha' #and level='cust' ");
    while($user = mysqli_fetch_array($qlist)){

    
    ?>
        <tr>
            <td><?=$no?></td>
            <td><?=$user['nama']?></td>
            <td><?=$user['username']?></td>
            <td><?=$user['no_hp']?></td>
            <td><?=$user['level']?></td>
            <td><?=$user['status']?></td>
            <td>
            <?php
            $cek_langganan = mysqli_query($con,"select * from langganan l join paket p on p.id_paket=l.id_paket where id_user='$user[id_user]'");
            if(mysqli_num_rows($cek_langganan)>0){
                while($sub = mysqli_fetch_array($cek_langganan)){
                    echo $sub['nama_paket'].'-'.$sub['status'].' <br>';
                }
            } else{
                echo"belum berlangganan";
            }
            ?>
            </td>
            <td>
                <?php $link =(menu('pelanggan','hapus',$user['id_user']));?>
                <a href="<?=menu('pelanggan','langganan',$user['id_user']);?>"  class="btn btn-success"><i class="ti-plus"></i> Langganan</a>
                <a href="<?=menu('pelanggan','edit',$user['id_user']);?>"  class="btn btn-warning"><i class="ti-pencil"></i></a>
                <a href="javascript:void(0)" onclick="konfirmasi('<?=$link?>','Apakah anda yakin menghapus <?=$user['nama']?> ini?');" class="btn btn-danger"><i class="ti-close"></i></a>

            </td>
        </tr>
    <?php 
    $no++;
    }
    ?>
    </tbody>
</table>