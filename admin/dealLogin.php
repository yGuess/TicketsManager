<?php
    require_once('../include.php');

$username = $_POST['username'];
$password = md5($_POST['password']);
$verify = strtolower($_POST['verify']);
$verify1 = $_SESSION['verify'];
$remeber = @$_POST['remeber'];
if($verify == $verify1){
    $sql = "select id,username from admin where username='$username' and password='$password'";
    $row = fetchOne($sql);

    if($row){
        $_SESSION['adminId'] = $row['id'];
        $_SESSION['adminName'] = $_POST['username'];
        if($remeber){
            setcookie('adminId',$row['id'],time()+7*24*3600);
            setcookie('adminName',$row['username'],time()+7*24*3600);
        }
        header('location:index.php');
    }else{
        alertMes('�ù���Ա������!','login.php');
    }

}else{
    alertMes('��֤�����!','login.php');
}