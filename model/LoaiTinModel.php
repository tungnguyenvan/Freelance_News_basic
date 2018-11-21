<?php 
require_once 'ConnectDatabase.php'; 
/**
 * 
 */
class LoaiTinModel
{
	public $id;
	public $idTheLoai;
	public $name;
	public $nameUnsigned;
	public $createAt;
	public $updateAt;
	
	function __construct()
	{
		
	}

	function getAll(){
		global $connect;
		$sql = "SELECT * FROM loaitin";
		$result = mysqli_query($connect, $sql);

		$arr = array();
		if ($result) {
			while ($row = mysqli_fetch_array($result)){
				$loaitin = new LoaiTinModel();
				$loaitin->id = $row['id'];
				$loaitin->idTheLoai = $row['idTheLoai'];
				$loaitin->name = $row['Ten'];
				$loaitin->nameUnsigned = $row['TenKhongDau'];
				$loaitin->createAt = $row['created_at'];
				$loaitin->updateAt = $row['updated_at'];
				array_push($arr, $loaitin);
			}
		}
		return $arr;
	}

	function index($idTheLoai){
		global $connect;
		$sql = "SELECT * FROM loaitin WHERE idTheLoai = $idTheLoai";
		$result = mysqli_query($connect, $sql);

		$arr = array();
		if ($result) {
			while ($row = mysqli_fetch_array($result)){
				$loaitin = new LoaiTinModel();
				$loaitin->id = $row['id'];
				$loaitin->idTheLoai = $row['idTheLoai'];
				$loaitin->name = $row['Ten'];
				$loaitin->nameUnsigned = $row['TenKhongDau'];
				$loaitin->createAt = $row['created_at'];
				$loaitin->updateAt = $row['updated_at'];
				array_push($arr, $loaitin);
			}
		}
		return $arr;
	}

	function find($idLoaiTin){
		global $connect;
		$sql = "SELECT * FROM loaitin WHERE id = $idLoaiTin";
		$result = mysqli_query($connect, $sql);

		$loaitin = new LoaiTinModel();
		if ($result) {
			$row = mysqli_fetch_assoc($result);
			$loaitin->id = $row['id'];
			$loaitin->idTheLoai = $row['idTheLoai'];
			$loaitin->name = $row['Ten'];
			$loaitin->nameUnsigned = $row['TenKhongDau'];
			$loaitin->createAt = $row['created_at'];
			$loaitin->updateAt = $row['updated_at'];
		}
		return $loaitin;
	}
}
 ?>