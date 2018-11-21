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

	function save($title, $summary, $content, $idLoaiTin, $image){
		$newsModel = new NewsModel();
		$result = $newsModel->save($title, $summary, $content, $idLoaiTin, $image);
		return $result;
	}

	function newsFromLoaiTin($idLoaiTin, $possition){
		$newsModel = new NewsModel();
		$result = $newsModel->newsFromLoaiTin($idLoaiTin, $possition);

		return $result;
	}

	function total($idLoaiTin){
		$newsModel = new NewsModel();
		$result = $newsModel->toTal($idLoaiTin);

		return $result;
	}

	function find($id){
		$newsModel = new NewsModel();
		$result = $newsModel->find($id);

		return $result;
	}

	function findNews($find, $limit){
		$newsModel = new NewsModel();
		$result = $newsModel->findNews($find, $limit);

		return $result;
	}

	function totalFindNews($find){
		$newsModel = new NewsModel();
		$result = $newsModel->totalFindNews($find);

		return $result;
	}

	function newsHighLight(){
		$newsModel = new NewsModel();
		$result = $newsModel->newsHighLight();

		return $result;
	}
}

 ?>