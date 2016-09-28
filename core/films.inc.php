<?php
function getFilmsByPage($page=1,$pageSize=5){
    $sql = "select id from films";
    $totalRows = getResultNum($sql);
    $totalPage = ceil($totalRows/$pageSize);
    if(!is_numeric($page)){
        $page = 1;
    }
    if($page > $totalPage){
        $page = $totalPage;
    }
    $offset = ($page - 1) * $pageSize;
    $sql = "select * from films limit {$offset},{$pageSize}";
    $rows = fetchAll($sql);
    return [$rows,$totalRows,$totalPage,$pageSize];
}

function delFilm($id){
    $where = "id = {$id}";
    $sql = "select imgPath from films where {$where}";
    //print_r($sql);
    $img = fetchOne($sql);
    //print_r($img['imgPath']);
    if(delete('films',$where)){
        if(file_exists($img['imgPath'])){
            @unlink($img['imgPath']);
        }
        echo '删除成功!';
    }else{
        echo '删除失败!';
    }
}

function getFilmInfo($id){
    //  通过ajax传回数据
    $sql = "select * from films where id= {$id}";
    $row = fetchOne($sql);
    $jsonData = json_encode($row);
    print_r($jsonData);
}