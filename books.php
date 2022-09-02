<?php
$servername = "localhost";
$username = "root";
$password = "";
$database="limsys";

// Create connection
$conn = new mysqli($servername, $username, $password,$database);
session_start();

$member_id=$_SESSION["member_id"];
$sql=$conn->query("select book_name,issue_date,return_date from return_data where member_id=$member_id");
$books_issued=$sql->fetch_all();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
</head>
<link rel="stylesheet" href="books.css">
<body>
    <div class="box">
        <h1>Books Issued</h1>
        <div class="box1">
            <h3>Book Name</h3>
            <h3>Issue Date</h3>
            <h3>Return Date</h3>
        </div>
        <div id="data">

        </div>
        <?php
        for($i=0;$i<count($books_issued);$i++)
        {
            echo "<script>var bn=document.createElement('p');</script>";
            echo "<script>bn.id='bn';</script>";
            echo "<script>bn.innerHTML='".$books_issued[$i][0]."';</script>";
            echo "<script>var br=document.createElement('br');</script>";
            echo "<script>var isd=document.createElement('p');</script>";
            echo "<script>isd.id='isd';</script>";
            echo "<script>isd.innerHTML='".$books_issued[$i][1]."';</script>";
            echo "<script>var rd=document.createElement('p');</script>";
            echo "<script>rd.id='rd';</script>";
            echo "<script>rd.innerHTML='".$books_issued[$i][2]."';</script>";
            echo "<script>var box=document.getElementById('data');</script>";
            echo "<script>box.appendChild(bn);</script>";
            echo "<script>box.appendChild(isd);box.appendChild(rd);box.appendChild(br.cloneNode());</script>";
        }
        ?>
        <div>
            <a href="homepage.php" style="text-decoration: none;">
                <h1 id="button" style="text-decoration: none;">GO TO HOMEPAGE</h1>
            </a>
        </div>
    </div>
</body>
</html>