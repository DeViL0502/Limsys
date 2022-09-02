<?php
$servername = "localhost";
$username = "root";
$password = "";
$database="limsys";

// Create connection
$conn = new mysqli($servername, $username, $password,$database);
session_start();

$member_id=$_SESSION["member_id"];
$type=$_SESSION["type"];
$date=date("d/m/y");
$num=0;

$ret5=$conn->query("select return_date,book_name from return_data where member_id=$member_id");
$r5=$ret5->fetch_all();

if(isset($_POST["book_name"])){
    $book_name=$_POST["book_name"];
    $add = "INSERT INTO `search_data`(`member_id`, `book_name`, `date`) VALUES ($member_id,\"$book_name\",\"$date\");";
    $conn->query($add);
    echo "<script> location.replace('search_pg.php') </script>";
}

if($type==1)
{
    $sql=$conn->query("select books_issued from student_data where member_id=$member_id");
    $books_issued=$sql->fetch_all();
}
else
{
    $sql=$conn->query("select books_issued from faculty_data where member_id=$member_id");
    $books_issued=$sql->fetch_all();
}
if($books_issued[0][0]==0){
    $b="books_norecord.php";
}
else{
    $b="books.php";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<link rel="stylesheet" href="homepage.css">
<body>
    <img src="login_bg.jpg" alt="background_image" id="bg">
    <header>
        <div id="cd-logo">
            <img src="ic_logo2.svg" alt="Logo" width="45" height="45" />
        </div>
        <div id="name">
            <h1>Limsys Library</h1>
        </div>
        <div class="home">
            <a href="homepage.php" style="text-decoration: none;color:white;">
                <p>HOME</p>
            </a>
            <a href="profile.php" style="text-decoration: none;">
                <div class="profile">
                    <p>PROFILE</p>
                </div>
            </a>
            <a href="history.php">
                <div class="history">
                    <p>HISTORY</p>
                </div>
            </a>
            <a href=<?php echo "$b"?>>
                <div class="book">
                    <p>BOOKS</p>
                </div>
            </a>
            <a href="index.php">
                <div class="logout">
                    <p>LOGOUT</p>
                </div>
            </a>
        </div>
        <a href="about.php">
            <div class="about">
                <p>ABOUT</p>
            </div>
        </a>
        <a href="contact_us.php">
            <div class="contact_us">
                <p>CONTACT US</p>
            </div>
        </a>
        <form action="" method="POST">
            <input type="text" placeholder="Search Books..." name="book_name" required>
            <input type="image" src="search.png" alt="Submit">
        </form>
        <div class="box">
            <h1 id="head">Most Issued Books</h1>
            <img src="line.png" id="line">
            <img src="data_analytics.jpg" alt="data_analytics" id="b1">
            <img src="operating_systems_sem6.jpg" alt="data_analytics" id="b2">
            <img src="web_technologies_sem6.jpg" alt="data_analytics" id="b3">
            <img src="software_testing.jpg" alt="data_analytics" id="b4"> 
            <button id="data_analytics" onclick="da()">Request</button>
            <button id="operating_systems" onclick="os()">Request</button>
            <button id="web_technologies" onclick="wt()">Request</button>
            <button id="software_testing" onclick="st()">Request</button>
            <script>
                function da(){
                    if(confirm("Confirm want to issue book")==true){
                        location.replace("data_analytics.php");
                    }
                }
                function os(){
                    if(confirm("Confirm want to issue book")==true){
                        location.replace("operating_systems_sem6.php");
                    }
                }
                function wt(){
                    if(confirm("Confirm want to issue book")==true){
                        location.replace("web_technologies_sem6.php");
                    }
                }
                function st(){
                    if(confirm("Confirm want to issue book")==true){
                        location.replace("software_testing.php");
                    }
                }
                
            </script>
        </div>
    </header>
</body>
</html> 