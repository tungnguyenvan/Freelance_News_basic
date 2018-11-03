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

	function getSlide(){
		$slideModel = new SlideModel();
		$slideModel = $slideModel->index();
		return $slideModel;
	}
}

 ?>