<?php
require_once 'ConnectDatabase.php'; 
/**
 * 
 */
class SlideModel
{
	public $id;
	public $name;
	public $image;
	public $link;
	public $createAt;
	public $updateAt;
	
	function __construct()
	{
		# code...
	}

	/**
	* function lấy 3 hình ảnh đầu tiên có trên cơ sở dữ liệu
	*/
	function index(){
		global $connect;
		$sql = "SELECT * FROM slide limit 3 GROUP BY id DESC";
		$result = mysqli_query($connect, $sql);

		$arrResult = array();
		if ($result) {
			while ($row = mysqli_fetch_array($result)){
				$slide = new SlideModel();
				$slide->id = $row['id'];
				$slide->name = $row['Ten'];
				$slide->image = $row['Hinh'];
				$slide->link = $row['link'];
				$slide->createAt = $row['created_at'];
				$slide->updateAt = $row['updated_at'];

				array_push($arrResult, $slide);
			}
		}

		return $arrResult;
	}
}

 ?>