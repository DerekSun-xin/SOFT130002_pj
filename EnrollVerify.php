<?php
session_start();

$GLOBALS['_mysql'] = mysqli_connect('localhost','root','root');
mysqli_select_db($GLOBALS['_mysql'],'myartworks');

$username=$_POST['username'];
$password=$_POST['password'];
$password2=$_POST['password2'];

if(checkEmpty($username,$password,$password2)){
    if(checkPassword($password,$password2)){
        if(checkPasswordDetail($password)){
            if(insert($username,$password)){
                $_SESSION['username']=$username;
                echo '<html><head><script>alert("注册成功");</script></head></html>'."<meta http-equiv=\"refresh\" content=\"0;url=EnrollPage.php\">";
            }
        }
    }
}


function checkEmpty($username,$password,$password2){
    if($username== null || $password == null|| $password2== null){
        echo '<html><head><script>alert("输入有空的地方");</script></head></html>'."<meta http-equiv=\"refresh\" content=\"0;url=EnrollPage.php\">";
        header("EnrollPage.php");
    }else{
        return true;
    }
}

function checkPassword($password,$password2){
    if($password==$password2){
        return true;
    }else{
        echo '<html><head><script>alert("两次输入密码不一致");</script></head></html>'. "<meta http-equiv=\"refresh\" content=\"0;url=EnrollPage.php\">";
    }
}

function checkPasswordDetail($password){
        if(preg_match('/[0-9]/',$password) && preg_match('/[a-zA-Z]/',$password)){
                return true;
        }else{
                echo '<html><head><script>alert("密码不包含数字和字母");</script></head></html>'. "<meta http-equiv=\"refresh\" content=\"0;url=EnrollPage.php\">";

        }
}

function insert($username,$password){
    $sql = "SELECT * FROM users WHERE name ='{$username}'";
    $result = $GLOBALS['_mysql'] -> query($sql);

    $totalRow = $result->num_rows;
    $_SESSION['totalRow']=$totalRow;

    //Check Point
    if($totalRow!=0){
        echo '<html><head><script>alert("已有重复用户名");</script></head></html>'. "<meta http-equiv=\"refresh\" content=\"0;url=EnrollPage.php\">";
    }else{
        $sql2 = "INSERT INTO users (name, password,email,tel,address) VALUES ('{$username}', '{$password}','xs7tng@virginia.edu','18862187877','复旦大学')"; //修改Userid
        $_SESSION['sql']=$sql2;
        $result2=$GLOBALS['_mysql'] -> query($sql2);

        if($result2){
            return true;
        }else{
            echo '<html><head><script>alert("有问题！");</script></head></html>'. "<meta http-equiv=\"refresh\" content=\"0;url=EnrollPage.php\">";
        }
    }
}


