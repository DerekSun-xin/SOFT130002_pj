<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EnrollPage</title>
    <link href="LayoutStyle.css" rel="stylesheet" type="text/css" />
    <style>
        .formclass{
            text-align: center;
            margin:auto;
        }
        .divclass{
            text-align: center;
            margin:auto;
        }


    </style>
</head>
<body>
<nav class="position">
    <a href="Front%20Page.php">首页</a>
    <a href="SearchPage.php">搜索</a>
    <a href="LogInPage.php">登陆</a>
    <a href="EnrollPage.php">注册</a>
</nav>
<p style="font-style: oblique"><strong>ArtStore</strong></p>
<p id="footprint"></p>
<hr>
    <form class="formclass" method="post" name="formEnroll" action="EnrollVerify.php">
        <input type="text"  placeholder="用户名" name="username"><br>
        <input type="password"  placeholder="密码" name="password"><br>
        <input type="password"  placeholder="确认密码" name="password2"><br>
        <button type="submit" >注册</button>
    </form>
    <div class="divclass">
        <a href ="LogInPage.php">返回登陆页</a><br>
        <a href="Front%20Page.php">返回主页</a>
    </div>

<script>
    /*function EnrollCheck(){
        var x = document.forms["formEnroll"]["Username"];
        var y = document.forms["formEnroll"]["Password"];
        var z = document.forms["formEnroll"]["ConfirmPassword"];

        if(x.value =="" || y.value =="" || z.value ==""){
            return alert("输入不能为空");
        }
        if(y.value!=z.value){
            return alert("密码与确认密码不一致");
        }

        function checkPassword(){
            const number = /[0-9]/;
            const letter = /[a-zA-Z]/;
            if(number.test(y.value) && letter.test(y.value)){
                return true;
            }else{
                return false;
            }

        }

        if(!(checkPassword()===true)){
            return alert("密码不包含数字和字母");
        }else{
            return alert("注册成功");
        }
    }
*/
</script>
<script src="SharedMethod.js"></script>
</body>
</html>