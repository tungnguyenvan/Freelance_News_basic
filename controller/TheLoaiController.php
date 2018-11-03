<?php 
include('model/TheLoaiModel.php');
/**
 * 
 */
class TheLoaiController
{
	
	function __construct()
	{
		# code...
	}

	function index(){
		$theLoaiModel = new TheLoaiModel();
		$theLoais = $theLoaiModel->index();

		return $theLoais;
	}
}

 ?>