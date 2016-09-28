<?php
/*
 * 生成验证码
 * $type 代表二维码包含字符类型(数字、大小写字母),默认1个数字的字符
 * $length 验证码长度,默认是4个字符
 */
function buildRandomString($type=1,$length=4){
    //获取字符串
    $chars = '';
    if($type == 1){
        $chars = join('',range(0,9));
    }elseif($type == 2){
        $chars = join('',array_merge(range('a','z'),range('A','Z')));
    }elseif($type == 3){
        $chars = join('',array_merge(range('a','z'),range('A','Z'),range(0,9)));
    }
    if($length > strlen($chars)){
        exit('字符串长度不够');
    }
    $chars = str_shuffle($chars); //打乱字符串
    return substr($chars,0,$length);
}

/*
 *  生成一个唯一的字符串
 *
 *  uniqid(prefix,more_entropy)  基于当前时间的微秒计，产生一个唯一的id
 *     prefix 为ID规定前缀
 *     more_entropy 位于返回值末尾的更多的熵
 *
 *  microtime(false) 生成一个基于unix微秒计的时间戳
 *      默认参数为false，返回一个字符串
 *      参数为true,返回一个浮点数
 */
function getUniName(){
    return md5(uniqid(microtime(true),true));
}
/*
 *  获取文件扩展名
 *
 * explode(separator,string) 分割字符串,该函数返回值不能直接应用，需要通过变量使用
 * end(arr) 数组内部指针指向最后一个元素，并返回该元素的值
 */
function getExt($filename){
    $ext = explode('.',$filename);
    return strtolower(end($ext));
}