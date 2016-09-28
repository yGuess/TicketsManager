<?php
require_once('../include.php');
header("Content-Type: text/html;charset=utf-8");

$username = $_POST['username'];
$password = md5($_POST['password']);
$verify = strtolower($_POST['verify']);
$verify1 = $_SESSION['verify'];
$remeber = @$_POST['remeber'];
//print_r($_POST);
if($verify == $verify1){
    $sql = "select id,username from users where username='$username' and password='$password'";
    $row = fetchOne($sql);
    //echo $sql;
    if($row){
        if($remeber){
            setcookie('userId',$row['id'],time()+7*24*3600);
            setcookie('userName',$row['username'],time()+7*24*3600);
        }
        $_SESSION['userId'] = $row['id'];
        $_SESSION['userName'] = $_POST['username'];
        header('location:index.php');
    }else{
        alertMes('该用户不存在或密码错误!','login.php');
    }

}else{
    alertMes('验证码错误!','login.php');
}