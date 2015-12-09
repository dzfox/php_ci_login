<?php
class Baza extends ci_Model{
	public $connect;

	/*----------------------------------------------------------------------------------------------------------------------------------------------*/
	public function __construct(){
                parent::__construct();
    }
	/*----------------------------------------------------------------------------------------------------------------------------------------------*/
	public	function konektujNaServer () 
			{
			global $connect,$db_podaci;
			$db_podaci= array('db_server'=>'localhost','db_user'=>'root','db_pass'=>'','db_name'=>'login');
			$connect=mysqli_connect($db_podaci['db_server'],$db_podaci['db_user'],$db_podaci['db_pass']);
			
			if (!$connect) {
				die ('<font color="red">Konekcija na bazu nije uspela!</font>'.mysqli_connect_error());
			}
			mysqli_select_db($connect, $db_podaci['db_name']);
			
			return ('Uspesno');
				
		}
	/*----------------------------------------------------------------------------------------------------------------------------------------------*/
	public	function insertSQL ($sql){	
			global $connect;
			$this->konektujNaServer();
			return mysqli_query($connect, $sql);
		}
	/*----------------------------------------------------------------------------------------------------------------------------------------------*/
	public	function findAll($ime_tabele){	
			global $connect;
			$this->konektujNaServer();
			$sql="SELECT * FROM `$ime_tabele`";
			$res=$this->insertSQL($sql);
			while ($array=mysqli_fetch_array($res)) {
				$array1[]=$array;
			}
			
			if(!isset($array1)){
				$array_res=array();	
			}else{
				foreach ($array1 as $redniBr => $podaci) {
					foreach ($podaci as $kolona => $value) {
						$ascii_key=ord($kolona);
						if ($ascii_key<48 or $ascii_key>57) {
							$array_res[$redniBr][$kolona]=$value;
						}
					}
				}
			}
			
			return $array_res;
		}
	/*----------------------------------------------------------------------------------------------------------------------------------------------*/
	public	function findByAttribute($ime_tabele, $atributi){
			global $connect;
			$this->konektujNaServer();
			$sql="SELECT `$atributi` FROM `$ime_tabele`";
			$res=$this->insertSQL($sql);
			while ($array=mysqli_fetch_array($res)) {
				$array_res[]=$array[$atributi];
			}

			is_null($array)?$array_res="":"";

			return $array_res;
		}
	/*----------------------------------------------------------------------------------------------------------------------------------------------*/
	public	function findByPrimaryKey($ime_tabele, $primaryKey){
			global $connect;
			$this->konektujNaServer();
			$sql="SELECT * FROM `$ime_tabele` WHERE id=$primaryKey";
			$res=$this->insertSQL($sql);
			$array_res=mysqli_fetch_row($res);
			
			return $array_res;	
		}
	/*----------------------------------------------------------------------------------------------------------------------------------------------*/
	public	function updateByPrimaryKey($ime_tabele, $primaryKey, $izmene){
			global $connect;
			$this->konektujNaServer();
			$sql="UPDATE `$ime_tabele` SET $izmene WHERE id=$primaryKey";
			return $this->insertSQL($sql);
		}
	/*----------------------------------------------------------------------------------------------------------------------------------------------*/
	public	function deleteByPrimaryKey($ime_tabele, $primaryKey){
			global $connect;
			$this->konektujNaServer();
			$sql="DELETE FROM `$ime_tabele` WHERE id=$primaryKey";
			return $this->insertSQL($sql);
		}
	/*----------------------------------------------------------------------------------------------------------------------------------------------*/
	public	function deleteAllData($ime_tabele){
			global $connect;
			$this->konektujNaServer();
			$sql="TRUNCATE TABLE `$ime_tabele`";
			return $this->insertSQL($sql);
		}
}