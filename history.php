<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database="limsys";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password,$database);
    session_start();

    $member_id=$_SESSION["member_id"];
	$sql1="select book_name,date from search_data where member_id=$member_id;";
	$result1=$conn->query($sql1);
    $data=$result1->fetch_all();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
</head>
<link rel="stylesheet" href="history.css">
<body>
    <div class="box">
        <h1>History</h1>
        <div id="head">
            <p>Book Name</p>
            <p>Search Date</p>
        </div>
        <div id="data">
            
        </div>
        <?php
        for($i=count($data)-1;$i>=0;$i--)
        {
            echo "<script>var bn=document.createElement('p');</script>";
            echo "<script>bn.id='bn';</script>";
            echo "<script>bn.innerHTML='".$data[$i][0]."';</script>";
            echo "<script>var rd=document.createElement('p');</script>";
            echo "<script>rd.id='rd';</script>";
            echo "<script>rd.innerHTML='".$data[$i][1]."';</script>";
            echo "<script>var data=document.getElementById('data');</script>";
            echo "<script>data.appendChild(bn);data.appendChild(rd);</script>";
        }
        ?>
        <div id="button" >
            <a href="homepage.php" style="text-decoration: none;">
                <h1 id="btn_text" style="text-decoration: none;">GO TO HOMEPAGE</h1>
            </a>
        </div>
    </div>
</body>
</html>











