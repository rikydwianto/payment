<?php function load($folder,$param){
    include("php/$folder/$param.php");

}
function de($param){
  return (int)base64_decode($param);
}
function menu($menu,$sub=null,$id=null,$menu_lain=null,$act=null){
  $akhir = $GLOBALS['url'].'?menu='.$menu;
  IF($sub!=null){
    $akhir.="&sub=".$sub;
  }
  IF($id!=null){
    $ID = base64_encode(sprintf("%09d",$id));
    $akhir.="&id=".$ID;
  }
  IF($menu_lain!=null){
    $akhir.="&".$menu_lain;
  }

  return $akhir;
}
function pindah($url){
    ?>
    <script>
      // swal('aaa')
      setTimeout(function() {
        window.location = "<?=$url?>";

    }, 2000);

    </script>
    <?php
}
function aman( $string)
{
  return htmlspecialchars(( $string));
}
function hari()
{
  $hari_array = array(
    'Minggu',
    'Senin',
    'Selasa',
    'Rabu',
    'Kamis',
    'Jumat',
    'Sabtu'
  );
  return ($hari_array);
}

function swal($isi,$title=null,$warna='success'){
  if($title==null){
    $title='Berhasil';
  }
  ?>
  <script>

    
    swal("<?=$title?>", "<?=$isi?>", "<?=$warna?>");


  </script>
  <?php
}
function alert($isi)
{
?>
  <script>
    alert('<?php echo $isi ?>')
  </script>

<?php
}


function pesan($pesan, $warna = 'primary')
{
?>
  <div class="alert alert-<?= $warna ?>" role="alert">
    <?= $pesan ?>
  </div>
<?php
}

function confirm($isi){
  ?>
  <script>
    swal({
          title: "Are you sure?",
          text: "You will not be able to recover this imaginary file!",
          icon: "warning",
          buttons: [
            'No, cancel it!',
            'Yes, I am sure!'
          ],
          dangerMode: true,
        }).then(function(isConfirm) {
          if (isConfirm) {
           return true
          } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
          }
        });
</script>
  <?php
}

function uang($nominal,$rp='tidak'){
	if($rp=='ya'){
    $format="Rp. ";
  }
  else $format='';
	$hasil_rupiah = $format . number_format($nominal,0,',','.');
	return $hasil_rupiah;


}
function dd($param){
  return var_dump($param);
}
$bulan = array(
   '2222',
   'JANUARI',
   'FEBRUARI',
   'MARET',
   'APRIL',
   'MEI',
   'JUNI',
   'JULI',
   'AGUSTUS',
   'SEPTEMBER',
   'OKTOBER',
   'NOVEMBER',
   'DESEMBER',
);

function select_metode($con,$nama='metode',$attr=null){
  ?>
   <select name="<?=$nama?>" <?=$attr?> require id="" class='form-control'>
        <option value="">PILIH METODE PEMBAYARAN</option>
        <?php
    $qmethod = mysqli_query($con,"Select * from payment_method");
    while($metod = mysqli_fetch_array($qmethod))
    {
        if($metod['nama_payment']=='KAS'){
            ?>
              <option selected value="<?=$metod['nama_payment']?>"><?=$metod['nama_payment']?> / TUNAI</option>
            <?php
        }
        else{
            ?>
        <option value="<?=$metod['nama_payment']?>"><?=$metod['nama_payment']?></option>
            <?php
        }
        ?>
        <?php
    } 
    ?>
    </select>
  <?php
}



function level_user($key=null,$required='required'){
  $array = array('admin'=>'ADMIN','cust'=>'PELANGGAN')
  ?>
   <select name="level" <?=$required?> id="" class='form-control'>
        <option value="">PILIH LEVEL USER</option>
      <?php 
      foreach($array as $r => $val){
        if($key==$r) $sel='selected';
        else  $sel='';
        ?>
        <option <?=$sel?> value="<?=$r?>"><?=$val?></option>
        <?php
      }
      ?>
      <!-- <option value="admin">ADMIN</option> -->
  </select>
  <?php
}

function status($key=null,$required='required'){
  $array = array('aktif'=>'AKTIF','tidakaktif'=>'TIDAK AKTIF')
  ?>
   <select name="status" <?=$required?> id="" class='form-control'>
        <option value="">PILIH STATUS</option>
      <?php 
      foreach($array as $r => $val){
        if($key==$r) $sel='selected';
        else  $sel='';
        ?>
        <option <?=$sel?> value="<?=$r?>"><?=$val?></option>
        <?php
      }
      ?>
      <!-- <option value="admin">ADMIN</option> -->
  </select>
  <?php
}



function paket($id){
  $con = $GLOBALS['con'];
  $q = mysqli_query($con,"select * from paket");
  return mysqli_fetch_array($q);
}