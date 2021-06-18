<?php
$_mysql = mysqli_connect('localhost', 'root', 'root');
mysqli_select_db($_mysql, 'myartworks');


$artworkID = $_GET['artworkID'];
$del= "DELETE FROM carts WHERE artworkID=$artworkID";
$result = $_mysql->query($del);


if($del)
{
    mysqli_close($_mysql); // Close connection
    header("location:PersonalCollection.php"); // redirects to PS page
    exit;
}
else
{
    echo "Error deleting record"; // display error message if not delete
}


