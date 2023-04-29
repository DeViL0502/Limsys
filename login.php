<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require './PHPMailer/src/Exception.php';
    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database="limsys";
	
	$conn = new mysqli($servername, $username, $password,$database);
    session_start();

    $display="none";
    $loginDisplay="block";
    $animationLogin="none";
    $animationForgot="none";
	$sql1="select admission_number from student_data;";
	$result1=$conn->query($sql1);
    $sql2="select password from student_data;";
	$result2=$conn->query($sql2);
    $s_id=$result1->fetch_all();
    $s_p=$result2->fetch_all();
    if(isset($_POST["username"]) && isset($_POST["pass"])){
        $member_id=$_POST["username"];
        $pass=$_POST["pass"];
        $ret5=$conn->query("select return_date,book_name from issue_data where admission_number='$member_id'");
        $r5=$ret5->fetch_all();
        for($i=0;$i<count($s_id);$i++)
        {
            if($member_id==$s_id[$i][0] && password_verify($_POST["pass"],$s_p[0][0]))
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
        if($member_id==11001 and $pass=="Admin@169")
        {
            echo "<script> location.replace('admin_homepage.php')</script>";
            $_SESSION["member_id"]=$member_id;
        }
        else
        echo "<script> alert('Member Id Not Registered!!') </script>";
    }
    function showForgotPage(){
        $GLOBALS['display']="block";
        $GLOBALS['loginDisplay']="none";
        $GLOBALS['animationForgot']="slide 0.5s";
    }
    function showLoginPage(){
        $GLOBALS['display']="none";
        $GLOBALS['loginDisplay']="block";
        $GLOBALS['animationLogin']="slide 0.5s";
    }
    if (isset($_GET['forgot'])) {
        showForgotPage();
    }
    if (isset($_GET['login'])) {
        showLoginPage();
    }
    $otp=rand ( 10000 , 99999 );
    $err="";
    if(isset($_POST['mnum'])){
        $em=$conn->query("select email_id from student_data where email_id='".$_POST['mnum']."'");
        $r6=$em->fetch_all();
        if(count($r6)>0){
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->SMTPAuth=true;
            $mail->Username='pagaredeepraj05@gmail.com';
            $mail->Password='kmabxsfwmigkvshx';
            $mail->SMTPSecure='ssl';
            $mail->Port=465;
            $mail->setFrom('pagaredeepraj05@gmail.com');
            $mail->addAddress($_POST["mnum"]);
            $mail->isHTML(true);
            $mail->Body="OTP to Reset your password is: ".$otp;
            $mail->Subject="Limsys Library";
            $mail->send();
            $_SESSION['otp']=$otp;
            $_SESSION['email']=$_POST['mnum'];
            echo "<script>location.href='reset_pass.php'</script>";
        }
        else{
            $err='Email id not registered';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<link rel="stylesheet" href="login_pg.css">
<body>
    <div class="outer">
        <div class="inner-box">
            <div class="image-box">
                <img src="limsys_logo.png" alt="" class="limsys_logo">
                <img src="login_sticker.jpg" alt="" class="logo">
                <div class='social-logo'>
                <img src="https://www.nicepng.com/png/full/356-3563301_instagram-instagram-circle-icon.png" alt="" class="insta-logo"/>
                <img src="https://cdn4.iconfinder.com/data/icons/social-media-icons-the-circle-set/48/twitter_circle-512.png" alt="" class="twitter-logo"/>
                <img src="https://www.edigitalagency.com.au/wp-content/uploads/Facebook-logo-blue-circle-large-transparent-png.png" alt="" class="facebook-logo"/>
            </div>
            </div>
            <div class="box" style="display: <?php echo $loginDisplay ?>;animation: <?php echo $animationLogin ?>">
                <h1 id="head">Login</h1>
                    <img src="username_logo.png" alt="" class="username_logo">
                    <img src="pass_logo.png" alt="" class="pass_logo">
                <form action="" name="LogForm" method="POST">
                    <label for="username">Member Id</label><br>
                    <input type="text" name="username" id="username" required><br>
                    <label for="pass" class="pass">Password</label><br>
                    <input type="password" name="pass" id="pass" required>
                    <input type="submit" value="LOGIN" id="button1">
                </form>
                <a href='login.php' style="text-decoration: none;">
                    <h2 id="forgot">Forgot Password?</h2>
                </a>
                <p class="existing">Not an existing user?</p>
                <a href="reg_student.php" class="reg_btn">Register</a>
            </div>
            <div class="forgot-box" style="display: <?php echo $display ?>;animation: <?php echo $animationForgot ?>">
                <h1 id="head">Forgot Password</h1>
                <form action="" name="ForgotForm" method="POST">
                    <label for="mnum" class="no">Registered Email ID</label><br>
                    <input type="text" name="mnum" id="mnum" required><br>
                    <input type="submit" value="Send OTP" id="button2">
                </form>
                <p class="forgot-existing">Not Registered?</p>
                <a href="reg_student.php" class="for_btn">Register Here</a>
                <p id="inv_mail"><?php echo $err?></p>
            </div>
        </div>
    </div>
</body>
</html>