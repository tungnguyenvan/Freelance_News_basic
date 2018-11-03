<?php 
include('model/LoaiTinModel.php');
/**
 * 
 */
class LoaiTinController
{
	public $loaiTinModel;
	
	function __construct()
	{
		
	}

	function index($idTheLoai){
		$loaiTinModel = new LoaiTinModel();
		$result = $loaiTinModel->index($idTheLoai);

		return $result;
	}

	function find($idLoaiTin){
		$loaiTinModel = new LoaiTinModel();
		$result = $loaiTinModel->find($idLoaiTin);

		return $result;
	}
}

 ?>