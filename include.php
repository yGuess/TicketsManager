<?php
    date_default_timezone_set('PRC');
    session_start();
    define('ROOT',dirname(__FILE__));
    set_include_path('.'.PATH_SEPARATOR.ROOT.'/lib'.PATH_SEPARATOR.ROOT.'/core'.PATH_SEPARATOR.ROOT.'/configs'.
        PATH_SEPARATOR.get_include_path());
    require_once 'config.php';
    require_once 'mysql.func.php';
    require_once 'upload_img.func.php';
    require_once 'string.func.php';
    require_once 'image.func.php';
    require_once 'admin.inc.php';
    require_once 'users.inc.php';
    require_once 'films.inc.php';
    require_once 'orders_manager.inc.php';
    require_once 'common.func.php';

    connect();
