<?php include "./config/setting.php" ?>
<?php include "./php/config/function.php" ?>
<?php include"./vendor/autoload.php"; ?>
<?php include "./php/config/koneksi.php" ?>

<?php include "./php/view/header.php"?>
<?php include "./php/view/navbar.php"?>
<?php include "./php/proses/isi.php"?>
<?php


if (!isset($_SESSION['uid'])) {
    $refer = urlencode($_SERVER['HTTP_REFERER']);
    swal('Silahkan Login terlebih dahulu','','warning');
    pindah("login.php?url=$refer");

} 
?>
<?php include "./php/view/end-navbar.php"?>
<?php include "./php/view/footer.php"?>
