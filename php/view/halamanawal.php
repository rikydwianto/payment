
<h3>Hallo, <?=$user_detail['nama']?> ... <br> Selamat datang di halaman admin usaha <?=$user_detail['nama_usaha']?></h3>


</div>
</div>
<?php 
$qkas = mysqli_query($con,"SELECT count(*) hitung_trx,SUM(masuk) AS masuk, SUM(keluar) AS keluar, SUM(masuk)   - SUM(keluar) AS total FROM kas where id_usaha='$id_usaha'");
$kas = mysqli_fetch_array($qkas);
$total = $kas['total'];
$masuk = $kas['masuk'];
$keluar = $kas['keluar'];
$trx = $kas['hitung_trx'];

$qclient = mysqli_query($con,"SELECT count(*) as client from tb_user where id_usaha='$id_usaha' and level='cust'");
$client = mysqli_fetch_array($qclient);
?>
<div class="col-md-12 col-lg-12 col-sm-12">
    <div class="white-box">
        <div class="row row-in">
            <div class="col-lg-4 col-sm-6">
                <div class="col-in text-center">
                    <h5 class="text-danger">KAS</h5>
                    <h3 class="counter"><?=uang($total,'ya')?></h3>
                </div>
            </div>
           
            <div class="col-lg-4 col-sm-6">
                <div class="col-in text-center">
                    <h5 class="text-muted text-purple">Total Transaksi</h5>
                    <h3 class="counter"><?=uang($trx)?></h3>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="col-in text-center b-r-none">
                    <h5 class="text-muted text-warning">Client</h5>
                    <h3 class="counter"><?=uang($client['client'])?></h3>
                </div>
            </div>
            <!-- <div class="col-lg-4 col-sm-6">
                <div class="col-in text-center b-0">
                    <h5 class="text-info">Explorer</h5>
                    <h3 class="counter">2500</h3>
                </div>
            </div> -->
        </div>
      
    </div>
</div>
<!-- <div class="col-md-3 col-xs-12">
      <div class="white-box">
          <div class="user-bg"> 
              <div class="overlay-box">
                  <div class="user-content">
                      <a href="javascript:void(0)"></a>
                      <h2 class="text-white"><i class='ti-money'></i> INFO KAS </h2>
                      <h3 class="text-white"><?=uang($total,'ya')?></h3>
                  </div>
              </div>
          </div>
          <div class="user-btm-box">
              <div class="col-md-6 col-sm-4 text-center">
                  <p class="text-purple"><i class="ti-shift-right"></i></p>
                  <h3><?=uang($masuk,'tidak')?></h3>
              </div>
              <div class="col-md-6 col-sm-4 text-center">
                  <p class="text-blue"><i class="ti-shift-left"></i></p>
                  <h3><?=uang($keluar,'tidak')?></h3>
              </div>

          </div>
      </div>
  </div> -->