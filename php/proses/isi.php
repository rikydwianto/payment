<div class='table-responsive'>

<?php 
if(isset($_GET['menu'])){
    $halaman = $_GET['menu'];
   @ $sub = $_GET['sub'];
    $menu_al = $url."?menu=".$halaman."&sub=$sub&";
    $path = "./php/view/$halaman/index.php";
    if(file_exists($path)){
        include"$path";
    }
    else{
        swal('halaman tidak ditemukan','warning','HALAMAN TIDAK DITEMUKAN');
        pindah("404.php");
    }
}
else{
    ?>
    <h3>Halaman Awal ...</h3>
    <?php
}
?>

</div>