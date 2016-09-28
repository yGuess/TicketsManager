<?php
require_once('../include.php');
checkAdminLogined();
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
//print_r($_POST);
if(update('admin',$sqlArr,"id={$_POST['userId']}")){
    if($isNull){
        logout();
    }else{
        echo '修改成功!';
    }
}else{
    echo '修改数据和原数据一致，修改失败!';
}
