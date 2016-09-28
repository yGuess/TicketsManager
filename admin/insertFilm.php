<?php
/**
 * Created by PhpStorm.
 * User: 浩
 * Date: 2016/6/1
 * Time: 16:13
 */
require_once('../include.php');
checkAdminLogined();
$mes=uploadIMG();
$info = [];
$info['fName'] = $_POST['fName'];
$info['fType'] = $_POST['fType'];
$info['fArea'] = $_POST['fArea'];
$info['imgPath'] = $mes;
$info['fLanguage'] = $_POST['fLanguage'];
$info['fDuration'] = $_POST['fDuration'];
$info['fActors'] = $_POST['fActors'];
$info['fDirector'] = $_POST['fDirector'];
$info['fCounts'] = $_POST['fCounts'];
$info['playStation'] = $_POST['playStation'];
$info['description'] = $_POST['description'];
//print_r($info);
if(insert('films',$info)){
    alertMes('添加成功!','films_table.php');
}else{
    alertMes('添加失败!','films_table.php');
}
