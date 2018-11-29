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

	/**
	* function lưu bài đăng mới vào cơ sở dữ liệu
	*/
	function save($title, $summary, $content, $idLoaiTin, $image){
		global $connect;
		$sql = "INSERT INTO tintuc(TieuDe, TomTat, NoiDung, idLoaiTin, Hinh) VALUES(\"$title\" , \"$summary\", \"$content\" , $idLoaiTin, \"$image\")";
		$result = mysqli_query($connect, $sql);

		return $result;
	}

	/**
	* function lấy danh sách bài đăng dựa vào loại tin
	*/
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

	/**
	* function tính tổng số cá bao nhiêu bài đăng dựa vào loại tin
	*/
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

	/**
	* function tìm kiếm bài đăng
	*/
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

	/**
	* function đếm tổng số bài đăng có trên cơ sở dữ liệu dựa vào kết quả tìm kiếm được
	*/
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

	/**
	* function lấy bài đăng nổi bật
	*/
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