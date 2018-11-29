<?php 
session_start();
include ('model/UserModel.php');
/**
 * 
 */
class UserController
{
	
	function __construct()
	{
		# code...
	}

	/**
	* function gọi đến model để login, nếu login thành công thì quay về trang index
	* còn không sẽ thông bào bằng lưu lại trạng thái thất bại bằng session
	*/
	function login($email, $password){
		$userModel = new UserModel();
		$result = $userModel->login($email, $password);

		if ($result) {
			$_SESSION['name'] = $result->name;
			header('location:index.php');
			$_SESSION['id_user'] = $result->id;
			if ($result->type == 1) {
				$_SESSION['admin'] = true;
			}
			if (isset($_SESSION['user_error'])) {
				unset($_SESSION['user_error']);
			}
		}else{
			$_SESSION['user_error'] = "Đăng nhập thất bại";
			header("location:dangnhap.php");
		}
	}

	/**
	* function gọi đến model để đăng ký người dùng mới
	*/
	function store($name, $email, $password){
		$userModel = new UserModel();
		$result = $userModel->store($name, $email, $password);

		if ($result > 0) {
			$_SESSION['success'] = "Đăng ký thành công";
			header("location:index.php");
			if (isset($_SESSION['error'])) {
				unset($_SESSION['error']);
			}
		}else{
			$_SESSION['error'] = "Đăng ký không thành công";
			header("location:dangky.php");
		}
	}

	/**
	* function gọi đến model để tìm kiếm tên người dùng dựa vào id
	*/
	function findName($id){
		$userModel = new UserModel();
		$result = $userModel->findName($id);

		return $result;
	}
}

?>