<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SearchPage</title>
    <link href="LayoutStyle.css" rel="stylesheet" type="text/css" />
    <style>
        ul.pagination{
            padding:0;
            margin:auto;
            display: flex;
            justify-content: center;
        }
        ul.pagination li{display: inline}

        ul.pagination li a{
            color:black;
            float:left;
            padding: 8px 16px;
            text-decoration: none;
        }
        p.pclass{
            text-align: center;
            max-width: 450px;
        }
    </style>
</head>
<body>
<nav class="position">
    <a href="Front%20Page.php">首页</a>
    <a href="SearchResult.php">搜索</a>
    <a href="Show%20Page.html">详情</a>
    <a href="LogInPage.html">登陆</a>
    <a href="EnrollPage.html">注册</a>
    <a href="PersonalCollection.php">个人收藏夹</a>
</nav>
<p style="font-style: oblique"><strong>ArtStore</strong></p>
<p id="footprint"></p>
<hr>

<div  style="text-align: center">
    <h1>Google</h1>
<input style="text-align: center" id="searchbar" type="text" name="search" placeholder="Search According to Title" >
<button onclick="search()">Search Now!</button>
</div>

<p id="demo"></p>
<p id="emo"></p>



<!--<div style="margin-left:45%">
    <p>All Infiltration:</p>
    <div>
        <input type="checkbox" name="checkBox" id="heat">
        <label>Popularity</label>
    </div>
    <div>
        <input type="checkbox" name="checkBox" id="price">
        <label>Price</label>
    </div>
    <div>
        <input type="checkbox" name="checkBox" id="description">
        <label>Description</label>
    </div>
    <div>
        <input type="checkbox" name="checkBox" id="artist">
        <label>Artist</label>
    </div>
</div> -->



<ul class="pagination">
    <li><a href=""><<</a> </li>
    <li><a href="">1</a> </li>
    <li><a href="">2</a> </li>
    <li><a href="">3</a> </li>
    <li><a href="">4</a> </li>
    <li><a href="">5</a> </li>
    <li><a href="">6</a>
    <li><a href="">7</a> </li>
    <li><a href="">>></a> </li>
</ul>

<script src="SharedMethod.js"></script>

<br>
<?php
//Connection Part
$_mysql = mysqli_connect('localhost', 'root', 'root');
mysqli_select_db($_mysql, 'myartworks');

//Data Receive
$artworkID = "".$_GET['artworkID'];
$sql = "SELECT * FROM artworks WHERE artworkID=$artworkID";
$sql2 = "SELECT * FROM artworks";
$result = $_mysql->query($sql2);
$arrayTitle = array();
$arrayDescription= array();
$arrayArtist = array();
$arrayArtworkID = array();

//arrayTitle/arrayDescription/arrayArtist: Test Success
if($result->num_rows>0){
    while($row = mysqli_fetch_assoc($result)) {
        $arrayTitle[] = $row['title'];
        $arrayDescription[]= $row['description'];
        $arrayArtist[]= $row['artist'];
        $arrayArtworkID[] = $row['artworkID'];
    }
}else{
    echo "0 results";
}

//Ajax --> Now I can use variable [input] in Javascript
?>


<script>
    //Pass msg from JS to PHP: Success

    //Pass PHP variable to JS code --> arrayTitle //Test successfully
    var arrayTitle = <?php echo json_encode($arrayTitle); ?>;
    var arrayDescription = <?php echo json_encode($arrayDescription); ?>;
    var arrayArtist = <?php echo json_encode($arrayArtist); ?>;
    var arrayArtworkID = <?php echo json_encode($arrayArtworkID); ?>;

    //search Method
    var title;
    var description;
    var artist;
    var returnArrayTitle;
    var returnArrayArtworkID;
    var returnArrayImage;
    function search(){
        returnArrayTitle=new Array();
        returnArrayArtworkID = new Array();
        returnArrayImage = new Array();
        let input = document.getElementById("searchbar").value;
        input = input.toLowerCase();
        /*input = input.split(',');
        if(input.length==1){
            title=input;
        }else if(input.length==2){
            title=input[0];
            description=input[1];
        }else if(input.length==3){
            title=input[0];
            description=input[1];
            artist=input[2];
        }else if{
            //More than 3 results;
        }*/
        var i;
        for(i=0;i<arrayTitle.length;i++){
            if(arrayTitle[i].toLowerCase().includes(input)){ //mistake
                returnArrayTitle.push(arrayTitle[i]);
                returnArrayArtworkID.push(arrayArtworkID[i]);
                returnArrayImage.push("img/arrayArtworkID[i].jpg");
            }else{
            }
        }
        console.log(returnArrayTitle);
        console.log(returnArrayArtworkID);

        document.getElementById("demo").innerHTML="Search Result:" +"<hr>";


        var txt = '';
        returnArrayTitle.forEach(myFunction);
        document.getElementById("emo").innerHTML=txt;
        function myFunction(value) {
            txt = txt + value+"<br>";
        }


        function buildData(){
            var arrayTable = [returnArrayArtworkID,returnArrayTitle,returnArrayImage];
            var table = document.createElement("table");
                var trOne = document.createElement("tr");
                    var thOne = document.createElement("th");
                        thOne.innerHTML = "ArtworkID";
                    var thTwo = document.createElement("th");
                        thTwo.innerHTML="Title";
                    var thThree = document.createElement("th");
                        thThree.innerHTML="Image";
                    trOne.appendChild(thOne);
                    trOne.appendChild(thTwo);
                    trOne.appendChild(thThree);
            table.appendChild(trOne);

            for(var i = 0; i<arrayTable[0].length; i++){
                var trTwo = document.createElement("tr");
                    var tdOne = document.createElement("td");
                        tdOne.innerHTML = arrayTable[0][i];
                    var tdTwo = document.createElement("td");
                        tdOne.innerHTML = arrayTable[1][i];
                    var tdThree = document.createElement("td");
                        tdOne.innerHTML = arrayTable[2][i];
                    trTwo.appendChild(tdOne);
                    trTwo.appendChild(tdTwo);
                    trTwo.appendChild(tdThree);
                    table.appendChild(trTwo);
            }
            document.body.appendChild(table);
        }





    }


</script>

</body>
</html>







