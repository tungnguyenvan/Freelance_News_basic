<?php 
require_once 'ConnectDatabase.php';
/**
 * 
 */
class UserModel
{
	public $id;
	public $name;
	public $email;
	public $password;
	public $createAt;
	public $updateAt;
	
	function __construct()
	{
		# code...
	}

	function login($email, $password){
		global $connect;
		$sql = "SELECT * FROM users WHERE email = \"$email\" AND password = MD5(\"$password\")";
		$result = mysqli_query($connect, $sql);

		$user = new UserModel();
		if ($result) {
			$row = mysqli_fetch_assoc($result);
			$user->id = $row['id'];
			$user->name = $row['name'];
			$user->email = $row['email'];
			$user->password = $password;
			$user->createAt = $row['created_at'];
			$user->updateAt = $row['updated_at'];
			return $user;
		}else{
			return false;
		}

	}

	function store($name, $email, $password){
		global $connect;
		$sql = "INSERT INTO users(name, email, password) VALUES(\"$name\", \"$email\", MD5(\"$password\"))";
		$result = mysqli_query($connect, $sql);

		if ($result) {
			return mysqli_insert_id($connect);
		}else{
			return false;
		}
	}

	function findName($id){
		global $connect;
		$sql = "SELECT * FROM users WHERE id = $id";
		$result = mysqli_query($connect, $sql);

		$user = new UserModel();
		if ($result) {
			$row = mysqli_fetch_assoc($result);
			$user->id = $row['id'];
			$user->name = $row['name'];
			$user->email = $row['email'];
		}

		return $user;
	}
}

?>