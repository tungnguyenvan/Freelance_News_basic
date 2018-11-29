<?php 

/**
 * 
 */

include('model/SlideModel.php');

class SlideController
{
	
	function __construct()
	{
		# code...
	}

	/**
	* function gọi đến model để lấy ảnh ở slide
	*/
	function getSlide(){
		$slideModel = new SlideModel();
		$slideModel = $slideModel->index();
		return $slideModel;
	}
}

 ?>