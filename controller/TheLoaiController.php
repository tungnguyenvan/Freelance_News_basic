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

	/**
	* function gọi đến model để lấy tất cả thể loại
	*/
	function index(){
		$theLoaiModel = new TheLoaiModel();
		$theLoais = $theLoaiModel->index();

		return $theLoais;
	}
}

 ?>