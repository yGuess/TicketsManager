<?php
require_once('../include.php');
checkAdminLogined();
$page = @$_REQUEST['page']?(int)$_REQUEST['page']:1;
$infoList = getUsersByPage($page);
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
        .form-control{
            border: 1px solid #e5e5e5;
        }
    </style>
    <title></title>
</head>
<body>
<div class="main main-set">
    <div class="btn-group" role="group" style="padding: 30px 35px">
        <button type="button" class="btn btn-green" data-toggle="modal" data-target="#addUserModal">添加新用户</button>
    </div>
    <table class="table table-hover text-center" style="border-top: solid 1px #e1e1e1;border-bottom: solid 1px #e1e1e1">
        <thead style="background-color: #eee">
        <tr>
            <td>id</td>
            <td>用户名</td>
            <td>邮箱</td>
            <td>操作</td>
        </tr>
        </thead>
        <tbody>
            <?php foreach($rows as $row): ?>
                <tr>
                    <td><?php echo $row['id']?></td>
                    <td><?php echo $row['username']?></td>
                    <td><?php echo $row['email']?></td>
                    <td>
                        <div class="btn-group" role="group">
                            <button  role="button" class="btn btn-default a-hover" onclick="get_user_info(<?php echo $row['id'];?>)">修改</button>
                            <button role="button" class="btn btn-default a-hover" onclick="delete_user(<?php echo $row['id'];?>)">删除</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach;?>
            <a role="button" class="btn btn-green hidden hiddenBtn" data-toggle="modal" data-target="#editUserModal"></a>
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
    </nav>
</div>
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="addUserModalLabel">添加新用户</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" action="insertUser.php">
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3">
                            <input type="text" class="form-control" name="username" placeholder="用户名">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3">
                            <input type="password" class="form-control" name="password" placeholder="密码">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3">
                            <input type="email" class="form-control" name="email" placeholder="邮箱">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary" >添加</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="editUserModalLabel">修改用户信息</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="editUserForm" method="post" action="updateUser.php">
                    <div class="form-group hidden">
                        <div class="col-sm-6 col-sm-offset-3">
                            <input id="userId" type="text" name="userId"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3">
                            <input id="userName" type="text" class="form-control" name="username" placeholder="管理员账号">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3">
                            <input type="password" class="form-control" name="password" placeholder="密码">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3">
                            <input id="userEmail" type="email" class="form-control" name="email" placeholder="邮箱">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <input type="submit" class="btn btn-primary" value="完成"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../bower_components/bootstrap/js/modal.js"></script>
<script>
    function get_user_info(id){
        $.get('doAdminAction.php?',{
            "id" : id,
            "act" : "getUserInfo"
        },function(data,status){
            var values = data.split(',');
            $('#userId').val(values['0']);
            $('#userName').val(values['1']);
            $('#userEmail').val(values['2']);
            $('.hiddenBtn').click();
        });
    }
    function delete_user(id){
        if(confirm('确认删除该用户?')){
            $.get('doAdminAction.php',{
                "id" : id,
                "act" : "delUser"
            });
        }
    }
</script>
</body>
</html>