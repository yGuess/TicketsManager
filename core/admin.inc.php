<?php
require_once('../include.php');

/*
 *  检测是否已登陆
 */
function checkAdminLogined(){
    if(($_SESSION['adminId'] == '')&&$_COOKIE['adminId'] == ''){
        alertMes('未登录,请先登录！','login.php');
    }
}

/*
 *  获取所有管理员信息(除密码以外)
 */
function getAllAdmin(){
    $sql = "select id,username,email from admin";
    $rows = fetchAll($sql);
    return $rows;
}

/*
 *
 */
function getAdminByPage($page=1,$pageSize=5){
    $sql = "select id from admin";
    $totalRows = getResultNum($sql);
    $totalPage = ceil($totalRows/$pageSize);
    if(!is_numeric($page)){
        $page = 1;
    }
    if($page > $totalPage){
        $page = $totalPage;
    }
    $offset = ($page - 1) * $pageSize;
    $sql = "select id,username,email from admin limit {$offset},{$pageSize}";
    $rows = fetchAll($sql);
    return [$rows,$totalRows,$totalPage,$pageSize];
}

function delAdmin($id){
    $where = "id = {$id}";
    if(delete('admin',$where)){
        echo '删除成功!';
    }else{
        echo '删除失败!';
    }
}

function getAdminInfo($id){
    //  通过ajax传回数据
    $sql = "select id,username,email from admin where id= {$id}";
    $row = fetchOne($sql);
    echo $row['id'].','.$row['username'].','.$row['email'];
}

function logout(){
    $_SESSION = array();
    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(),'',time()-1-7*24*3600);
    }
    if(isset($_COOKIE['adminId'])){
        setcookie('adminId','',time()-1-7*24*3600);
        setcookie('adminName','',time()-1-7*24*3600);
    }
    session_destroy();
    header('location:login.php');
}
