<?php
    require_once('../include.php');

    function verifyImage($type=3,$length=4,$pixel=20,$line=0,$sess_name='verify'){
        //通过GD库做验证码
        //画布
        $width = 80;
        $height = 30;
        $image = imagecreatetruecolor($width,$height);
        $white = imagecolorallocate($image,255,255,255);
        $black = imagecolorallocate($image,0,0,0);

        //填充矩形画布
        imagefilledrectangle($image,1,1,$width-2,$height-2,$white);
        $chars = buildRandomString($type,$length);
        $_SESSION[$sess_name] = strtolower($chars);
        $fontFiles = array();		//'SIMYOU.TTF'  添加字体;
        //循环显示每个验证码字符
        for($i = 0 ; $i < 4 ;$i++){
            $size = mt_rand(14,18);
            $angle = mt_rand(-15,15);
            $x=5+$size*$i;
            $y=mt_rand(20,26);
            $fontfile = '../fonts/'.$fontFiles[mt_rand(0,count($fontFiles)-1)];
            $text = substr($chars,$i,1);
            $color = imagecolorallocate($image,mt_rand(50,90),mt_rand(80,200),mt_rand(90,180));
            imagettftext($image,$size,$angle,$x,$y,$color,$fontfile,$text);
        }

        //产生像素干扰
        for($i=0;$i<$pixel;$i++){
            imagesetpixel($image,mt_rand(0,$width-1),mt_rand(0,$height-1),$black);
        }
        //产生线段干扰
        for($i=0;$i<$line;$i++){
            imageline($image,mt_rand(0,$width-1),mt_rand(0,$height-1),mt_rand(0,$width-1),mt_rand(0,$height-1),$black);
        }

        ob_clean();
        header('content-type:image/gif');
        imagegif($image);
        imagedestroy($image);
    }
