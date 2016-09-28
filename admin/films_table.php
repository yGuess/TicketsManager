<?php
require_once('../include.php');
checkAdminLogined();
$page = @$_REQUEST['page']?(int)$_REQUEST['page']:1;
$infoList = getFilmsByPage($page);
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
        .input-group[class*=col-]{
            padding-left: 15px;
            padding-right: 15px;
        }
    </style>
    <title></title>
</head>
<body>
<div class="main main-set">
    <div class="btn-group" role="group" style="padding: 30px 35px">
        <button type="button" class="btn btn-green" data-toggle="modal" data-target="#addFilmModal">添加新的电影</button>
    </div>
    <table class="table table-hover text-center" style="border-top: solid 1px #e1e1e1;border-bottom: solid 1px #e1e1e1">
        <thead style="background-color: #eee">
        <tr>
            <td class="col-lg-1">电影名</td>
            <td class="col-lg-1">类型</td>
            <td class="col-lg-1">语种</td>
            <td class="col-lg-2">导演</td>
            <td class="col-lg-3">主演</td>
            <td class="col-lg-1">余票</td>
            <td class="col-lg-3">操作</td>
        </tr>
        </thead>
        <tbody>
            <?php foreach($rows as $row):?>
                <tr>
                    <td ><?php echo $row['fName']?></td>
                    <td ><?php echo $row['fType']?></td>
                    <td ><?php echo $row['fLanguage']?></td>
                    <td ><?php echo $row['fDirector']?></td>
                    <td ><?php echo $row['fActors']?></td>
                    <td ><?php echo $row['fCounts']?></td>
                    <td >
                        <div class="btn-group" role="group">
                            <a role="button" class="btn btn-default a-hover" onclick="get_film_info(<?php echo $row['id'];?>)">详细</a>
                            <a role="button" class="btn btn-default a-hover" onclick="update_film(<?php echo $row['id'];?>)">修改</a>
                            <a role="button" class="btn btn-default a-hover" onclick="delete_film(<?php echo $row['id'];?>)">删除</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach;?>
            <a role="button" class="hidden showInfoBtn" data-toggle="modal" data-target="#filmInfoModal">显示信息</a>
            <a role="button" class="hidden editInfoBtn" data-toggle="modal" data-target="#editFilmModal">修改信息</a>
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
<div class="modal fade" id="addFilmModal" tabindex="-1" role="dialog" aria-labelledby="addFilmModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="addFilmModalLabel">添加新的电影</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="addFilmForm" method="post" action="insertFilm.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                            <input type="text" class="form-control" name="fName" placeholder="电影名" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                            <input type="text" class="form-control" name="fType" placeholder="电影类型" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                            <input type="text" class="form-control" name="fArea" placeholder="地区" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                            <input type="text" class="form-control" name="fLanguage" placeholder="语言" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1 input-group">
                            <input type="text" class="form-control" name="fDuration" placeholder="时长" required>
                            <span class="input-group-addon">分钟</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                            <input type="text" class="form-control" name="fActors" placeholder="主演" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                            <input type="text" class="form-control" name="fDirector" placeholder="导演" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1 input-group">
                            <input type="text" class="form-control" name="fCounts" placeholder="剩余票数" required>
                            <span class="input-group-addon">张</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                            <input type="text" class="form-control" name="playStation" placeholder="电影院名" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                            <textarea name="description" class="form-control" placeholder="电影简介" maxlength="400"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1" id="showIMG">
                            <input type="file" name="img_cover" id="addIMG">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <input type="submit" class="btn btn-primary" value="添加">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="filmInfoModal" tabindex="-1" role="dialog" aria-labelledby="filmInfoModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="filmInfoModalLabel">电影详细信息</h4>
            </div>
            <div class="modal-body">
                <div class="media" id="showFilmInfoMedia">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object img" src="">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading fname"></h4>
                        <p>导演：<span class="direc"></span></p>
                        <p>主演：<span class="actors"></span></p>
                        <p>
                            <span class="area"></span>
                            <span class="lang"></span>
                            <span class="duration"></span>分钟
                        </p>
                        <div>剧情简介：
                            <p class="descrip"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editFilmModal" tabindex="-1" role="dialog" aria-labelledby="editFilmModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="editFilmModalLabel">修改电影信息</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="editFilmForm" method="post" action="updateFilm.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1 hidden">
                            <input type="text" class="fId" name="fId">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                            <input type="text" class="form-control" name="fName" placeholder="电影名">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                            <input type="text" class="form-control" name="fType" placeholder="电影类型">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                            <input type="text" class="form-control" name="fArea" placeholder="地区">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                            <input type="text" class="form-control" name="fLanguage" placeholder="语言">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1 input-group">
                            <input type="text" class="form-control" name="fDuration" placeholder="时长">
                            <span class="input-group-addon">分钟</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                            <input type="text" class="form-control" name="fActors" placeholder="主演">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                            <input type="text" class="form-control" name="fDirector" placeholder="导演">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1 input-group">
                            <input type="text" class="form-control" name="fCounts" placeholder="剩余票数">
                            <span class="input-group-addon">张</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                            <input type="text" class="form-control" name="playStation" placeholder="电影院名">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                            <textarea name="description" class="form-control" placeholder="电影简介" maxlength="400"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1" id="showIMG">
                            <input type="file" name="img_cover" id="addIMG">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-primary">完成</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../bower_components/bootstrap/js/modal.js"></script>
<script>
    //var save_info = null;
    $(document).ready(function(){
        $('#addIMG').change(function(){
            if(typeof FileReader) {
                var file = this.files[0];
                var fileReader = new FileReader();
                fileReader.onload = (function () {
                    return function () {
                        var $img = $("<img style='width: 80px;height: 60px;'/>")
                        $img.attr('src', this.result);
                        $('#showIMG').append($img);
                    }
                })(file);
                fileReader.readAsDataURL(file);
            }
        });
    });
    function addFilm(){
        $.post('insertFilm.php',
            $('#addFilmForm').serialize(),
            function(data,status){
                alert(data);
                window.location.reload();
            });
    }
    function delete_film(id){
        if(confirm('确认该电影信息?请认真考虑后点击确认!')){
            $.get('doAdminAction.php',{
                "id" : id,
                "act" : "delFilm"
            },function(data,status){
                alert(data);
                window.location.reload();
            });
        }
    }
    function get_film_info(id){
        $.get('doAdminAction.php?',{
            "id" : id,
            "act" : "getFilmInfo"
        },function(data,status){
            showJsonData(data);
        },'json');
        $('.showInfoBtn').click();
    }
    function update_film(id){
        $.get('doAdminAction.php?',{
            "id" : id,
            "act" : "getFilmInfo"
        },function(data,status){
            //alert(data);
            editJsonData(data); //将json放到对应input里
        },'json');
        $('.editInfoBtn').click();
    }
    function editJsonData(json){
        var par = $('#editFilmForm>div>div');
        par.children("input[name='fId']").val(json['id']);
        par.children("input[name='fName']").val(json['fName']);
        par.children("input[name='fType']").val(json['fType']);
        par.children("input[name='fArea']").val(json['fArea']);
        par.children("input[name='fLanguage']").val(json['fLanguage']);
        par.children("input[name='fDuration']").val(json['fDuration']);
        par.children("input[name='fActors']").val(json['fActors']);
        par.children("input[name='fDirector']").val(json['fDirector']);
        par.children("input[name='fCounts']").val(json['fCounts']);
        par.children("input[name='playStation']").val(json['playStation']);
        par.children("textarea").val(json['description']);
    }
    function showJsonData(json){
        $('.img').attr('src',json['imgPath']);
        $('.fname').text(json['fName']);
        $('.direc').text(json['fDirector']);
        $('.actors').text(json['fActors']);
        $('.area').text(json['fArea']);
        $('.lang').text(json['fLanguage']);
        $('.duration').text(json['fDuration']);
        $('.descrip').text(json['description']);
    }
</script>
</body>
</html>