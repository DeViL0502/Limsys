<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database="limsys";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password,$database);

	$sql1="select book_id from books_data;";
	$result1=$conn->query($sql1);
    $sql2="select book_name from books_data;";
	$result2=$conn->query($sql2);
    $sql4="select copies from books_data;";
	$result4=$conn->query($sql4);

    $id=$result1->fetch_all();
    $name=$result2->fetch_all();

    $copies=$result4->fetch_all();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
</head>
<link rel="stylesheet" href="admin_book_data.css">
<body>
    <div class="head">
        <img src="ic_logo2.svg" alt="">
        <h1>Limsys Library</h1>
    </div>
    <div class="top">

    </div>
    <div class="box">
        <h1>Books Data</h1>
        <table>
            <tr>
                <th>Book Id</th>
                <th>Book Name</th>
                <th>Copies Available</th>
            </tr>
        </table>
        <?php
             echo "<script>let table=document.querySelector('table');let tbody=table.createTBody();</script>";
            for($i=0;$i<count($id);$i++)
            {
                echo "<script>trow=tbody.insertRow();</script>";
                echo "<script>trow.innerHTML='<td>".$id[$i][0]."</td><td>".$name[$i][0]."</td><td>".$copies[$i][0]."</td>';</script>";
            }
        ?>
    </div>
    <div class="tags">
        <img src="admin_logo_m.jpg">       <!-- For Male Admin Profle Pic-->

        <!-- 
        <img src="/img/admin_logo_f.png">        For Female Admin Profle Pic
        -->
        <p>Admin</p>
        <p>Deepraj Anil Pagare</p>
        <a href="admin_homepage.php" style="text-decoration: none;">
            <h3>Home</h3>
        </a>
        <a href="admin_books.php" style="text-decoration: none;">
            <h3>Books</h3>
        </a>
        <a href="return_data.php" style="text-decoration: none;">
            <h3>Return Data</h3>
        </a>
        <a href="index.php" style="text-decoration: none;">
            <h3>Logout</h3>
        </a>
    </div>
</body>
</html> 