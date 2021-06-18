<?php
session_start();
 //导入访问artworks数据库
header("Content-type:text/html;charset=UTF-8");
$GLOBALS['_mysql'] = mysqli_connect('localhost', 'root', 'root');
mysqli_select_db($GLOBALS['_mysql'], 'myartworks');


$username=$_POST['username'];
$password=$_POST['password'];
$autologin=isset($_POST['autologin'])?1:0; //是否选择自动登陆


if(checkEmpty($username,$password)){
    if(checkUser($username,$password)){
        $arrayUserID = array();
        $sql="SELECT * FROM users WHERE  name ='{$username}'"; //change from name to username
        //there should only be one corresponding username
        $result=$GLOBALS['_mysql']->query($sql);
        if($result->num_rows>0){
            while($row = mysqli_fetch_assoc($result)) {
                //create a array where the only value is stored
                $arrayUserID= $row['userID'];
            }
        }else{
            echo '0 results';
        }
        $_SESSION['userID']=$arrayUserID[0];

        $_SESSION['username']=$username; //保存此时登陆成功的用户名
        if($autologin==1){
            setcookie("username".$username,time()+3600*24*3); //有效期设置为3天
            setcookie("password".md5($password),time()+3600*24*3);
        }else{
            setcookie("username","",time()-1); //没有选择自动登陆就清空cookie
            setcookie("password","",time()-1);
        }
        header("location:Front Page.php"); //全部验证通过后跳转到首页
    }
}

//检查用户名密码是否为空
function checkEmpty($username,$password){
    if($username==null || $password==null){
        echo '<html><head><script>alert("用户名或密码为空");</script></head></html>'. "<meta http-equiv=\"refresh\" content=\"0;url=LogInPage.php\">";
    }else{
        return true;
    }
}

function checkUser($username,$password)
{
    $sql2 = "SELECT * FROM users WHERE password='{$password}' AND name ='{$username}'";  //change from name to username
    // $sql2="SELECT * FROM users";
    $result2 = $GLOBALS['_mysql']->query($sql2);
    $totalCount = $result2->num_rows;

    if ($totalCount != 0) {
        $_SESSION["loggedIn"]=true;
        return true;
    } else {
        echo '<html><head><script>alert("用户不存在");</script></head></html>' . "<meta http-equiv=\"refresh\" content=\"0;url=LogInPage.php\">";
        $GLOBALS['_mysql']->close();
    }
}


