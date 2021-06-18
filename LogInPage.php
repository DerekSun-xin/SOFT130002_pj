<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LogInPage</title>
    <link href="LayoutStyle.css" rel="stylesheet" type="text/css"/>
    <style>
        .divclass{
            text-align: center;
            margin:auto;
        }
    </style>
</head>
<body>
    <nav class = position>
      <a  href="Front%20Page.php">首页</a>
      <a  href="SearchPage.php">搜索</a>
      <a href="LogInPage.php">登陆</a>
      <a href="EnrollPage.php">注册</a>
      <a href="PersonalCollection.php">个人收藏夹</a>
    </nav>
    <h1>Art Store where you find Genius and EXTROORDINARY</h1>
 <!--   <p id="footprint"></p> -->
    <hr>
    <p style="text-align: center">ArtStore</p>
    <p style="text-align: center">Please enter your username and password.</p>


    <form class="formclass" method="post" name="Login" action="doLogin.php">
        <label><input type="text" placeholder="用户名" name="username"></label><br>
        <label><input type="password" placeholder="密码" name="password"></label><br>
        <p>*用户为空</p>
        <label><input type="checkbox" name="autologin[]" value="1">自动登陆</label><br>
        <button type="submit">登陆</button>
    </form>

    <div class="divclass">
        <a  href="EnrollPage.php">Create Account</a><br>
        <a  href="Front%20Page.php">返回主页</a>
    </div>

    <footer class="footer">&copy; ArtStore.Produced and maintained by Derek at 2021.6.16. All Rights Reserved </footer>



    <script>
        function checkFunction(){
         let x = document.forms["Login"]["Username"];
         let y = document.forms["Login"]["Password"];
         if(x.value=="" || y.value==""){
           return alert("账号密码输入不能为空");
         }
         else{
           return alert("登录成功");
         }
    }
    </script>
<script src="SharedMethod.js"></script>
</body>
</html>