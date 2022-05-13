<h3>LOGIN PAGE</h3> <hr>

<form method="post" >
	 <table class='table'>
	  <tr>
		<td>NIK</td>
		<td><input type="text" name="uname" class="form-control"  placeholder="contoh 3729/2017"></td>
	  </tr>
	  <tr>
		<td>Password</td>
		<td><input type="password" class="form-control"  required name="password"></td>
	  </tr>
	  <tr>
		<td></td>
		<td><input type="submit" class="btn btn-primary"  name="login" value="Log In"></td>
	  </tr>
	</table> 
</form>
<?php
if(isset($_POST['login'])){
$user=aman($_POST['uname']);
$pass=aman(md5($_POST['password']));
// // session_start();
// session_destroy();
$q=mysqli_query($kon,"select * from user where username='$user'  ");
// echo mysqli_error($kon);
// echo mysqli_num_rows($q);
if(mysqli_num_rows($q)>0){
	$cek=mysqli_fetch_array($q);
		if($cek['password'] == $pass){
            $_SESSION['uid']=$cek['id_user'];
            $_SESSION['level']=$cek['level'];
		pesan("BERHASIL LOGIN",'success');
		pindah("$url");
		
		}
		else
		pesan("USERNAME DITEMUKAN, Password SALAH!!",'danger');
		echo mysqli_error($con);
	

	
}

else pesan("USERNAME TIDAK DITEMUKAN",'danger');
}
?>