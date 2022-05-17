<?php  

class DB{
    private $query = null;
    function __construct(){
		$this->db = $GLOBALS['con'];
		if($this->db){
			// echo "Koneksi database berhasil.";
		}else{
			echo "Koneksi database  GAGAL !";
		}
	}
    function query($q){
        $this->query = mysqli_query($this->db,"$q");
        return $this->query;
    }

    function fetchAll(){
        $this->query = mysqli_fetch_array($this->query);
        return $this->query;
    }
    function usaha($id=null){
        $fil="";
        if($id!=null){
            $fil = "where id_usaha='$id'";
        }
        
        $q = $this->query("select * from usaha $fil");
        return $this->fetchAll();
    }

}

$db = new DB;