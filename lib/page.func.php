<?php
/*
 *   生成分页栏
 */
function showPage($page,$totalPage,$where=null,$sep="&nbsp;"){
    $where = ($where==null)?null:"&".$where;
    $url = $_SERVER['PHP_SELF'];
    $index = ($page == 1) ? "首页" : "<a href='{$url}?page=1{$where}'>首页</a>";
    $last = ($page == $totalPage)? "尾页" : "<a href='{$url}?page={$totalPage}{$where}'>尾页</a>";

    $pre = ($page > 1)? $page-1 : 1;
    $next = ($page >= $totalPage)? $totalPage : $page+1;
    $preBtn = ($page == 1)? "上一页" : "<a href='{$url}?page={$pre}{$where}'>上一页</a>";
    $nextBtn = ($page == $totalPage)? "下一页" : "<a href='{$url}?page={$next}{$where}'>下一页</a>";

    $str = "总共{$totalPage}页/当前是第{$page}页";

    $p = null;
    for($i = 1; $i <= $totalPage; $i++){
        if($page == $i){
            $p .= "[{$page}]";
        } else {
            $p .= "<a href='{$url}?page={$i}{$where}'>[{$i}]</a>";
        }
    }
    $pageStr = $str.$sep.$index.$sep.$preBtn.$sep.$p.$sep.$nextBtn.$sep.$last;
    return $pageStr;
}