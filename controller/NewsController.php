<?php 
include('model/NewsModel.php');
/**
 * 
 */
class NewsController
{
	
	function __construct()
	{
		# code...
	}

	/**
	* function gọi đến model để thực hiện cức năng lưu bài đăng
	*/
	function save($title, $summary, $content, $idLoaiTin, $image){
		$newsModel = new NewsModel();
		$result = $newsModel->save($title, $summary, $content, $idLoaiTin, $image);
		return $result;
	}

	/**
	* function gọi đến model để lấy loại tin
	*/
	function newsFromLoaiTin($idLoaiTin, $possition){
		$newsModel = new NewsModel();
		$result = $newsModel->newsFromLoaiTin($idLoaiTin, $possition);

		return $result;
	}

	/**
	* function gọi đến model để lấy số lượng bài đăng được tìm thấy
	*/
	function total($idLoaiTin){
		$newsModel = new NewsModel();
		$result = $newsModel->toTal($idLoaiTin);

		return $result;
	}

	/**
	* function gọi đến model để tìm kiếm bài đăng
	*/
	function find($id){
		$newsModel = new NewsModel();
		$result = $newsModel->find($id);

		return $result;
	}

	/**
	* function gọi đến model để tìm kiếm bài đăng
	*/
	function findNews($find, $limit){
		$newsModel = new NewsModel();
		$result = $newsModel->findNews($find, $limit);

		return $result;
	}

	/**
	* function gọi đến model để lấy tổng số bài đăng được tìm thấy
	*/
	function totalFindNews($find){
		$newsModel = new NewsModel();
		$result = $newsModel->totalFindNews($find);

		return $result;
	}

	/**
	* function gọi đến model để lấy danh sách nổi bật
	*/
	function newsHighLight(){
		$newsModel = new NewsModel();
		$result = $newsModel->newsHighLight();

		return $result;
	}
}

 ?>