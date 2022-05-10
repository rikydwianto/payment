function fetchAll($con,$query){
    $cek = mysqli_query($con,"$query");
    return mysqli_fetch_array($cek);
}