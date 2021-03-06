<?php 
session_start();
include ('controller/NewsController.php');
include ('controller/TheLoaiController.php');
include ('controller/LoaiTinController.php');

$find = $_GET['find'];
$page = 0;
if (isset($_GET['page'])) {
    if ($_GET['page'] != 1) {
        $page = $_GET['page'] * 10 - 10;  
    }else{
        $page = $_GET['page'] - 1;
    }
}

$newsController = new NewsController();
$news = $newsController->findNews($find, $page);
$total = $newsController->totalFindNews($find);

$theLoaiController = new TheLoaiController();
$theloais = $theLoaiController->index();

$loaiTinController = new LoaiTinController();

if (isset($_POST['logout'])) {
    session_destroy();
    header("location:timkiem.php?find=" . $find);
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

    <title>Tin tức</title>

    <!-- Bootstrap Core CSS -->
    <link href="public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="public/css/shop-homepage.css" rel="stylesheet">
    <link href="public/css/my.css" rel="stylesheet">

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
        <div class="row">
            <div class="col-md-3 ">
                <ul class="list-group" id="menu">
                    <li href="#" class="list-group-item menu1 active">
                        Menu
                    </li>
                    <?php 

                        foreach ($theloais as $theloai) {
                            echo '<li href="#" class="list-group-item menu1">
                                        '. $theloai->name .'
                                    </li>';

                            $loaitins = $loaiTinController->index($theloai->id);
                            echo "<ul>";
                            foreach ($loaitins as $loaitin) {
                                ?>
                                <li class="list-group-item">
                                    <a href="loaitin.php?idloaitin=<?=$loaitin->id?>"><?=$loaitin->name?></a>
                                </li>
                                <?php
                            }
                            echo "</ul>";
                        }
                    ?>
                </ul>
            </div>

            <div class="col-md-9 ">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h4><b>Tìm được <?=$total?> Kết quả cho "<?=$find?>"</b></h4>
                    </div>

                    <?php 
                    foreach ($news as $new) {?>
                        <div class="row-item row">
                        <div class="col-md-3">

                            <a href="chitiet.php">
                                <br>
                                <img width="200px" height="200px" class="img-responsive" src="public/image/news/<?=$new->image?>" alt="">
                            </a>
                        </div>

                        <div class="col-md-9">
                            <h3><?=$new->title?></h3>
                            <p><?=$new->summary?></p>
                            <a class="btn btn-primary" href="chitiet.php?idnews=<?=$new->id?>">View Project <span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                        <div class="break"></div>
                    </div>
                    <?php
                    }

                    ?>


                    <!-- Pagination -->
                    <div class="row text-center">
                        <div class="col-lg-12">
                            <ul class="pagination">
                                <?php 
                                    $num = $total / 10;

                                    for ($i=0; $i < $num; $i++) { 
                                        if ($i == $page/10) {
                                        ?>
                                        <li class="active">
                                            <a href="timkiem.php?find=<?=$find?>&page=<?=$i + 1?>"><?=$i + 1?></a>
                                        </li>
                                        <?php
                                        }else{
                                        ?>
                                        <li class="">
                                            <a href="timkiem.php?find=<?=$find?>&page=<?=$i + 1?>"><?=$i + 1?></a>
                                        </li>
                                        <?php
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
            </div> 

        </div>

    </div>
    <!-- end Page Content -->

    <!-- Footer -->
    <hr>
    <footer>
        <div class="row">
            <div class="col-md-12">
                <p>Copyright &copy; Your Website 2014</p>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
    <!-- jQuery -->
    <script src="public/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/my.js"></script>

</body>

</html>
