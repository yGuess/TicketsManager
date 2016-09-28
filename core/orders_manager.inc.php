<?php
function getOrdersByPage($page=1,$pageSize=5){
    $sql = "select id from ticketsorders";
    $totalRows = getResultNum($sql);
    $totalPage = ceil($totalRows/$pageSize);
    if(!is_numeric($page)){
        $page = 1;
    }
    if($page > $totalPage){
        $page = $totalPage;
    }
    $offset = ($page - 1) * $pageSize;
    $sql = "select t.id,t.tickets,t.timestamps,t.deadline,u.username,f.fName ".
           "from ticketsorders as t,users as u,films as f ".
           "where t.userId=u.id and t.filmId=f.id ".
           "limit {$offset},{$pageSize}";
    $rows = fetchAll($sql);
    return [$rows,$totalRows,$totalPage,$pageSize];
}

function delOrder($id){
    $sql = "select filmId,tickets from ticketsorders where id = '$id'";
    $order_info = fetchOne($sql);
    $sql = "select fCounts from films where id={$order_info['filmId']}";
    $film_info = fetchOne($sql);
    $newTickets['fCounts'] = $order_info['tickets']+$film_info['fCounts'];

    $isTrue = false;
    //向数据库提交数据,若失败则回滚
    //取消数据库的自动提交
    cancelAutoCommit();

    //删除ticketsorders表的指定数据 修改指定电影票数量
    if(delete('ticketsorders',"id={$id}")){
        if(update('films',$newTickets,"id={$order_info['filmId']}")){
            commit();
            $isTrue = true;
        }else{
            rollback();
        }
    }else{
        rollback();
    }
    //设置数据库自动提交
    setAutoCommit();

    if($isTrue){
        echo '退票成功!';
    }else{
        echo '退票失败,请重新操作!';
    }

}
