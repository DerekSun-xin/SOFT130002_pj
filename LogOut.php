<?php
//退出登陆并跳转到登陆页
session_start();
unset($_SESSION['username']);
$_SESSION['loggedIn']= false;
setcookie("username","",time()-1); //清空cookie
setcookie("password","",time()-1);
header("location:Front Page.php");

