<?php
require_once('../include.php');

function checkUserLogined(){
    if($_SESSION['userId']==''&&$_COOKIE['userId']=''){
        alertMes('请先登陆!','login.php');
    }
}
/*
 *  获取所有用户信息(除密码以外)
 */
function getAllUsers(){
    $sql = "select id,username,email from users";
    $rows = fetchAll($sql);
    return $rows;
}

/*
 *
 */
function getUsersByPage($page=1,$pageSize=5){
    $sql = "select id from users";
    $totalRows = getResultNum($sql);
    $totalPage = ceil($totalRows/$pageSize);
    if(!is_numeric($page)){
        $page = 1;
    }
    if($page > $totalPage){
        $page = $totalPage;
    }
    $offset = ($page - 1) * $pageSize;
    $sql = "select id,username,email from users limit {$offset},{$pageSize}";
    $rows = fetchAll($sql);
    return [$rows,$totalRows,$totalPage,$pageSize];
}

function delUser($id){
    $where = "id = {$id}";
    if(delete('users',$where)){
        header('location:users.php');
    }else{
        echo '<script>alert("删除失败!");</script>';
    }
}

function editUser($id){
    $sqlArr = null;
    $isNull = false;
    $newName = $_POST['username'];
    $newPwd = $_POST['password'];
    $newEmail = $_POST['email'];

    if(!($newName == '') ){
        $sqlArr['username'] = $_POST['username'];
        //echo 'name not null';
    }
    if(!($newPwd == '') ){
        $sqlArr['password'] = md5($_POST['password']);
        $isNull = true;
        //echo 'pwd not null';
    }
    if(!($newEmail == '') ){
        $sqlArr['email'] = $_POST['email'];
        //echo 'email not null';
    }
    if(update('users',$sqlArr,"id={$id}")){
        if($isNull){
            logout();
        }else{
            echo '修改成功!';
        }
    }else{
        echo '修改数据和原数据一致，修改失败!';
    }
}
function getUserInfo($id){
    //  通过ajax传回数据
    $sql = "select id,username,email from users where id= {$id}";
    $row = fetchOne($sql);
    echo $row['id'].','.$row['username'].','.$row['email'];
}

function userLogout(){
    $_SESSION = array();
    if(isset($_COOKIE['userId'])){
        setcookie('userId','',time()-1-7*24*3600);
        setcookie('userName','',time()-1-7*24*3600);
    }
    session_destroy();
    header('location:login.php');
}

function search($key){
    $sql = "select * from films where like '%{$key}%'";
    $rows = fetchAll($sql);
    return $rows;
}