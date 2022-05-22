<h1 class="display-1">Sedang menyetujui ...</h1>
<?php 
$id = aman(de($_GET['id']));
$qlist= mysqli_query($con,"SELECT p.*, u.nama from pembiayaan p join tb_user u on u.id_user=p.id_user join paket pk on pk.id_paket=p.id_paket 
where p.id_usaha='$id_usaha' and p.id_pembiayaan='$id' ");
$hapus = mysqli_query($con,"update  pembiayaan set status='disetujui' where id_pembiayaan='$id'");
$id_kas =$id;
if($hapus){
    $pemb = mysqli_fetch_array($qlist);
    mysqli_query($con,"INSERT into `kas`(akun,keterangan,keluar,status,payment_method,tanggal_kas,id_usaha)
                values('101','KAS - Relisasi an $pemb[nama]','$pemb[pembiayaan]','kredit','KAS','$pemb[tgl_pembiayaan]','$id_usaha');
                ");
    mysqli_query($con,"INSERT into `jurnal`(akun,keterangan,keluar,status,payment_method,tanggal_kas,id_usaha,refrensi,urutan)
                values('101','KAS','$pemb[pembiayaan]','kredit','KAS','$pemb[tgl_pembiayaan]','$id_usaha','$pemb[kode_pembiayaan]','2');
                ");
    mysqli_query($con,"INSERT into `jurnal`(akun,keterangan,masuk,status,payment_method,tanggal_kas,id_usaha,refrensi,urutan)
    values('1031','Relisasi an $pemb[nama]','$pemb[pembiayaan]','debit','KAS','$pemb[tgl_pembiayaan]','$id_usaha','$pemb[kode_pembiayaan]','1');
    ");
    swal("APPROVED");
    pindah(menu('kredit','list'));
}
else{
$erro = htmlentities(mysqli_error($con));
swal("Gagal dihapus, Error : $erro",'GAGAL',"warning");

}
?>