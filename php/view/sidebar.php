<?php 
if(isset($_SESSION['uid'])){
    ?>
<li>
    <a href="<?=$url.$menu?>pembayaran" class="waves-effect"><i class="ti-money fa-fw"></i>Pembayaran</a>
</li>
<li>
    <a href="<?=$url.$menu?>wifi" class="waves-effect"><i class="glyphicon glyphicon-fire fa-fw"></i>
        WIFI</a>
</li>
<li>
    <a href="<?=$url.$menu?>pelanggan" class="waves-effect"><i class="ti-user fa-fw"></i>Pelanggan</a>
</li>

<li>
    <a href="<?=$url.$menu?>kas" class="waves-effect"><i class="ti-face-smile fa-fw"></i> Arus Kas</a>
</li>
<li>
    <a href="map-google.html" class="waves-effect"><i class="ti-location-pin fa-fw"></i> Google
        Map</a>
</li>
<li>
    <a href="blank.html" class="waves-effect"><i class="ti-files fa-fw"></i> Blank Page</a>
</li>
<li>
    <a href="404.html" class="waves-effect"><i class="ti-info fa-fw"></i> Error 404</a>
</li>
    <?php
}
else{
    
}
?>
