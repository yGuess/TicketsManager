<?php
require_once('../include.php');
$getId = $_GET['fId'];
$sql = "select * from films where id='$getId'";
$row = fetchOne($sql);
$user = $_SESSION['userId']?$_SESSION['userId']:$_COOKIE['userId'];
if(!$user){
    $user = -1;
}
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title></title>
</head>
<body>
<!-- 导航栏 -->
<nav class="navbar navbar-default">
    <div class="nav-wrap">
        <!-- 导航栏简略显示 -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">电影购票</a>
        </div>
        <!-- 简略显示结束 -->
        <!-- 导航栏正常显示 -->
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">首页 <span class="sr-only">(current)</span></a></li>
                <li><a href="#">近期上映</a></li>
            </ul>
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="喜爱的电影，尽在这里！">
                </div>
                <a href="#"><span class="glyphicon glyphicon-search"></span></a>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <?php
                //session_start();
                if(isset($_SESSION['userName'])){
                    echo "<li><a href='personal.php'>{$_SESSION['userName']}</a></li>";
                    echo "<li><a href='doUserAction.php?act=logout'>退出</a></li>";
                }elseif(isset($_COOKIE['userName'])){
                    echo "<li><a href='personal.php'>{$_COOKIE['userName']}</a></li>";
                    echo "<li><a href='doUserAction.php?act=logout'>退出</a></li>";
                }else{
                    echo "<li><a href='login.php'>登陆</a></li>";
                    echo "<li><a href='login.php'>注册</a></li>";
                }
                ?>
            </ul>
        </div>
        <!-- 导航栏正常显示结束 -->
    </div>
</nav>
<!-- 导航栏结束 -->
<div class="main">
    <div class="jumbotron">
        <img src="<?php echo $row['imgPath']?>"/>
    </div>
    <div class="col-md-12">
        <div class="film-info col-md-8">
            <p>上映日期：2016-05-06</p>
            <p>导演：<?php echo $row['fDirector'];?></p>
            <p>演员：<?php echo $row['fActors'];?></p>
            <p>类型：<?php echo $row['fType'];?></p>
            <p>地区：<?php echo $row['fArea'];?></p>
            <p>片长：<?php echo $row['fDuration'];?>分钟</p>
        </div>
        <div class="about-ticket col-md-4">
            <p>剩余票数：<?php echo $row['fCounts'];?></p>
            <form method="post" action="dealOrders.php">
                <div class="input-group">
                    <input type="hidden" name="userId" value="<?php echo $user?>">
                    <input type="hidden" name="filmId" value="<?php echo $row['id'];?>">
                    <input type="number" name="tickets" class="form-control" aria-label="Amount" max="10" step="1" min="1">
                    <span class="input-group-addon">张</span>
                </div>
                <input class="btn btn-info" value="购票" type="submit"/>
            </form>
        </div>
        <div style="clear: both">
            <h4>影片剧情</h4>
            <p>
               <?php echo $row['description'];?>
            </p>
        </div>
    </div>
</div>
<div class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">添加新的电影</h4>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" onclick="addFilm(e)">添加</button>
            </div>
        </div>
    </div>
</div>


<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../bower_components/bootstrap/js/carousel.js"></script>
<script src="../js/js.js"></script>
<script>
    function addFilm(e){

    }
</script>
</body>
</html>