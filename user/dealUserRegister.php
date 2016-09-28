<?php
require_once('../include.php');
header("Content-Type: text/html;charset=utf-8");
$_POST['password'] = md5($_POST['password']);
$verify = strtolower($_POST['verify']);
unset($_POST['verify']);
$verify1 = $_SESSION['verify'];
$remeber = @$_POST['remeber'];

if($verify == $verify1){
    $sql = "select username from users where username={$_POST['username']}";
    $row = fetchOne($sql);

    if($row){
        alertMes('该用户已存在!请重新输入用户名!','login.php');
    }else{
        $newId = insert('users',$_POST);
        if(!$newId){
            alertMes('添加新用户失败!请重新添加','login.php');
            exit;
        }
        $_SESSION['userId'] = $newId;
        $_SESSION['userName'] = $_POST['username'];
        header('location:index.php');
    }

}else{
    alertMes('验证码错误!','login.php');
}