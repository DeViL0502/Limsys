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
$bn=$conn->query("select book_name from search_data where member_id=$member_id");
$books_name=$bn->fetch_all();
$name=$books_name[count($books_name)-1][0];
$sql1 = $conn->query("SELECT book_name,author,img FROM `books_data` where book_name like '%$name%';");
$books=$sql1->fetch_all();
$cot=count($books);
$date=date("d/m/y");
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
if($books_issued>5)
$var="book_not_avlb.php";
else
$var="book_avlb.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <script>
        function validateForm(){
            if(confirm("Confirm want to issue book") == true){
                return true;
            }
            else{
                return false;
            }
        }
    </script>
</head>
<link rel="stylesheet" href="search_pg.css">
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
            <a href="books_norecord.php">
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
            <input type="text" placeholder="Search Books..." name="book_name" value="<?php echo $books_name[count($books_name)-1][0] ?>">
            <input type="image" src="search.png" alt="Submit">
        </form>
        <div id="box">
        
        </div>
        <?php
        if($cot!=0){
        for($i=0;$i<count($books);$i++)
        {
            echo "<script>var image=document.createElement('img');</script>";
            echo "<script>image.setAttribute('src','".$books[$i][2].".jpg');</script>";
            echo "<script>var h1=document.createElement('h1');</script>";
            echo "<script>h1.innerHTML='".$books[$i][0]."';</script>";
            echo "<script>var br=document.createElement('br');</script>";
            echo "<script>var h3=document.createElement('h3');</script>";
            echo "<script>h3.innerHTML='~ ".$books[$i][1]."';</script>";
            echo "<script>var box=document.getElementById('box');</script>";
            echo "<script>var form=document.createElement('form');</script>";
            echo "<script>form.setAttribute('name','RegForm');form.setAttribute('onsubmit','return validateForm()');</script>";
            echo "<script>form.setAttribute('method','POST');form.setAttribute('action','".$books[$i][2].".php');</script>";
            echo "<script>form.innerHTML='<input type=\'submit\' value=\'Request\'>'</script>";
            echo "<script>box.appendChild(image);</script>";
            echo "<script>box.appendChild(h1);</script>";
            echo "<script>box.appendChild(br.cloneNode()); box.appendChild(h3);box.appendChild(form);</script>";
        }}
        else{
            echo "<script>var box=document.getElementById('box');</script>";
            echo "<script>box.setAttribute('style','height:60vh;background-color:white');</script>";
            echo "<script>var image=document.createElement('img');</script>";
            echo "<script>image.setAttribute('src','no_book.jpg');</script>";
            echo "<script>image.setAttribute('style','margin-left:42%;border:0px');</script>";
            echo "<script>var h1=document.createElement('h1');</script>";
            echo "<script>h1.setAttribute('style','margin-left:39%;bottom:0px');</script>";
            echo "<script>h1.innerHTML='No Book Found!!';</script>";
            echo "<script>box.appendChild(image);</script>";
            echo "<script>box.appendChild(h1);</script>";
        }
        ?>
</body>
</html>