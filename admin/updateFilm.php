<?php

require_once('../include.php');
checkAdminLogined();
if($_FILES&&!empty($_FILES)){
  $mes = uploadIMG();
  $_POST['imgPath'] = $mes;
}
$fId = $_POST['fId'];
unset($_POST['fId']);
foreach($_POST as $key => $v){
    //print_r($key.'=>'.$v);
    if(empty($_POST[$key])){
        unset($_POST[$key]);
    }
}
if(update('films',$_POST,"id={$fId}")){
    alertMes('修改成功!','films_table.php');
}else{
    echo '修改数据和原数据一致，修改失败!';
}