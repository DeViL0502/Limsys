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
$sql1=$conn->query("select name,gender,email_id,mobile_number,class from student_data where member_id=$member_id;");
$sql2=$conn->query("select name,gender,email_id,mobile_number from faculty_data where member_id=$member_id;");
if($type==1)
$data=$sql1->fetch_all();
else
$data=$sql2->fetch_all();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<link rel="stylesheet" href="profile.css">
<body>
    <div class="box">
        <img src="https://ui-avatars.com/api/?background=ffc556&name=<?php echo $data[0][0];?>" alt="profile_pic">
        <h1 id="n1">Name</h1>
        <p id="n2"><?php echo $data[0][0] ?></p>
        <h1 id="g1">Gender</h1>
        <p id="g2"><?php echo $data[0][1] ?></p>
        <h1 id="c1">Member Id</h1>
        <p id="c2"><?php echo $member_id ?></p>
        <h1 id="e1">Email Id</h1>
        <p id="e2"><?php echo $data[0][2] ?></p>
        <h1 id="m1">Mobile Number</h1>
        <p id="m2"><?php echo $data[0][3] ?></p>
        <h1 id="class1"></h1>
        <p id="class2"></p>
        <script>
            if(<?php echo "$type" ?>==1)
            {
                class1.innerHTML="Class";
                class2.innerHTML="<?php echo $data[0][4]?>";
            }
        </script>
        <a href="homepage.php">
            <h1 id="button" style="text-decoration: none;">GO TO HOMEPAGE</h1>
        </a>
    </div>
</body>
</html>