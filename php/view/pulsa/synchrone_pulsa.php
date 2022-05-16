<h1 class="display-4">Produk</h1>
<?php

$cek_produk = $pulsa->konek()->pricelist([
    'type' => 'pulsa'
]);
// print_r($cek_produk);
?>
<table class="table" id="">
    <thead>
        <tr>
            <th>NO</th>
            <th>KODE</th>
            <th>OPERATOR</th>
            <th>NOMINAL</th>
            <th>DETAILS</th>
            <th>HARGA</th>
            <th>TYPE</th>
            <th>MASAAKTIF</th>
            <th>ICON</th>
        </tr>
    </thead>
    <tbody><?php
    echo $cek_produk['data'][0];
        foreach($cek_produk as $produk){
                ?>
                
                 <tr>
                    <td><?=$no++?></td>
                    <td><?=$produk['product_code']?></td>
                    <td><?=$produk['product_description']?></td>
                    <td><?=$produk['product_nominal']?></td>
                    <td><?=$produk['product_details']?></td>
                    <td><?=$produk['product_price']?></td>
                    <td><?=$produk['product_type']?></td>
                    <td><?=$produk['active_period']?></td>
                    <td>
                        <img src="<?=$produk['icon_url']?>" alt="" class="img-thumbnail">
                    </td>
                </tr>
                <?php

        }
        ?>
            
    </tbody>
</table>
