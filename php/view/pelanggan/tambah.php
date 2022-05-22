<?php 
$cek_user = mysqli_query($con,"select count(*) as total, id_user,username from tb_user where level='cust' and id_usaha='$id_usaha' order by id_user desc limit 0,1");
$cek_user = mysqli_fetch_array($cek_user);

if($cek_user['total']==0){
    
    $no_user = 1;

} 
else{
    // $cek_user = mysqli_fetch_array($cek_user);
    $no_user = (int)$cek_user['total'] + 1;
    // echo $cek_user['username'];
}
$val_user = "cust-".sprintf("%03d",$id_usaha).'-'. sprintf("%04d",$no_user);
?>
<h1 class="display-1">TAMBAH USER</h1>
<div class="row">
    <div class="container">
        <div class="col-md-8">
        <form method="post">
            <table class='table table-boredered'>
                <tr>
                    <td>NAMA PELANGGAN</td>
                    <td>
                        <input type="text" required class='form-control' name='nama'>
                    </td>
                </tr>
                <tr>
                    <td>USERNAME
                        <br><code>bisa dirubah</code>
                    </td>
                    <td>
                        <input type="text" readonly value='<?=$val_user?>' class='form-control' name='uname'>
                    </td>
                </tr>
                <tr>
                    <td>NO HP <br>
                    <code> tanpa 0896 didepan(896)</code></td>
                    <td>
                        <input type="text" class='form-control' name='nohp'>
                    </td>
                </tr>
                
                <tr>
                    <td>PASSWORD
                        <br><code>bisa dikosongkan</code>
                        
                    </td>
                    <td>
                        <input type="text" value='123456' class='form-control' name='password'>
                    </td>
                </tr>
         
                <tr>
                    <td>LEVEL</td>
                    <td>
                        <?=level_user('cust')?>
                    </td>
                </tr>
                <tr>
                    <td>STATUS</td>
                    <td>
                      <?=status('aktif')?>
                    </td>
                </tr>
                <tr>
                    <td>UNIT USAHA</td>
                    <td>
                      <?=select_usaha($con,$id_usaha)?>
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
        </div>
    </div>
</div>
<?php
if(isset($_POST['tambah_user'])){
    $nama = aman($_POST['nama']);
    $uname = aman($_POST['uname']);
    $pass = md5(aman($_POST['password']));
    $nohp = aman($_POST['nohp']);
    $is_usaha = aman($_POST['id_usaha']);
    $level = aman($_POST['level']);
    $status = aman($_POST['status']);
    $insert = "INSERT INTO `tb_user` ( `username`,`password`, `nama`, `no_hp`, `level`, `status`,id_usaha)
     VALUES ('$uname','$pass', '$nama', '$nohp', '$level', '$status','$id_usaha'); ";
    $query = mysqli_query($con,$insert);
    if($query){
        swal('Berhasil ditambahkan, Silahkan Pilih Paket','INFORMASI');
        $id_user  = mysqli_insert_id($con);
        pindah($url.$menu.'pelanggan&sub=tambah&id='.$id_user);
    }
    else{
        $erro = htmlentities(mysqli_error($con));
        swal("Gagal ditambahkan, Error : $erro",'GAGAL',"warning");
       
    }

}