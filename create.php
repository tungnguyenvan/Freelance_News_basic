<?php 
include ('controller/UserController.php');
include ('controller/LoaiTinController.php');
include ('controller/NewsController.php');

$userController = new UserController();
$loaiTinController = new LoaiTinController();
$news = new NewsController();
   
if (isset($_POST['login'])) {
    $user = $userController->login($_POST['email'], $_POST['password']);
}

if (isset($_POST['upload-news'])) {
    if (isset($_FILES['image'])) {
        if ($_FILES['image']['error'] > 0){
            echo "Lỗi, Bạn cần thêm ảnh cho bài đăng: ";
            echo "<a href=\"javascript:history.go(-1)\">Trở về</a>";
             die();
        }else{
            $name = "image-".date("m-d-Y", time()).".jpg";
            move_uploaded_file($name, "public/image/news".$name);
            $saveNews = $news->save($_POST['title'], $_POST['summary'], $_POST['content'], $_POST['loaitin'], $name);
            if ($saveNews) {
                header('location:index.php');
            }else{
                echo "Đăng tin lỗi, vui lòng thử lại";
                echo "<a href=\"javascript:history.go(-1)\">Trở về</a>";
                die();
            }
        }
    }
}

$loaitins = $loaiTinController->getAll();

if (isset($_POST['logout'])) {
    session_destroy();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Đăng tin</title>

    <!-- Bootstrap Core CSS -->
    <link href="public/css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="public/css/shop-homepage.css" rel="stylesheet">
    <link href="public/css/my.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.public/js/ IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.public/js/ doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.public/js/"></script>
        <script src="https://oss.maxcdn.com/libs/respond.public/js//1.4.2/respond.min.public/js/"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"> Tin Tức</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">Giới thiệu</a>
                    </li>
                    <li>
                        <a href="#">Liên hệ</a>
                    </li>
                </ul>

                <form class="navbar-form navbar-left" role="search" action="timkiem.php" method="GET">
                    <div class="form-group">
                      <input type="text" name="find" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>

			    <ul class="nav navbar-nav pull-right">
                    <?php 
                    if (isset($_SESSION['name'])) {
                        ?>
                        <?php 
                        if (isset($_SESSION['admin'])) {
                        ?>
                        <li>
                            <a href="create.php">Đăng tin</a>
                        </li>
                        <?php
                        }
                        ?>
                        <li>
                            <a>
                                <span class ="glyphicon glyphicon-user"></span>
                                <?=$_SESSION['name']?>
                            </a>
                        </li>

                        <li>
                            <form method="POST" action="#">
                                <button type="submit" name="logout" class="btn btn-success">Đăng xuất</button>
                            </form>
                        </li>
                        <?php
                    }else{
                        ?>
                        <li>
                            <a href="dangky.php">Đăng ký</a>
                        </li>
                        <li>
                            <a href="dangnhap.php">Đăng nhập</a>
                        </li>
                        <?php
                    }
                    ?>
                    
                </ul>
            </div>
            
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
    		<div class="col-md-16"></div>
            <div class="col-md-16">
                <?php 
                    if (isset($_SESSION['user_error'])) {
                         echo "<div class='alert alert-danger'>". $_SESSION['user_error'] . "</div>";
                    }
                ?>
                <div class="panel panel-default">
				  	<div class="panel-heading">Tạo mới</div>
				  	<div class="panel-body">
				    	<form method="POST" action="#" enctype="multipart/form-data">
							<select name="loaitin" class="custom-select custom-select-lg mb-3" required>
                              <option selected value="">Open this select menu</option>
                            <?php 
                                foreach ($loaitins as $loaitin) {
                                    ?>
                                     <option value="<?=$loaitin->id?>"><?=$loaitin->name?></option>
                                    <?php
                                }
                            ?>
                            </select>

                            <div class="custom-file" style="margin-top: 30px; height: 30px">
                              <input type="file" name="image" class="custom-file-input" id="customFile" style="height: 30px" required>
                              <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>

                            <div style="margin-top: 30px">
                                <label>Nhập tiêu đề:</label>
                                <input type="text" name="title" placeholder="tiêu đề" class=" form-control" aria-describedby="basic-addon1" required>
                            </div>

                            <div style="margin-top: 30px">
                                <label>Rút gọn:</label>
                                <input type="text" name="summary" placeholder="rút gọn" class=" form-control" aria-describedby="basic-addon1" required>
                            </div>

                            <div style="margin-top: 30px">
                                <label>Nội dung:</label>
                                <input style="height: 300px; text-align: center;" type="text" name="content" placeholder="Nội dung" class=" form-control" aria-describedby="basic-addon1" required>
                            </div>

                            <button style="margin-top: 30px" name="upload-news" type="submit" class="btn btn-primary btn-lg btn-block">Đăng bài viết</button>
				    	</form>
				  	</div>
				</div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <!-- end slide -->
    </div>
    <!-- end Page Content -->

 
    <!-- end Footer -->
    <!-- jQuery -->
    <script src="public/js//jquery.public/js/"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="public/js//bootstrap.min.public/js/"></script>
    <script src="public/js//my.public/js/"></script>

</body>

</html>
