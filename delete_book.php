<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database="limsys";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password,$database);

	$sql1="select book_id from books_data;";
	$result1=$conn->query($sql1);

    $sql4="select copies from books_data;";
	$result4=$conn->query($sql4);

    $id=$result1->fetch_all();

    $copies=$result4->fetch_all();

    if(isset($_POST["BookId"])){
        $book_id=$_POST["BookId"];
        for($i=0;$i<count($id);$i++){
            if($book_id==$id[$i][0])
            {
                $quantity=$_POST["Quantity"];
                $sql = "UPDATE `books_data` SET `copies`=copies-$quantity WHERE book_id=$book_id and copies>0;";
                try {
                $conn->query($sql);
                echo "<script> alert('Book Removed!!')</script>";
                echo "<script> window.location=window.location;</script>";
                }
                catch (Exception $e) {
                echo "<script> alert('Error!!') </script>" ;
                }
            }
        }
        echo "<script> alert('Book Not Found!!') </script>" ;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    <script>
        function validateForm(){
            if(confirm("Confirm want to delete book") == true){
                return true;
            }
            else{
                return false;
            }
        }
    </script>
</head>
<link rel="stylesheet" href="admin_delete_book.css">
<body>
    <div class="head">
        <img src="ic_logo2.svg" alt="">
        <h1>Limsys Library</h1>
    </div>
    <div class="top">

    </div>
    <div class="box">
        <h1>Delete Book</h1>
        <div class="box2">
            <table>
                <tr>
                    <th>Book Id</th>
                    <th>Quantity</th>
                </tr>
            </table>
            <?php
                echo "<script>let table=document.querySelector('table');let tbody=table.createTBody();</script>";
                for($i=0;$i<count($id);$i++)
                {
                    echo "<script>trow=tbody.insertRow();</script>";
                    echo "<script>trow.innerHTML='<td>".$id[$i][0]."</td><td>".$copies[$i][0]."</td>';</script>";
                }
            ?>
        </div>
        <div class="box3">
            <form name="RegForm" action="" onsubmit="return validateForm()" method="post">
                <label for="BookId">Book Id</label><br>
                <input type="number" name="BookId" id="book_id" required><br>
                <label for="Quantity">Quantity</label><br>
                <input type="number" name="Quantity" id="book_name" required>
                <input type="submit" value="Remove Book">
            </form>
        </div>
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