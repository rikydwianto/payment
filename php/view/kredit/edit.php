<h1 class="display-1">EDIT PELANGGAN</h1>
<?php 
$id = aman(de($_GET['id']));
$user = mysqli_query($con,"select * from tb_user where id_user='$id'");
$r = mysqli_fetch_array($user);
?>
<div class="row">
    <div class="container">
        <div class="col-md-8">
        <form method="post">
            <table class='table table-boredered'>
                <tr>
                    <td>NAMA PELANGGAN</td>
                    <td>
                        <input type="text" value='<?=$r['nama']?>' required class='form-control' name='nama'>
                    </td>
                </tr>
                <tr>
                    <td>USERNAME
                        <br><code>bisa dikosongkan</code>
                    </td>
                    <td>
                        <input type="text" readonly value='<?=$r['username']?>'  class='form-control' name='uname'>
                    </td>
                </tr>
                <tr>
                    <td>NO HP <br>
                    <code> tanpa 0896 didepan(896)</code></td>
                    <td>
                        <input type="text" value='<?=$r['no_hp']?>'  class='form-control' name='nohp'>
                    </td>
                </tr>
                
                <tr>
                    <td>PASSWORD
                        <br><code>bisa dikosongkan</code>
                        
                    </td>
                    <td>
                        <input type="text"  class='form-control' name='password'>
                    </td>
                </tr>
         
                <tr>
                    <td>LEVEL</td>
                    <td> 
                        <?=level_user("$r[level]")?>
                    </td>
                </tr>
                <tr>
                    <td>STATUS</td>
                    <td>
                      <?=status($r['status'])?>
                    </td>
                </tr>
                <tr>
                    <td>UNIT USAHA</td>
                    <td>
                      <?=select_usaha($con,$r['id_usaha'])?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name='edit_user' value='SIMPAN'class='btn btn-danger btn-lg'>
                    </td>
                </tr>
            </table>
        </form>
        </div>
    </div>
</div>
<?php
if(isset($_POST['edit_user'])){
    $nama = aman($_POST['nama']);
    $uname = aman($_POST['uname']);
    $ganti_pass ="";
    if(!empty($_POST['password'])){
        $pass = md5(aman($_POST['password']));
        $ganti_pass = ", password='$pass'";
    }
    $nohp = aman($_POST['nohp']);
    $level = aman($_POST['level']);
    $id_usaha = aman($_POST['id_usaha']);
    $status = aman($_POST['status']);
    $insert = "UPDATE `tb_user` SET `status` = '$status', username='$uname',id_usaha='$id_usaha', level='$level', no_hp='$nohp', nama='$nama' $ganti_pass WHERE `id_user` = '$id'; 
    ";
    $query = mysqli_query($con,$insert);
    if($query){
        swal('Berhasil ditambahkan, Silahkan Pilih Paket','INFORMASI');
        $id_user  = mysqli_insert_id($con);
        pindah($url.$menu.'pelanggan&sub=list');
    }
    else{
        
        $erro = (mysqli_error($con));
        swal("Gagal ditambahkan, Error : $erro",'GAGAL',"warning");
    }

}