<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PersonalCollection</title>

    <link href="LayoutStyle.css" rel="stylesheet" type="text/css"/>
    <style>

        p.pclass{
            text-align: center;
            max-width: 450px;
        }

        th,td{
            text-align: center;
        }
    </style>

</head>
<body>

<nav class="position">
    <a href="Front%20Page.php">首页</a>
    <a href="SearchResult.php">搜索</a>
    <a href="connect_mysql.php">详情</a>
    <a href="LogInPage.html">登陆</a>
    <a href="EnrollPage.html">注册</a>
    <a href="PersonalCollection.php">个人收藏夹</a>
</nav>
<p style="font-style: oblique"><strong>ArtStore</strong></p>
<p id="footprint"></p>


<form class="formclass" method="post" name="SearchColumn" autocomplete="off" action="Show%20Page.html">
    <p style="color: orange; text-align:left">My Shopping Cart</p>
    <input type="search" placeholder="SearchBar" name="Search" size="50">
</form>

<hr>
<h1 style="text-align: center">个人收藏</h1>

<?php
$_mysql = mysqli_connect('localhost','root','root');
mysqli_select_db($_mysql,'myartworks');

$sql = "SELECT * FROM carts";
$result = $_mysql->query($sql);
$result2 = $_mysql->query($sql);

$sql2 = "SELECT * FROM artworks";
$result3 = $_mysql->query($sql);

// Delete SQL
//$sql4 = "DELETE FROM carts WHERE "


//Data submitted
$date = new DateTime();
$date->setTimeZone(new DateTimeZone("Asia/Shanghai"));
$date= $date->format('Y-m-d H:i');
echo $date;


//Create the 个人收藏 Table
echo" <table>
<tr>
<th>Image</th>

<th>artworkID</th>
<th>Title</th>
<th>Artist</th>
<th>Description</th>
</tr>";

$arrayID=array();
if ($result2->num_rows > 0) {
    // output data of each row
    while($row = $result2->fetch_assoc()) {
        $arrayID[]=$row['artworkID'];
    }
} else {
    echo "0 results";
}
//No Error with arrayID

if ($result->num_rows > 0) {
    $i=0;
    // output data of each row


    while($row = $result->fetch_assoc()) {
        $sql3="SELECT * FROM artworks WHERE artworkID = $arrayID[$i]";
        $result4 = $_mysql->query($sql3);

        $U_arrayTitle=array();
        $U_arrayDescription = array();
        $U_arrayArtist = array();
        if ($result4->num_rows > 0) {
            // output data of each row
            while($row2 = $result4->fetch_assoc()) {
                $U_arrayTitle[]=$row2['title'];
                $U_arrayDescription[]=$row2['description'];
                $U_arrayArtist[]=$row2['artist'];
            }
        } else {
            echo "0 results";
        }



        echo "<tr>";
        echo "<td>"
            ."<img src='img/{$arrayID[$i]}.jpg' width=300px height=300px />"."</td>";
       // echo "<td>".$row["cartID"]."</td>";
        echo "<td>". $row["artworkID"]."</td>";
        echo "<td>". $U_arrayTitle[0]."</td>";
        echo "<td>". $U_arrayArtist[0]."</td>";
        echo "<td>". $U_arrayDescription[0]."</td>";
        echo "<td>". "<input type='button' value='Delete It From Carts'
    onclick=''>"."</td>";
        echo "</tr>";
        $i++;
    }
} else {
    echo "0 results";
}
echo "</table>";

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


<script>
    function deleteRow(r) {
        var i = r.parentNode.parentNode.rowIndex;
        return document.getElementById("myTable").deleteRow(i);
    }


    function insertRow() {
        var table = document.getElementById("myTable");
        var row = table.insertRow(0);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        cell1.innerHTML = "NEW CELL1";
        cell2.innerHTML = "NEW CELL2";
    }

</script>

    <script src="SharedMethod.js"></script>

</body>
</html>