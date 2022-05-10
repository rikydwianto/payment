<?php 
if(isset($_GET['menu'])){
    $halaman = $_GET['menu'];
    if($halaman=='wifi'){

    }
    else{
        pindah("404.php");
    }
}
else{
    ?>
    <h3>Halaman Awal ...</h3>
    <?php
}
?>
