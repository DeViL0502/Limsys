<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database="limsys";
    
    $conn = new mysqli($servername, $username, $password,$database);
    $sql1="select book_id,book_name from books_data where book_name='".$_GET['name']."';";
    $result1=$conn->query($sql1);
    $data=$result1->fetch_all();
    session_start();
    $member_id=$_SESSION["member_id"];
    $sql2="select books_issued,total_fine from student_data where admission_number='$member_id'";
    $result2=$conn->query($sql2);
    $data2=$result2->fetch_all();
    $issue_date=date("y-m-d");
    $return_date=date("y-m-d", strtotime(date("y-m-d").'+15 days'));
    if($data2[0][1]>0){
        echo "<script>alert('Cannot issue book before paying fine')</script>";
    }
    else if($data2[0][0]>=5){
        echo "<script>alert('Cannot issue more than 5 books')</script>";
    }
    else{
        $sql3="insert into issue_data(admission_number,book_id,book_name,issue_date,return_date,fine) values('$member_id','".$data[0][0]."','".$data[0][1]."','$issue_date','$return_date',0)";
        $conn->query($sql3);
        $conn->query("UPDATE `books_data` SET `copies`=`copies`-1 WHERE book_id=".$data[0][0]."");
        $conn->query("UPDATE `student_data` SET `books_issued`=`books_issued`+1 WHERE admission_number='$member_id'");
        echo "<script>alert('Book Issued')</script>";
    }
    echo "<script>location.href='homepage.php'</script>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="final_issue.css">
</head>
<body>
    
</body>
</html>