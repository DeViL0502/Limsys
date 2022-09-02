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

    $sql1=$conn->query("select copies from books_data where book_id=1018" ); 
    $data_analysis=$sql1->fetch_all();
    $ret1=$conn->query("select book_id from return_data where member_id=$member_id and book_id=1018");
    $r1=$ret1->fetch_all();
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        if(<?php echo $books_issued[0][0]?><5){
            if(<?php echo $data_analysis[0][0]?>>0){
                if(<?php echo count($r1)?>==0){
                    <?php $_SESSION["b"]=1018; ?>
                    location.replace("issue.php");
                }
                else{
                    alert("Book Already Issued!!");
                    location.replace("homepage.php");
                }
            }
            else{
                location.replace("book_not_avlb.php");
            }
        }
        else{
                alert("Cannot issue more than 5 books");
                location.replace("homepage.php");
        }
    </script>
</head>
<body>

</body>
</html>