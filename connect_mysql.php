<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="LayoutStyle.css" rel="stylesheet" type="text/css" />
    <style>
        .position{
            position:fixed;
            right:0;
        }
        .container{
            display:flex;
            align-items:center;
            justify-content: center;

            margin:auto;
        }
        img{
            max-width:100%;
        }
        .image{

            width:50%;
            flex-basis: 40%;
            padding-right:40px;
        }
        .text{
            width:50%;
            font-size:10px;
            padding-left:40px;
        }
        a.link{
            background-color:white;
            color:black;
            text-align:center;
            text-decoration:none;
            padding:10px 10px;
        }

    </style>
    <meta charset="UTF-8">
    <title>Show Page</title>
</head>
<body>

<?php
//Connection Part
//$_mysql = mysqli_connect('localhost','root','root');
//mysqli_select_db($_mysql,'myartworks');

$GLOBALS['_mysql'] = mysqli_connect('localhost','root','root');
mysqli_select_db($GLOBALS['_mysql'],'myartworks');

//Data Receive
//$artworkID = "".$_GET['artworkID'];
//$sql = "SELECT * FROM artworks WHERE artworkID=$artworkID";
//$result = $_mysql->query($sql);

$artworkID = "".$_GET['artworkID'];
$sql = "SELECT * FROM artworks WHERE artworkID=$artworkID";
$result = $GLOBALS['_mysql']->query($sql);

//title
$artist='';
$title='';
$price='';
$genre='';
$view ='';
if($result->num_rows>0){  //一次RESULT找到所有信息答案，不用分好几次。
    while($row = mysqli_fetch_assoc($result)) {
        $artist=$artist.$row['artist'];
        $title=$title.$row['title'];
        $price=$price.$row['price'];
        $genre=$genre.$row['genre'];
        $view=$view.$row['view'];
    }
}else{
    echo "0 results";
}
?>


<?php //This PHP is for addCarts() only.
if(isset($_POST['addCarts()'])){
    $artworkID2 = "".$_GET['artworkID'];
    // NEED AN IF STATEMENT
    if($_SESSION['loggedIn'] ==true && is_numeric($_SESSION['userID'])){
        //已经登陆了
        //If ->不能重复添加元素
        $sql3="SELECT * FROM carts WHERE artworkID = '$artworkID2'";
        $result3=$GLOBALS['_mysql']->query($sql3);
        $totalRow = $result3->num_rows;
        if($totalRow!=0){
            echo '<html><head><script>alert("无法添加：艺术品已添加过");</script></head></html>' . "<meta http-equiv=\"refresh\" content=\"0;url=Front Page.php\">";
        }else{
            $sql2 = "INSERT INTO carts (userID, artworkID) VALUES ('{$_SESSION['userID']}','$artworkID2')";
            //Consider $sql2 = "INSERT INTO carts (userID, artworkID) VALUES ('1','$artworkID2') IF NOT EXISTS artworkID = $artworkID";
            $result2 = $GLOBALS['_mysql']->query($sql2);
            echo '<html><head><script>alert("已添加");</script></head></html>';
        }
    }else{
        echo '<html><head><script>alert("你还没有登陆");</script></head></html>' . "<meta http-equiv=\"refresh\" content=\"0;url=LogInPage.php\">";

    }
}
?>

<nav class = position>
    <?php
    if(empty($_COOKIE['username'])&&empty($_COOKIE['password'])) {
        if(isset($_SESSION['username']))
            echo "已登陆，欢迎您，" . $_SESSION['username'] . "<a href='LogOut.php'>退出登录</a>";
        else
            echo "你还没有登陆,<a href='LogInPage.php'>请登录</a>";
    }else{
        echo "已登陆，欢迎您:".$_COOKIE['username']."<a href='LogOut.php'>退出登录</a>";
    }
    ?>
</nav>
<heading>Art Store 登陆 or 注册</heading>
<p id="footprint"></p>
<hr>
<p style="text-align: center"><?php echo "{$title}" ?></p>
<p style="text-align: center"> <?php echo "{$artist}"?> </p>
<hr>
<br>


 <div class="container">
      <div class="image" >
        <img src="img/<?php echo $_GET["artworkID"];?>.jpg" width="100%">
      </div>
      <div class="text">
        <h1>Painted circa 1872-77</h1>
        <h2>Dimensions: 134 cm * 182 *cm (200 in * 18.3 in)</h2>
        <h2>Medium: Oil Paintings</h2>
        <h2>School: <?php echo "{$genre}"?></h2>
        <h2>Location: France</h2>
        <h1>HEAT: <?php echo"{$view}" ?></h1>
        <hr>
        <p>Price: <?php echo "{$price}"?> USD</p> <!-- price -->
        <br>

        <button style="background-color:black; color:white" onclick="addFunction()">Add TO WISH LIST</button>
        <!-- <a href="www.google.com"><button>Add to Wish List</button>></a> -->
        <br><br><br>
          <form method="post">
              <input type="submit" name="addCarts()"
                     class="button" value="addCarts()"/>
          </form>

        <br><br>
        <hr>
        <p><?php echo "<div>{$title}</div>" ?></p
        <p>Looking for his/her paintings</p>
        <hr>
        <br>
        <a href="Front%20Page.php">See More Goods</a>
    </div>
</div>

<br>
<br>

<footer class="footer">&copy; ArtStore.Produced and maintained by Derek at 2021.3.12. All Rights Reserved </footer>


<script>
    function addFunction() {
        return alert("添加成功");
    }



</script>

<script src="SharedMethod.js">

</script>

</body>
</html>

