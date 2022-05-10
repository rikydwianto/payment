<?php function load($folder,$param){
    include("php/$folder/$param.php");

}
function pindah($url){
    ?>
    <script>
        window.location.href="<?=$url?>";
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