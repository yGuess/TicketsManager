<?php
require_once('../include.php');
checkUserLogined();
$userId = $_SESSION['userId']?$_SESSION['userId']:$_COOKIE['userId'];
$page = isset($_GET['page'])?$_GET['page']:1;

$sql_user = "select id,username,email from users where id='$userId'";
$user_row = fetchOne($sql_user);
$infoList = getOrdersByPage($page);
$orders_rows = $infoList[0];
$totalRows = $infoList[1];
$totalPages = $infoList[2];
$pageSize = $infoList[3];
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body{
            font-family: Microsoft Yahei, monospace, serif;
            background: none #fafafa;
        }
        .nav-pills>li.active>a{
            background-color: #fff;
            color: #000;
        }
        .nav-pills>li>a:hover{
            background-color: #fff;
            color: #000;
        }
        .nav-pills>li>a{
            border-top: solid 1px #0cc2b4;
            border-radius: 0;
            height: 100%;
            padding: 20px 26px;
            font-size: 1.25em;
            color: #fff;
        }
        .main-set{
            border: solid #e1e1e1;
            border-width: 0 1px 1px;
        }
        .btn{
            width: inherit;
        }
        .btn-green{
            background-color: #0cc2b4;
            color: #fff;
        }
        .btn-green:hover{
            background-color: #F9B044;
            color: #fff;
        }
        .a-hover:hover{
            background-color: #F9B044;
            color: #fff;
            border-color: #F9B044;
        }
        .table>tbody>tr>td{
            vertical-align: inherit;
        }
        .pagination>.active>a{
            background-color: #0CC2B4;
            border-color: #0CC2B4;
        }
        .form-control{
            border: 1px solid #e5e5e5;
        }
        .input-group[class*=col-]{
            padding-left: 15px;
            padding-right: 15px;
        }
    </style>
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
                        echo "<li><a href='personal.php?'>{$_SESSION['userName']}</a></li>";
                        echo "<li><a href='doUserAction.php?act=logout'>退出</a></li>";
                    }elseif(isset($_COOKIE['userName'])){
                        echo "<li><a href='personal.php?'>{$_COOKIE['userName']}</a></li>";
                        echo "<li><a href='doUserAction.php?act=logout'>退出</a></li>";
                    }
                ?>
            </ul>
        </div>
        <!-- 导航栏正常显示结束 -->
    </div>
</nav>
<!-- 导航栏结束 -->

<div class="main">
    <div>
        <img src="../icon/my-icon.jpg" class="img-circle img-responsive pull-left"/>
        <p>
            <span><?php echo $user_row['username'];?> </span>
            <span><?php echo $user_row['email'];?> </span>
        </p>
    </div>
    <table class="table table-hover text-center">
        <thead>
            <tr>
                <td class="col-lg-2">用户名</td>
                <td class="col-lg-2">已订票电影</td>
                <td class="col-lg-1">票数</td>
                <td class="col-lg-3">订票时间</td>
                <td class="col-lg-3">过期时间</td>
                <td class="col-lg-1">操作</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($orders_rows as $order_row):?>
                <tr>
                    <td><?php echo $order_row['username'];?></td>
                    <td><?php echo $order_row['fName'];?></td>
                    <td><?php echo $order_row['tickets'];?></td>
                    <td><?php echo date("Y:m:d H:i:s",$order_row['timestamps']);?></td>
                    <td><?php echo date("Y:m:d H:i:s",$order_row['deadline']);?></td>
                    <td><a role="button" class="btn btn-default a-hover" onclick="delete_order(<?php echo $order_row['id'];?>)">取消订票</a></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <nav style="margin: 30px 35px" class="text-center">
        <ul class="pagination">
            <?php
            if($totalRows>$pageSize){

                $url=$_SERVER['PHP_SELF'];
                $pre= $page==1?1:$page-1;
                $next= $page==$totalPages?$totalPages:$page+1;

                echo "<li><a href='{$url}?page={$pre}' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";
                echo "<li><a>{$page} / {$totalPages}</a></li>";
                echo "<li><a href='{$url}?page={$next}' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>";
            }else{
                echo '共 1 页';
            }
            ?>
        </ul>
</div>
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../bower_components/bootstrap/js/carousel.js"></script>
<script src="../js/js.js"></script>
<script>
    function delete_order(id){
        if(confirm('请仔细考虑后点击确认！')){
            $.post('doUserAction.php',{
                'id':id,
                'act':'delOrder'
            },function(data,status){
                alert(data);
                window.location.reload();
            })
        }
    }
</script>
</body>
</html>