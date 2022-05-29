<?php 
if(isset($_SESSION['uid'])){
    ?>
<li>
    <a href="<?=menu('home')?>" class="waves-effect"><i class="ti-home fa-fw"></i> Dashboard</a>
</li>
<li>
    <a href="<?=$url.$menu?>cashir" class="waves-effect"><i class="ti-shopping-cart-full fa-fw"></i>KASIR</a>
</li>
<li>
    <a href="<?=$url.$menu?>pembayaran" class="waves-effect"><i class="ti-money fa-fw"></i>Pembayaran</a>
</li>
<li>
    <a href="<?=$url.$menu?>wifi" class="waves-effect"><i class="glyphicon glyphicon-fire fa-fw"></i>
        PAKET</a>
</li>
<li>
    <a href="<?=$url.$menu?>kredit" class="waves-effect"><i class="ti-money glyphicon-fire fa-fw"></i>
        Kredit</a>
</li>
<li>
    <a href="<?=$url.$menu?>pelanggan" class="waves-effect"><i class="ti-user fa-fw"></i>Pelanggan</a>
</li>
<li>
    <a href="<?=$url.$menu?>barang" class="waves-effect"><i class="ti-truck fa-fw"></i>Barang</a>
</li>
<li>
    <a href="<?=$url.$menu?>pulsa" class="waves-effect"><i class="ti-handphone fa-fw"></i>Produk Digital</a>
</li>

<li>
    <a href="<?=$url.$menu?>kas" class="waves-effect"><i class="ti-face-smile fa-fw"></i> Arus Kas</a>
</li>
<li>
    <a href="<?=$url.$menu?>kas&sub=tambah" class="waves-effect"><i class="ti-plus fa-fw"></i> Tambah Kas</a>
</li>
<!-- <li>
    <a href="map-google.html" class="waves-effect"><i class="ti-location-pin fa-fw"></i> Google
        Map</a>
</li>
<li>
    <a href="blank.html" class="waves-effect"><i class="ti-files fa-fw"></i> Blank Page</a>
</li>
<li>
    <a href="404.html" class="waves-effect"><i class="ti-info fa-fw"></i> Error 404</a>
</li> -->
<li>
    <a href="<?=$url."logout.php"?>" class="waves-effect"><i class="ti-shift-left fa-fw"></i> Logout</a>
</li>
    <?php
}
else{
    
}
?>
