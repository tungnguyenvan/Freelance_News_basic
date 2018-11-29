<?php 
include ('model/CommentModel.php');
/**
 * 
 */
class CommentController
{
	
	function __construct()
	{
		# code...
	}

	/**
	* function gọi đến model để lấy các comment
	*/
	function index($idNews){
		$commentModel = new CommentModel();
		$result = $commentModel->index($idNews);

		return $result;
	}

	/**
	* function gọi đến model để lưu bài đăng
	*/
	function store($idUser, $idNews, $content){
		$commentModel = new CommentModel();
		$result = $commentModel->store($idUser, $idNews, $content);

		return $result;
	}
}

?>