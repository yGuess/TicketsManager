<?php
/**
 * Created by PhpStorm.
 * User: 浩
 * Date: 2016/5/29
 * Time: 20:04
 */
require_once('../include.php');
checkAdminLogined();
$username = $_POST['username'];
$password = md5($_POST['password']);
$email = $_POST['email'];
if($username&&$password&&$email){
    $len = count($_POST);
    $arr = array_slice($_POST,0,$len);
    //print_r($arr);
    $arr['password'] = $password;
    if(insert('admin',$arr)){
        echo '添加成功!';
    }else{
        echo '添加失败!';
    }
}else{
    echo '添加管理员失败!';
}