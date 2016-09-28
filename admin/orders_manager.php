<?php
require_once('../include.php');
checkAdminLogined();
$page = @$_REQUEST['page']?(int)$_REQUEST['page']:1;
$infoList = getOrdersByPage($page);
$rows = $infoList[0];
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
    </style>
    <title></title>
</head>
<body>
<div class="main main-set">
    <table class="table table-hover text-center" style="border-top: solid 1px #e1e1e1;border-bottom: solid 1px #e1e1e1">
        <thead style="background-color: #eee">
        <tr>
            <td class="col-lg-1">订单id</td>
            <td class="col-lg-1">下单用户</td>
            <td class="col-lg-2">电影名</td>
            <td class="col-lg-1">票数</td>
            <td class="col-lg-2">下单时间</td>
            <td class="col-lg-2">截止时间</td>
            <td class="col-lg-3">操作</td>
        </tr>
        </thead>
        <tbody>
            <?php foreach($rows as $row):?>
                <tr>
                    <td ><?php echo $row['id'];?></td>
                    <td ><?php echo $row['username'];?></td>
                    <td ><?php echo $row['fName'];?></td>
                    <td ><?php echo $row['tickets'];?></td>
                    <td ><?php echo date("Y:m:d H:i:s",$row['timestamps']);?></td>
                    <td ><?php echo date("Y:m:d H:i:s",$row['deadline']);?></td>
                    <td >
                        <div class="btn-group" role="group">
                            <a href="#" role="button" class="btn btn-default a-hover" onclick="delete_order(<?php echo $row['id'];?>)">删除</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <nav style="margin: 30px 35px">
        <ul class="pagination">
            <li><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
            <li class="active"><a href="#">1</a></li>
            <li ><a href="#">2</a></li>
            <li ><a href="#">3</a></li>
            <li ><a href="#">4</a></li>
            <li ><a href="#">5</a></li>
            <li>
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
<script>
    function delete_order(id){
        if(confirm('确定删除?请谨慎考虑后点击确认!')){
            window.location.href = 'doAdminAction.php?id='+id;
        }
    }
</script>
</body>
</html>
