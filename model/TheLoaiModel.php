<?php 
require_once 'ConnectDatabase.php'; 
/**
 * 
 */
class TheLoaiModel
{
	public $id;
	public $name;
	public $nameUsigned;
	public $createdAt;
	public $updatedAt;
	
	function __construct()
	{
		# code...
	}

	function index(){
		global $connect;
		$sql = "SELECT * FROM theloai";

		$result = mysqli_query($connect, $sql);
		$arr = array();
		if($result){
			while ($row = mysqli_fetch_array($result)){
				$theloai = new TheLoaiModel();
				$theloai->id = $row['id'];
				$theloai->name  = $row['Ten'];
				$theloai->nameUsigned = $row['TenKhongDau'];
				$theloai->createdAt = $row['created_at'];
				$theloai->updatedAt = $row['updated_at'];
				array_push($arr, $theloai);
			}
		}
		return $arr;
	}
}

 ?>