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
    <a href="SearchPage.php">搜索</a>
    <a href="LogInPage.php">登陆</a>
    <a href="EnrollPage.php">注册</a>
    <a href="PersonalCollection.php">个人收藏夹</a>
</nav>
<p style="font-style: oblique"><strong>ArtStore</strong></p>

<hr>

<div  style="text-align: center">
    <h1>Google</h1>
<input style="text-align: center" id="searchbar" type="text" name="search" placeholder="Search According to Title" >
<button onclick="search()">Search Now!</button>
</div>

<p id="demo"></p>
<p id="emo"></p>


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
//$sql = "SELECT * FROM artworks WHERE artworkID=$artworkID";
$sql2 = "SELECT * FROM artworks";
$result = $_mysql->query($sql2);
$arrayTitle = array();
$arrayDescription= array();
$arrayArtist = array();
$arrayArtworkID = array();
$arrayView= array();

//arrayTitle/arrayDescription/arrayArtist: Test Success
if($result->num_rows>0){
    while($row = mysqli_fetch_assoc($result)) {
        $arrayTitle[] = $row['title'];
        $arrayView[]= $row['view'];
        $arrayArtist[]= $row['artist'];
        $arrayArtworkID[] = $row['artworkID'];
    }
}else{
    echo "0 results";
}

?>

<script>
    //Pass PHP variable to JS code --> arrayTitle //Test successfully
    var arrayTitle = <?php echo json_encode($arrayTitle); ?>;
    var arrayView = <?php echo json_encode($arrayView); ?>;
    var arrayArtist = <?php echo json_encode($arrayArtist); ?>;
    var arrayArtworkID = <?php echo json_encode($arrayArtworkID); ?>;

    //search Method
   // var returnArrayTitle;
    var returnArrayArtworkID;
   // var returnArrayArtist;
   // var returnArrayView;

    function search(){
       // returnArrayTitle=new Array();
        returnArrayArtworkID = new Array();
      //  returnArrayView = new Array();
      //  returnArrayArtist = new Array();
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
              //  returnArrayTitle.push(arrayTitle[i]);
                returnArrayArtworkID.push(arrayArtworkID[i]);
              //  returnArrayArtist.push(arrayArtist[i]);
              //  returnArrayView.push(arrayView[i]);
            }else{
            }
        }
console.log(returnArrayArtworkID);

        window.location=encodeURI("SearchResult.php?returnArrayArtworkID="+returnArrayArtworkID);
       // window.location=encodeURI("SearchResult.php?returnArrayArtworkID="+returnArrayArtworkID+"&returnArrayTitle="+returnArrayTitle+"&returnArrayArtist="+returnArrayArtist+"&returnArrayView="+returnArrayView);

    }

</script>



<?php
echo "Search Result"."<hr>"."<br>";
$returnArrayArtworkID=$_GET["returnArrayArtworkID"];
$returnArrayArtworkID=explode(",",$returnArrayArtworkID);


/*$sql3 = "SELECT * FROM artworks WHERE artworkID IN (".implode(',',$returnArrayArtworkID).")   ";
$result3 = $_mysql->query($sql3);
if($result3){
    $totalCount = count($returnArrayArtworkID);
}else{
    $totalCount=0;
}


if($totalCount==0){
    echo "No Users";
}else{
$pageSize=5;
$totalPage=(int)(($totalCount%$pageSize==0)?($totalCount/$pageSize):($totalCount/$pageSize+1));

if(!isset($_GET['page']))
    $currentPage = 1;
else
    $currentPage= $_GET['page'];

$mark = ($currentPage-1)*$pageSize;
$firstPage=1;
$lastPage=$totalPage;
$prePage=($currentPage>1)?$currentPage-1:1;
$nextPage=($totalPage-$currentPage>0)?$currentPage+1:$totalPage;

/*$sql3="SELECT * FROM artworks WHERE artworkID IN (".implode(',',$returnArrayArtworkID).") LIMIT $mark , $pageSize";
$result3 = mysqli_query($_mysql,$sql3);*/
?>
<div style="text-align: center ; padding: 5px">


<table style='width: 100%'>
<tr>
<th>Image</th>
<th>artworkID</th>
<th>Title</th>
<th>Artist</th>
<th>Heat</th>
<th>Description</th>
</tr>


<?php
//This Section is to build up the SearchResult table
$sql4 ="SELECT * FROM artworks WHERE artworkID IN (".implode(',',$returnArrayArtworkID).")";
$result4 = $_mysql->query($sql4);

for($j=0;$j<count($returnArrayArtworkID);$j++)
    {
    $row=mysqli_fetch_assoc($result4);
?>
    <tr>
        <td><img style="width: 200px ; height:200px" src="img/<?php echo $row['artworkID']?>.jpg"></td>
        <td><?php echo $row['artworkID'];?></td>
        <td><?php echo $row['title'];?></td>
        <td><?php echo $row['artist'];?></td>
        <td><?php echo $row['view'];?></td>
        <td><?php echo $row['description'];?></td>
        <td><a href='connect_mysql.php?artworkID=<?php echo $row['artworkID']?>'>View</a></td>
    </tr>
<?php
    }
?>
</table>
</div>

</body>
</html>







