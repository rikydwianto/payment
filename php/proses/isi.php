<?php 

// echo dd($doa);
use GuzzleHttp\Client;
$connected = @fsockopen("www.google.com", 80);
if(!$connected){
    echo"Tidak terhubung ke inet";
}
else{
    $client = new Client([
        'base_uri'=>'https://doa-doa-api-ahmadramadhan.fly.dev',
        'time_out'=>2
    ]);
    $respon = $client->request('GET','api/doa/v1/random');
    $respon = $respon->getBody();
    $doa = json_decode($respon,true);
    ?>
    <small style="font-size: 12px;">

<b></b> <?=$doa[0]['doa']?> | <b>Ayat</b> : <?=$doa[0]['ayat']?> <br>
<b>Arti</b> : <?=$doa[0]['artinya']?>      <b>latin</b> <?=$doa[0]['latin']?>
</small>
    <?php
}
?>

</div>
</div>
<div class="col-md-12">
    <div class="white-box">
<div class='table-responsive'>

<?php 
$uid = $_SESSION['uid'];
if(isset($_GET['menu'])){
    $halaman = $_GET['menu'];
   @ $sub = $_GET['sub'];
    $menu_al = $url."?menu=".$halaman."&sub=$sub&";
    $path = "./php/view/$halaman/index.php";
    if(file_exists($path)){
        include"$path";
    }
    else{
        swal('halaman tidak ditemukan','HALAMAN TIDAK DITEMUKAN','warning');
        pindah("404.php");
    }
}
else{
    include"./php/view/halamanawal.php";
}
?>

</div>