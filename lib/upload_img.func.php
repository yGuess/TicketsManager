<?php
/**
 * Created by PhpStorm.
 * User: 浩
 * Date: 2016/6/1
 * Time: 22:39
 */
require_once('../lib/string.func.php');
/*
 *   处理上传文件的信息
 */
function buildInfo(){
    $i = 0;
    $files = null;
    foreach($_FILES as $file){
        if(is_string($file['name'])){

            // 单文件
            $files[$i]['name'] = $file['name'];
            $files[$i]['size'] = $file['size'];
            $files[$i]['error'] = $file['error'];
            $files[$i]['tmp_name'] = $file['tmp_name'];
            $files[$i]['type'] = $file['type'];
            $i++;
        } else {

            // 多文件
            foreach($file['name'] as $key => $val){
                $files[$i]['name'] = $val;
                $files[$i]['size'] = $file['size'][$key];
                $files[$i]['error'] = $file['error'][$key];
                $files[$i]['tmp_name'] = $file['tmp_name'][$key];
                $files[$i]['type'] = $file['type'][$key];
                $i++;
            }
        }
    }
    return $files;
}

function uploadIMG($path='../uploads',$allowExt=array("gif","jpeg","jpg","png","wbmp",'txt'),
                    $maxSize = 1048576){
    $mes = null;
    if (!file_exists($path)) {
        mkdir('../'.$path, 0777, true);
    }
    $files = buildInfo();
    foreach($files as $file){
        if ($file['error'] == UPLOAD_ERR_OK) {
            $ext = getExt($file['name']);
            if (!in_array($ext, $allowExt)) {
                $mes = '非法文件类型!';
            }

            if ($file['size'] > $maxSize) {
                $mes = '文件过大!';
            }

            // 验证文件是否是真正的图片
            if (!getimagesize($file['tmp_name'])) {
                exit('文件不是真正的图片类型!');
            }

            $filename = getUniName() . '.' . $ext;
            $destination = $path.'/'.$filename;

            // 判断文件是否通过HTTP POST方式上传
            if (is_uploaded_file($file['tmp_name'])) {
                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    //echo '文件上传成功';
                    $mes = $destination;
                } else {
                    echo '图片移动失败，电影相关信息已添加成功!';
                }
            }
        } else {
            switch ($file['error']) {
                case 1:
                    $mes = '文件超过配置文件允许上传文件的大小'; // UPLOAD_ERR_INI_SIZE
                    break;

                case 2:
                    $mes = '文件超过表单设置上传文件的大小';  // UPLOAD_ERR_FORM_SIZE
                    break;

                case 3:
                    $mes = '文件部分被上传';  // UPLOAD_ERR_PARTIAL
                    break;

                case 4:
                    $mes = "没有文件被上传";  // UPLOAD_ERR_NO_FILE
                    break;

                case 6:
                    $mes = "没有找到临时目录"; // UPLOAD_ERR_NO_TMP_DIR
                    break;

                case 7:
                    $mes = "文件不可写"; // UPLOAD_ERR_CANT_WRITE
                    break;

                case 8:
                    $mes = "由于PHP扩展程序中断文件上传"; // UPLOAD_ERR_EXTENSION
                    break;
            }
        }
    }
    return $mes;
}
