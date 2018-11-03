<?php 
require_once 'ConnectDatabase.php';
/**
 * 
 */
class CommentModel
{
	public $id;
	public $idUser;
	public $idNews;
	public $content;
	public $createAt;
	public $updateAt;
	
	function __construct()
	{
		# code...
	}

	function index($idNews){
		global $connect;
		$sql = "SELECT * FROM comment WHERE idTinTuc = $idNews ORDER BY id DESC";
		$result = mysqli_query($connect, $sql);

		$arr = array();
		if ($result) {
			while ($row = mysqli_fetch_array($result)){
				$comment = new CommentModel();
				$comment->id = $row['id'];
				$comment->idUser = $row['idUser'];
				$comment->idNews = $row['idTinTuc'];
				$comment->content = $row['NoiDung'];
				$comment->createAt = $row['created_at'];
				$comment->updateAt = $row['updated_at'];
				array_push($arr, $comment);
			}
		}

		return $arr;
	}

	function store($idUser, $idNews, $content){
		global $connect;
		$sql = "INSERT INTO comment(idUser, idTinTuc, NoiDung, created_at) VALUES ($idUser, $idNews, \"$content\", NOW())";
		$result = mysqli_query($connect, $sql);

		if ($result) {
			return true;
		}else{
			return false;
		}
	}
}

?>