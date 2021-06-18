<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PersonalCollection</title>

    <link href="LayoutStyle.css" rel="stylesheet" type="text/css"/>
    <style>

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
<h1 style="text-align: center">个人收藏</h1>

<?php
$_mysql = mysqli_connect('localhost','root','root');
mysqli_select_db($_mysql,'myartworks');

$sql = "SELECT * FROM carts"; // All information in the carts, including artworkID and userID
$result = $_mysql->query($sql); //
$result2 = $_mysql->query($sql); // All information in the carts are now in $result1 and $result2

//Data submitted
$date = new DateTime();
$date->setTimeZone(new DateTimeZone("Asia/Shanghai"));
$date= $date->format('Y-m-d H:i');
echo $date;

//Create the 个人收藏 Table



$arrayID=array();
//$arrayID用来store 所有被ADD CARTS() artworkID
if ($result2->num_rows > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result2)) {
        $arrayID[]=$row['artworkID'];
    }
} else {
    echo "0 results";
}//

$sqlTest = "SELECT * FROM carts WHERE userID = {$_SESSION['userID']}";
$resultTest = $_mysql->query($sqlTest); //$result contains very line of artworkID of corresponding userID
//Create an array where the corresponding user's artworkID is stored
$userArtworkID = array();
if ($resultTest->num_rows > 0){
while($row = mysqli_fetch_assoc($resultTest)) {
    $userArtworkID[] = $row['artworkID']; //ArtworkID is an array that stores the current user's cart's artworkID
 }
}//

$sql4="SELECT * FROM artworks WHERE artworkID IN  (".implode(',',$userArtworkID).") ";
//$sql4 stores all information of artworks that user 's cart have
$result4 = $_mysql->query($sql4);

$result5 = $_mysql->query($sql4);

echo" 
<div><table>
<tr>
<th>Image</th>
<th>artworkID</th>
<th>Title</th>
<th>Artist</th>
<th>Description</th>
</tr>";

$i=0;
while($row = mysqli_fetch_assoc($result4)) {
    echo "<tr>";
    echo "<td>"."<img src='img/{$row['artworkID']}.jpg' width=200px height=200px />"."</td>";
    echo "<td>". $row["artworkID"]."</td>"; //checkLine
    echo "<td>". $row['title']."</td>";
    echo "<td>". $row['artist']."</td>";
    echo "<td>". $row['description']."</td>";
    // echo "<td>"."<input type='button' value='Delete It From Carts' src='Delete.php?artworkID=$U_arrayArtworkID[0]'>"."</td>"
    echo "<td>"."<a href='Delete.php?artworkID={$row['artworkID']}'>Delete</a>"."</td>";
    echo "</tr>";
    $i++;
}

echo "</table>";
echo "</div>";
?>



 <!--   <table id="myTable">
        <tr>
            <td><a href="Show%20Page.html"><img src="img/29.jpg" width=300px height=300px></a></td>
            <td>Musicos Con Mascaras Carpet</td>
            <td>Pablo Picasso</td>
            <td>This bold and surrealistic painting depicts a group of musicians with their tired pup using sharp-edged geometric shapes and stunning light effects</td>
            <td> <button onclick="deleteRow(this)">DELETE IT</button></td>
            <td><button onclick="insertRow(this)">INSERT ROW</button></td>
        </tr>
        <tr>
            <td> <a href="Show%20Page.html"><img src="img/179.jpg" width=300px height=300px></a></td>
            <td>Nocturne in Black and Gold - The Falling Rocket</td>
            <td>James Abbott McNeill Whistler</td>
            <td>This painting exemplified the Art for art's sake movement</td>
            <td> <button onclick="deleteRow(this)">DELETE IT</button></td>
            <td><button onclick="insertRow(this)">INSERT ROW</button></td>
        </tr>
        <tr>
            <td> <a href="Show%20Page.html"><img src="img/60.jpg" width = 300px height = 300px></a></td>
            <td>Sunflowers</td>
            <td>Van Gogh</td>
            <td>He demonstrated that it was possible to create an image with numerous variations of a single color,
                without any lose of eloquence</td>
            <td> <button onclick="deleteRow(this)">DELETE IT</button></td>
            <td><button onclick="insertRow(this)">INSERT ROW</button></td>
        </tr>
    </table>
-->


    <hr>
    <h1 style="text-align: center">个人信息</h1>
    <table  align="center">
        <tr>
            <td>姓名:</td>
            <td>孙鑫</td>
        </tr>
        <tr>
            <td>性别：</td>
            <td>男</td>
        </tr>
        <tr>
            <td>电话号码：</td>
            <td>18862187877</td>
        </tr>
        <tr>
            <td>电子邮箱:</td>
            <td>xs7tng@virginia.edu</td>
        </tr>
        <tr>
            <td>专业：</td>
            <td>数学计算机</td>
        </tr>
        <tr>
            <td>学校：</td>
            <td>复旦大学</td>
        </tr>
    </table>


    <script src="SharedMethod.js"></script>

</body>
</html>