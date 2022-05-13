<?php function load($folder,$param){
    include("php/$folder/$param.php");

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

function swal($isi,$warna='success',$title=null){
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