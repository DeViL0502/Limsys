<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database="limsys";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password,$database);
    session_start();

	$sql1="select member_id from student_data;";
	$result1=$conn->query($sql1);
    $sql2="select password from student_data;";
	$result2=$conn->query($sql2);
    $s_id=$result1->fetch_all();
    $s_p=$result2->fetch_all();
    if(isset($_POST["username"]) && isset($_POST["pass"])){
        $member_id=$_POST["username"];
        $pass=$_POST["pass"];
        $ret5=$conn->query("select return_date,book_name from return_data where member_id=$member_id");
        $r5=$ret5->fetch_all();
        for($i=0;$i<count($s_id);$i++)
        {
            if($member_id==$s_id[$i][0] && $pass==$s_p[$i][0])
            {
                $_SESSION["member_id"]=$member_id;
                $type=1;
                $_SESSION["type"]=$type;
                for($j=0;$j<count($r5);$j++){
                    if($r5[$j][0]>date("d/m/y"))
                    {
                        echo "<script>alert('Return date expired for ".$r5[$j][1]."</script>";
                    }
                }
                echo "<script> location.replace('homepage.php')</script>";
            }
            else if($member_id==$s_id[$i][0] && $pass!=$s_p[$i][0])
            {
                echo "<script> alert('Wrong Password!!') </script>";
                echo "<script> location.replace('login.php')</script>";
            }
        }
        $sql3="select member_id from faculty_data;";
        $result3=$conn->query($sql3);
        $sql4="select password from faculty_data;";
        $result4=$conn->query($sql4);
        $f_id=$result3->fetch_all();
        $f_p=$result4->fetch_all();
        for($i=0;$i<count($f_id);$i++)
        {
            if($member_id==$f_id[$i][0] && $pass==$f_p[$i][0])
            {
                $_SESSION["member_id"]=$member_id;
                $type=0;
                $_SESSION["type"]=$type;
                for($j=0;$j<count($r5);$j++){
                    if($r5[$j][0]>date("d/m/y"))
                    {
                        echo "<script>alert('Return date expired for ".$r5[$j][1]."</script>";
                    }
                }
                echo "<script> location.replace('homepage.php')</script>";
                
            }
            else if($member_id==$f_id[$i][0] && $pass!=$f_p[$i][0])
            {
                echo "<script> alert('Wrong Password!!') </script>";
                echo "<script> location.replace('login.php')</script>";
            }
        }
        if($member_id==11001 and $pass=="Admin@169")
        {
            echo "<script> location.replace('admin_homepage.php')</script>";
            $_SESSION["member_id"]=$member_id;
        }
        else
        echo "<script> alert('Member Id Not Registered!!') </script>";

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script>
        
    </script>
</head>
<link rel="stylesheet" href="login_pg.css">
<body>
    <div class="outer">
        <div class="inner-box">
            <div class="image-box">
                <img src="login_sticker.jpg" alt="" class="logo">
            </div>
            <div class="box">
                <h1 id="head">Login</h1>
                <form action="" name="LogForm" method="POST">
                    <label for="username">Member Id</label><br>
                    <input type="number" name="username" id="username" required><br>
                    <label for="pass">Password</label><br>
                    <input type="password" name="pass" id="pass" required>
                    <input type="submit" value="LOGIN" id="button1">
                </form>
                <a href="forgot.php" style="text-decoration: none;">
                    <h2 id="forgot">Forgot Password?</h2>
                </a>
                <p class="existing">Not an existing user?</p>
                <a href="reg_student.html" class="reg_btn">Register</a>
            </div>
        </div>
    </div>
</body>
</html>