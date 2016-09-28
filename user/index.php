<?php
require_once('../include.php');
$sql = "select id,imgPath from films limit 0,12";
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

<div class="main clearfix">
    <!-- 电影推荐 -->
    <div class="col-md-12">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="../images/c1.jpg" class="img-responsive"/>
                    <div class="carousel-caption">
                        <h3>X战警：天启</h3>
                        <p>变种人战争全面爆发 人类命运危在旦夕</p>
                    </div>
                </div>
                <div class="item">
                    <img src="../images/c2.jpg" class="img-responsive">
                    <div class="carousel-caption">
                        <h3>魔兽</h3>
                        <p>杜隆坦痛殴古尔丹 魔法场面宏大</p>
                    </div>
                </div>
                <div class="item">
                    <img src="../images/c3.jpg" class="img-responsive">
                    <div class="carousel-caption">
                        <h3>美国队长3</h3>
                        <p>美队VS钢铁侠 漫威新史诗诞生</p>
                    </div>
                </div>
            </div>
        </div>

        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- 电影推荐结束 -->

    <!-- 电影展示 -->
    <div class="col-md-12">
        <?php foreach($rows as $row): ?>
            <div class="col-xs-6 col-md-3">
                <a href="film.php?fId=<?php echo $row['id'];?>" class="thumbnail">
                    <img src="<?php echo $row['imgPath'];?>">
                </a>
            </div>
        <?php endforeach;?>
    </div>
    <!-- 电影展示结束 -->

</div>
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../bower_components/bootstrap/js/carousel.js"></script>
<script src="../js/js.js"></script>
</body>
</html>