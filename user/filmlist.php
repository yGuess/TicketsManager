<?php
require_once('../include.php');
$key = isset($_GET['searchWords'])?$_GET['searchWords']:null;
$key = trim($key);
$sql = "select * from films where fName like '%{$key}%'";
$rows = fetchAll($sql);
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
            <form class="navbar-form navbar-left" method="get" action="filmlist.php" name="form">
                <div class="form-group">
                    <input name="searchWords" type="text" class="form-control" placeholder="喜爱的电影，尽在这里！">
                </div>
                <a onclick="javascript:form.submit();"><span class="glyphicon glyphicon-search"></span></a>
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
    <?php foreach($rows as $row):?>
        <div class="media">
            <div class="media-left">
                <a href="#">
                    <img class="media-object" src="<?php echo $row['imgPath'];?>">
                </a>
                <a href="film.php?fId=<?php echo $row['id'];?>" role="button" class="btn btn-info">购票</a>
            </div>
            <div class="media-body">
                <h4 class="media-heading"><a href="film.php?fId=<?php echo $row['id'];?>"><?php echo $row['fName'];?></a></h4>
                <p>类型：<?php echo $row['fType'];?></p>
                <p>片长/语言：<?php echo $row['fDuration'].'分钟/'.$row['fLanguage'];?></p>
                <p>导演：<?php echo $row['fDirector'];?></p>
                <p>演员：<?php echo $row['fActors'];?></p>
            </div>
        </div>
    <?php endforeach;?>
</div>
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../bower_components/bootstrap/js/carousel.js"></script>
<script src="../js/js.js"></script>
</body>
</html>