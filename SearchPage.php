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

<script src="SharedMethod.js"></script>
<br>

<?php
//Connection Part
$_mysql = mysqli_connect('localhost', 'root', 'root');
mysqli_select_db($_mysql, 'myartworks');

//Data Receive
$artworkID = "".$_GET['artworkID'];

$sql = "SELECT * FROM artworks";
$result = $_mysql->query($sql);
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

?>

<script>
    //Pass PHP variable to JS code --> arrayTitle //Test successfully
    var arrayTitle = <?php echo json_encode($arrayTitle); ?>;
    var arrayArtworkID = <?php echo json_encode($arrayArtworkID); ?>;

    var returnArrayArtworkID;

    function search(){
        returnArrayArtworkID = new Array();

        let input = document.getElementById("searchbar").value;
        input = input.toLowerCase();

        var i;
        for(i=0;i<arrayTitle.length;i++){
            if(arrayTitle[i].toLowerCase().includes(input)){
                returnArrayArtworkID.push(arrayArtworkID[i]);
            }else{
            }
        }
        console.log(returnArrayArtworkID);

        window.location=encodeURI("Test.php?returnArrayArtworkID="+returnArrayArtworkID);
    }
</script>


<?php
//Display all the results in the searchPage
$sql2="SELECT * FROM artworks";
$result2 = mysqli_query($_mysql,$sql2);

if($result2){
    $totalCount = $result->num_rows;
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

    $sql2="SELECT * FROM artworks LIMIT $mark , $pageSize";
    $result2 = mysqli_query($_mysql,$sql2);
?>


<table>
    <tr>
        <th>artworkID</th>
        <th>Title</th>
        <th>Artist</th>
        <th>Description</th>
    </tr>

<?php
    for($j=0;$j<$pageSize;$j++)
    {
    $row=mysqli_fetch_assoc($result2);
?>

<tr>
    <td><?php echo $row['artworkID'];?></td>
    <td><?php echo $row['title'];?></td>
    <td><?php echo $row['artist'];?></td>
    <td><?php echo $row['description'];?></td>
</tr>
<?php
 }
?>
</table>


<?php /*
if($result2->num_rows>0){
    $i=0;

    while($row = mysqli_fetch_assoc($result2)) {
        echo "<tr>";
        echo "<td>"
            ."<img src='img/{$arrayArtworkID[$i]}.jpg' width=200px height=200px />"."</td>";
        // echo "<td>".$row["cartID"]."</td>";
        echo "<td>". $row["artworkID"]."</td>";
        echo "<td>". $arrayTitle[0]."</td>";
        echo "<td>". $arrayArtist[0]."</td>";
        echo "<td>". $arrayDescription[0]."</td>";
        echo "</tr>";
        $i++;
    }
}else{
    echo "0 results";
}
echo "</table>";*/
?>

<div style="text-align: center">
    <a href="SearchPage.php?page=<?php echo $firstPage;?>">FirstPage</a>
    &nbsp;&nbsp;
    <a href="SearchPage.php?page=<?php echo $prePage;?>">PrePage</a>
    &nbsp;&nbsp;
    <a href="SearchPage.php?page=<?php echo $nextPage;?>">NextPage</a>
    &nbsp;&nbsp;
    <a href="SearchPage.php?page=<?php echo $lastPage;?>">LastPage</a>
    &nbsp;&nbsp;
</div>
<div style="text-align: right"><?php echo $currentPage; ?>/<?php echo $totalPage; ?>&nbsp;Pages</div>

<?php
}

mysqli_free_result($result2);
mysqli_close($_mysql);
?>

</body>
</html>
