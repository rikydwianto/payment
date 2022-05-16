<?php 
$saldo = $pulsa->konek()->checkBalance()['data']['balance'];
?>
<h1 class='display-1'>Saldo MOBILE PULSA : <?=uang($saldo,'ya')?></h1>
<hr>
