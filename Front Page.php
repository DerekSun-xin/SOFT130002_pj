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
<script>var arrayID = <?php echo json_encode($arrayID); ?>;
var arrayView = <?php echo json_encode($arrayView); ?>;</script>

    <nav class = position>
        <a  href="Front%20Page.php">首页</a>
        <a  href="SearchResult.php">搜索</a>
        <a href="connect_mysql.php">详情</a>
        <a href="LogInPage.html">登陆</a>
        <a href="EnrollPage.html">注册</a>
        <a href="PersonalCollection.php">个人收藏夹</a>
    </nav>
    <heading><span style="font-size: large;font-style: italic;font-family: AppleGothic">Art Store</span> where you find Genius and EXTROORDINARY</heading>
    <form class="formclass" method="post" name="SearchColumn" autocomplete="off" action="Show%20Page.html">
        <input type="search" placeholder="SearchBar" name="Search" size="50">
        <button onclick="window.location.href='SearchPage.html'">Search Now!</button>
        <br>
    </form>

    <p id="footprint"></p>


   <!-- <hr>
    <div class="slideshow">
        <div class="slides">
           <a href="Show%20Page.html"><img src="img/70.jpg" style="width: 100%"></a>
        </div>
        <div class="slides">
            <a href="Show%20Page.html"><img src="img/71.jpg" style="width: 100%"></a>
        </div>
        <div class="slides">
            <a href="Show%20Page.html"><img src="img/79.jpg" style="width: 100%"></a>
        </div>
        <div class="slides">
            <a href="Show%20Page.html"><img src="img/80.jpg" style="width: 100%"></a>
        </div>

        <a class = "previous" onclick="plusSlides(-1)">&#10094;</a>
        <a class = "next" onclick="plusSlides(1)">&#10095;</a>
    </div> -->



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
            <center><?php echo"{$arrayTitle[0]}" ?></center>
            <center><?php echo"{$arrayArtist[0]}" ?></center>
            <p><?php echo"{$arrayDescription[0]}" ?></p>
            <a href="connect_mysql.php?artworkID=<?php echo "{$arrayID[0]}"?>">LEARN MORE</a>
            <br>
            <br>
        </div>

        <div class ="column">
            <img src="img/<?php echo "{$arrayID[1]}"?>.jpg" width=100% height=500px>
            <center><?php echo "{$arrayTitle[1]}"?></center>
            <center><?php echo "{$arrayArtist[1]}"?></center>
            <p><?php echo "{$arrayDescription[1]}"?></p>
            <a href="connect_mysql.php?artworkID=<?php echo "{$arrayID[1]}"?>" onclick="addView()">LEARN MORE</a>
            <br>
            <br>
        </div>

        <div class ="column">
            <img src="img/<?php echo "{$arrayID[2]}"?>.jpg" width=100% height=500px>
            <center><?php echo "{$arrayTitle[2]}"?></center>
            <center><?php echo "{$arrayArtist[2]}"?></center>
            <p><?php echo "{$arrayDescription[2]}"?></p>
            <a href="connect_mysql.php?artworkID=<?php echo "{$arrayID[2]}"?>">LEARN MORE</a>
            <br>
            <br>
        </div>
    </div>


    <script>
        src="SharedMethod.js";

        var arrayID = <?php echo json_encode($arrayID); ?>;


        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n){
            showSlides(slideIndex+=n);
        }


        function showSlides(n){
            var i;
            var slides = document.getElementsByClassName("slides");
            if(n>slides.length){slideIndex = 1}
            if(n<1){slideIndex = slides.length};
            for(i=0;i<slides.length;i++) {
                slides[i].style.display = "none";
            }
            slides[slideIndex-1].style.display = "block";
        }

        function addView(){
            // Two arrays: ArrayID+ArrayView. All of them are ordered according to arrayView.
                // DONE.
            //Now onclick() --> addView() to one artwork. The view of the artwork+1.
                //
            // Update the view in that arrayView.
                // Locate the position in that array.
                // View++ in the arrayView.
            // Update the new view in database by using SQL.
                // Transfer arrayView data back to php. Now Use SQL to update according to the artwork's ID.
            // Test the result.
                // Test the result using ArrayID[1] and ArrayID[2].
        }
    </script>

    <footer class="footer">&copy; ArtStore.Produced and maintained by Derek at 2021.3.12. All Rights Reserved </footer>
</body>
</html>

