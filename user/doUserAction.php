<?php
require_once('../include.php');
checkUserLogined();
$act = $_REQUEST['act'];
$getId = @$_REQUEST['id'];
if($act == 'userLogout'){
    userLogout();
}elseif($act == 'delOrder'){
    delOrder($getId);
}