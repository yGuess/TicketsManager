<?php
require_once('../include.php');
checkAdminLogined();
$act = $_REQUEST['act'];
$getId = @$_REQUEST['id'];
if($act == 'logout'){
    logout();
} elseif ($act == 'getAdminInfo'){
    getAdminInfo($getId);
} elseif ($act == 'delAdmin'){
    delAdmin($getId);
} elseif($act == 'getUserInfo'){
    getUserInfo($getId);
}elseif($act == 'editUser'){
    editUser($getId);
} elseif($act == 'delUser'){
    delUser($getId);
} elseif($act == 'getFilmInfo'){
    getFilmInfo($getId);
} elseif($act == 'delFilm'){
    delFilm($getId);
}
