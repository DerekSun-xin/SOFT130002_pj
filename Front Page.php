<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="LayoutStyle.css" rel="stylesheet" type="text/css" />
    <style>
        * {box-sizing: border-box}
        img {
            max-width: 900px;
            max-height: 600px;
            vertical-align: middle;
        }

        .previous, .next{
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }
        .previous:hover, .next:hover {
            background-color: rgba(0,0,0,0.8);
        }


        .center{
            text-align: center;
        }
        img{
            display: block;
            margin-left:auto;
            margin-right:auto;
        }
        *{
            box-sizing:border-box;
        }
        .column{
            float:left;
            width:33.33%;
            height:40px;
            padding:10px;
            text-align:center;
        }
        .row::after {
            content: "";
            clear: both;
            display: table;
        }

    </style>
    <meta charset="UTF-8">
    <title>Front Page</title>
</head>
<body>
<script>  src="SharedMethod.js";</script>
<?php
//Connection Part
$_mysql = mysqli_connect('localhost','root','root');
mysqli_select_db($_mysql,'myartworks');

//Data Receive
$sql = "SELECT * FROM artworks ORDER BY view DESC LIMIT 3" ;
$result = $_mysql->query($sql);

/*if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["artworkID"]. " - Name: " . $row["artist"]. " " . $row["title"]."<br>";
    }
} else {
    echo "0 results";
}*/

$arrayID = array();
$arrayArtist=array();
$arrayDescription=array();
$arrayTitle = array();
$arrayView = array();
if($result->num_rows>0){
    while($row = mysqli_fetch_assoc($result)) {
        $arrayID[] = $row['artworkID'];
        $arrayArtist[] = $row['artist'];
        $arrayDescription[] = $row['description'];
        $arrayTitle[] = $row['title'];
        $arrayView[] = $row['view'];
    }
}else{
    echo "0 results";
}

?>

<script> let arrayID = <?php echo json_encode($arrayID); ?>;
let arrayView = <?php echo json_encode($arrayView); ?>;</script>

    <nav class = position>
        <a  href="Front%20Page.php">首页</a>
        <a  href="SearchPage.php">搜索</a>
        <a href="LogInPage.php">登陆</a>
        <a href="EnrollPage.php">注册</a>
        <a href="PersonalCollection.php">个人收藏夹</a>
    </nav>
    <heading><span style="font-size: large;font-style: italic;font-family: AppleGothic">Art Store</span> where you find Genius and EXTROORDINARY</heading>

<?php
if(empty($_COOKIE['username'])&&empty($_COOKIE['password'])) {
    if(isset($_SESSION['username']))
        echo "登陆成功，欢迎您，" . $_SESSION['username'] . "<a href='LogOut.php' >退出登录</a>";
    else
        echo "你还没有登陆,<a href='LogInPage.php'>请登录</a>";
}else{
    echo "登陆成功，欢迎您:".$_COOKIE['username']."<a href='LogOut.php'>退出登录</a>";
}

?>


    <hr>
    <div class="slideshow">
        <div class="slides">
            <a href="connect_mysql.php?artworkID=70"><img src="img/70.jpg" style="width: 100%"></a>
        </div>
        <div class="slides">
            <a href="connect_mysql.php?artworkID=71"><img src="img/71.jpg" style="width: 100%"></a>
        </div>
        <div class="slides">
            <a href="connect_mysql.php?artworkID=79"><img src="img/79.jpg" style="width: 100%"></a>
        </div>
        <div class="slides">
            <a href="connect_mysql.php?artworkID=80"><img src="img/80.jpg" style="width: 100%"></a>
        </div>

        <a class = "previous" onclick="plusSlides(-1)">&#10094;</a>
        <a class = "next" onclick="plusSlides(1)">&#10095;</a>
    </div>



    <hr>
    <div class = center><p>Most Viewed</p></div>
    <div class="row">
        <div class="column">
            <img src="img/<?php echo "{$arrayID[0]}"?>.jpg" width = 100% height = 500px>
            <?php echo"{$arrayTitle[0]}" ?>
            <?php echo"{$arrayArtist[0]}" ?>
            <p><?php echo"{$arrayDescription[0]}" ?></p>
            <a href="connect_mysql.php?artworkID=<?php echo "{$arrayID[0]}"?>">LEARN MORE</a>
            <br>
            <br>
        </div>

        <div class ="column">
            <img src="img/<?php echo "{$arrayID[1]}"?>.jpg" width=100% height=500px>
            <?php echo "{$arrayTitle[1]}"?>
            <?php echo "{$arrayArtist[1]}"?>
            <p><?php echo "{$arrayDescription[1]}"?></p>
            <a href="connect_mysql.php?artworkID=<?php echo "{$arrayID[1]}"?>" onclick="addView()">LEARN MORE</a>
            <br>
            <br>
        </div>

        <div class ="column">
            <img src="img/<?php echo "{$arrayID[2]}"?>.jpg" width=100% height=500px>
            <?php echo "{$arrayTitle[2]}"?>
            <?php echo "{$arrayArtist[2]}"?>
            <p><?php echo "{$arrayDescription[2]}"?></p>
            <a href="connect_mysql.php?artworkID=<?php echo "{$arrayID[2]}"?>">LEARN MORE</a>
            <br>
            <br>
        </div>
    </div>


    <script>
        src="SharedMethod.js";

        arrayID = <?php echo json_encode($arrayID); ?>;
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n){
            showSlides(slideIndex+=n);
        }
        function showSlides(n){
            let i;
            let slides = document.getElementsByClassName("slides");
            if(n>slides.length){slideIndex = 1}
            if(n<1){slideIndex = slides.length}
            for(i=0;i<slides.length;i++) {
                slides[i].style.display = "none";
            }
            slides[slideIndex-1].style.display = "block";
        }
    </script>




    <footer class="footer">&copy; ArtStore.Produced and maintained by Derek at 2021.3.12. All Rights Reserved </footer>
</body>
</html>

