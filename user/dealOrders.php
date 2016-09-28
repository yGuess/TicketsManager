<?php
require_once('../include.php');
header("Content-Type: text/html;charset=utf-8");
checkUserLogined();
$data = [];
$data['tickets'] = $_POST['tickets'];
$data['userId'] = $_POST['userId'];
$data['filmId'] = $_POST['filmId'];
$data['timestamps'] = time();
$data['deadline'] = time()+3600*24*7;


$filmId = $data['filmId'];
$sql = "select fCounts from films where id = '$filmId'";
$nowTickets = fetchOne($sql);
$newTickets['fCounts'] = $nowTickets['fCounts'] - $data['tickets'];

$isTrue = false;
//向数据库提交数据,若失败则回滚

    //取消数据库的自动提交
    cancelAutoCommit();
    //提交数据
    //修改films表数据
    if(update('films',$newTickets,"id={$data['filmId']}")){
        //向表单表提交数据
        if(insert('ticketsorders',$data)){
            //表单提交成功,提交成功
            commit();
            $isTrue = true;
        }else{
            //提交失败 回滚数据
            rollback();
        }
    }else{
        rollback();
    }
    //设置数据库自动提交
    setAutoCommit();
    if($isTrue){
        alertMes('订票成功!',"film.php?fId=$filmId");
    }else{
        alertMes('订票失败!',"film.php?fId=$filmId");
    }



