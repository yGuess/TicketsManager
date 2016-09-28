<?php
require_once('../include.php');
checkAdminLogined();
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
        .nav-pills>li.active>a,
        .nav-pills>li:hover>a,
        .nav-pills>li.active>a:focus,
        .nav-pills>li.active>a:hover{
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
    </style>
    <title></title>
</head>
<body>
<!-- 导航栏 -->
<nav class="navbar" style="background-color: #fafafa;margin-bottom: 0">
    <div class="nav-wrap">
        <!-- 导航栏简略显示 -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">电影购票后台管理</a>
        </div>
        <!-- 简略显示结束 -->
        <!-- 导航栏正常显示 -->
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#">
                        <?php
                            if(isset($_SESSION['adminName'])){
                                echo $_SESSION['adminName'].' ,你好';
                            }elseif(isset($_COOKIE['adminName'])){
                                echo $_COOKIE['adminName'].' ,你好';
                            }
                        ?>
                    </a>
                </li>
                <li><a href="doAdminAction.php?act=logout">退出</a></li>
            </ul>
        </div>
        <!-- 导航栏正常显示结束 -->
    </div>
</nav>
<!-- 导航栏结束 -->
<div style="background-color:#0cc2b4">
    <ul class="nav nav-pills main navlist">
        <li role="presentation" class="active"><a href="admin.php" target="main-table">管理员</a></li>
        <li role="presentation"><a href="users.php" target="main-table">用户管理</a></li>
        <li role="presentation"><a href="films_table.php" target="main-table">电影管理</a></li>
        <li role="presentation"><a href="orders_manager.php" target="main-table">电影订单管理</a></li>
    </ul>
</div>

<div class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item" src="admin.php" name="main-table"></iframe>
</div>
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../js/js.js"></script>
</body>
</html>