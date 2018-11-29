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

	/**
	* function gọi đến model để lấy danh sách loại tin
	*/
	function getAll(){
		$loaiTinModel = new LoaiTinModel();	
		$result = $loaiTinModel->getAll();

		return $result;
	}

	/*
	* function gọi model để lấy loại tin dựa vào thể loại
	*/
	function index($idTheLoai){
		$loaiTinModel = new LoaiTinModel();	
		$result = $loaiTinModel->index($idTheLoai);

		return $result;
	}

	/**
	* function gọi model để tìm kiếm loại tin
	*/
	function find($idLoaiTin){
		$loaiTinModel = new LoaiTinModel();
		$result = $loaiTinModel->find($idLoaiTin);

		return $result;
	}
}

 ?>