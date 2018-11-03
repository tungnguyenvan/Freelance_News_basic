<?php 
/**
 * 
 */

require_once 'ConnectDatabase.php';

class NewsModel
{
	public $id;
	public $title;
	public $titleUnsign;
	public $summary;
	public $content;
	public $image;
	public $view;
	public $idLoaiTin;
	public $createdAt;
	public $updatedAt;

	
	function __construct()
	{
		# code...
	}

	function newsFromLoaiTin($idLoaiTin, $possition){
		global $connect;
		$sql = "SELECT * FROM tintuc WHERE idLoaiTin = $idLoaiTin ORDER BY id DESC limit $possition, 10";
		$result = mysqli_query($connect, $sql);

		$arr = array();
		if ($result) {
			while ($row = mysqli_fetch_array($result)){
				$news = new NewsModel();
				$news->id = $row['id'];
				$news->title = $row['TieuDe'];
				$news->titleUnsign = $row['TieuDeKhongDau'];
				$news->summary = $row['TomTat'];
				$news->content = $row['NoiDung'];
				$news->image = $row['Hinh'];
				$news->view = $row['SoLuotXem'];
				$news->idLoaiTin = $row['idLoaiTin'];
				$news->createdAt = $row['created_at'];
				$news->updatedAt = $row['updated_at'];

				array_push($arr, $news);
			}
		}
		return $arr;
	}

	function toTal($idLoaiTin){
		global $connect;
		$sql = "SELECT COUNT(id) as total FROM tintuc WHERE idLoaiTin = $idLoaiTin ORDER BY id DESC";
		$result = mysqli_query($connect, $sql);
		$toTal = 0;
		if ($result) {
			$row = mysqli_fetch_assoc($result);
			$total = $row['total'];
		}
		return $total;
	}

	function find($id){
		global $connect;
		$sql = "SELECT * FROM tintuc WHERE id = $id";
		$result = mysqli_query($connect, $sql);
		$news = new NewsModel();
		if ($result) {
			$row = mysqli_fetch_assoc($result);
			$news->id = $row['id'];
			$news->title = $row['TieuDe'];
			$news->titleUnsign = $row['TieuDeKhongDau'];
			$news->summary = $row['TomTat'];
			$news->content = $row['NoiDung'];
			$news->image = $row['Hinh'];
			$news->view = $row['SoLuotXem'];
			$news->idLoaiTin = $row['idLoaiTin'];
			$news->createdAt = $row['created_at'];
			$news->updatedAt = $row['updated_at'];
		}

		return $news;
	}

	function findNews($find, $limit){
		global $connect;
		$sql = "SELECT * FROM tintuc WHERE TieuDe LIKE \"%$find%\" OR TomTat LIKE \"%$find%\" ORDER BY id DESC limit $limit,10";
		$result = mysqli_query($connect, $sql);

		$arr = array();
		if ($result) {
			while ($row = mysqli_fetch_array($result)){
				$news = new NewsModel();
				$news->id = $row['id'];
				$news->title = $row['TieuDe'];
				$news->titleUnsign = $row['TieuDeKhongDau'];
				$news->summary = $row['TomTat'];
				$news->content = $row['NoiDung'];
				$news->image = $row['Hinh'];
				$news->view = $row['SoLuotXem'];
				$news->idLoaiTin = $row['idLoaiTin'];
				$news->createdAt = $row['created_at'];
				$news->updatedAt = $row['updated_at'];

				array_push($arr, $news);
			}
		}
		return $arr;
	}

	function totalFindNews($find){
		global $connect;
		$sql = "SELECT COUNT(id) as total FROM tintuc WHERE TieuDe LIKE \"%$find%\" OR TomTat LIKE \"%$find%\"";
		$result = mysqli_query($connect, $sql);

		$toTal = 0;
		if ($result) {
			$row = mysqli_fetch_assoc($result);
			$total = $row['total'];
		}
		return $total;
	}

	function newsHighLight(){
		global $connect;
		$sql = "SELECT * FROM tintuc ORDER BY SoLuotXem DESC limit 0,4";
		$result = mysqli_query($connect, $sql);

		$arr = array();
		if ($result) {
			while ($row = mysqli_fetch_array($result)){
				$news = new NewsModel();
				$news->id = $row['id'];
				$news->title = $row['TieuDe'];
				$news->titleUnsign = $row['TieuDeKhongDau'];
				$news->summary = $row['TomTat'];
				$news->content = $row['NoiDung'];
				$news->image = $row['Hinh'];
				$news->view = $row['SoLuotXem'];
				$news->idLoaiTin = $row['idLoaiTin'];
				$news->createdAt = $row['created_at'];
				$news->updatedAt = $row['updated_at'];

				array_push($arr, $news);
			}
		}
		return $arr;
	}
}

 ?>