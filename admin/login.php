<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title></title>
</head>
<body>
<div class="loginOrRegister font">
    <ul class="nav nav-tabs padding25">
        <li role="presentation" class="disabled">
            <a href="#" class="font18">注 册</a>
        </li>
        <li role="presentation">
            <a href="#" class="active font18 bg-white">登 陆</a>
        </li>
    </ul>
<!--    <div id="reg" class="display-none">-->
<!--        <form method="post">-->
<!--            <div class="list-group-item border-top-none">-->
<!--                <input type="email" class="form-control" id="username-register" placeholder="账户名">-->
<!--            </div>-->
<!--            <div class="list-group-item">-->
<!--                <input type="password" class="form-control" id="password-register" placeholder="密码">-->
<!--            </div>-->
<!--            <div class="list-group-item">-->
<!--                <input type="password" class="form-control" id="email-register" placeholder="邮箱">-->
<!--            </div>-->
<!--            <div class="list-group-item">-->
<!--                <div class="input-group">-->
<!--                    <span class="input-group-addon" id="basic-addon1" style="padding: 0;cursor: pointer;">-->
<!--                        <img src="../lib/getVerify.php" onclick="this.src='../lib/getVerify.php?codes='+Math.random()" alt="刷新"/>-->
<!--                    </span>-->
<!--                    <input type="text" class="form-control" aria-describedby="basic-addon1" name="verify">-->
<!--                </div>-->
<!--            </div>-->
<!--            <br/>-->
<!--            <button type="submit" class="btn btn-primary">注 册</button>-->
<!--        </form>-->
<!--    </div>-->
    <div id="login">
        <form method="post" action="dealLogin.php">
            <div class="list-group-item border-top-none">
                <input name="username" type="text" class="form-control" id="username-login" placeholder="账户名">
            </div>
            <div class="list-group-item">
                <input name="password" type="password" class="form-control" id="password-login" placeholder="密码">
            </div>
            <div class="list-group-item">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding: 0;cursor: pointer;">
                        <img src="../lib/getVerify.php" onclick="this.src='../lib/getVerify.php?codes='+Math.random()" alt="刷新"/>
                    </span>
                    <input name="verify" type="text" class="form-control" aria-describedby="basic-addon1" placeholder="验证码">
                </div>
            </div>
            <div class="list-group-item">
                <label>
                    <input type="checkbox" name="remeber"> 记住我
                </label>
            </div>
            <br/>
            <input type="submit" class="btn btn-primary" value="登 陆" />
        </form>
    </div>
</div>
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../js/js.js"></script>
</body>
</html>