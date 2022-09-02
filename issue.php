<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database="limsys";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password,$database);
    session_start();
    
    $member_id=$_SESSION["member_id"];
    $book_id=$_SESSION["b"];
    $type=$_SESSION["type"];
    $issue_date=date("d/m/y");
    $return_date=date("d/m/y", strtotime(date("m/d/y").'+15 days'));

    $sql=$conn->query("select book_name from books_data where book_id=$book_id");
    $bn=$sql->fetch_all();
    $book_name=$bn[0][0];
    
    $conn->query("INSERT INTO `return_data`(`member_id`, `book_id`, `book_name`,`issue_date`,`return_date`) VALUES ($member_id,$book_id,\"$book_name\",\"$issue_date\",\"$return_date\");");
    $conn->query("UPDATE `books_data` SET `copies`=`copies`-1 WHERE book_id=$book_id");
    if($type==1){
        $conn->query("UPDATE `student_data` SET `books_issued`=`books_issued`+1 WHERE member_id=$member_id");
    }
    else{
        $conn->query("UPDATE `faculty_data` SET `books_issued`=`books_issued`+1 WHERE member_id=$member_id");
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
        location.replace("book_issued.php");
    </script>
</head>
<body>
    
</body>
</html>