<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database="limsys";
	
	$conn = new mysqli($servername, $username, $password,$database);
    session_start();
    $otp=$_SESSION['otp'];
    if(isset($_POST['otp'])){
        if($otp==$_POST['otp']){
            $sql="UPDATE student_data SET `password`='".$_POST['npass']."' WHERE email_id='".$_SESSION['email']."'";
            $conn->query($sql);
            echo "<script>alert('Successfully Password Changed')</script>";
            echo "<script>location.href='login.php'</script>";
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
    <script>
    function validateForm(){
      var OTP=document.ForgotForm.otp.value;
      var Password=document.ForgotForm.npass.value;
      var ConfirmPassword=document.ForgotForm.cpass.value;
      var format1 = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
      var format2 = /[abcdefghijklmnopqrstuvwzyzABCDEFGHIJKLMNOPQRSTUVWXYZ]+/;
      var format3 = /[1234567890]+/;
      if (Password !=""){
        if(format1.test(Password)==false){
          var pass=document.getElementById('inv_pass');
          pass.innerHTML="Please Enter Numbers,Characters,Special Symbols (@,#,_)";
          return false;
        }
        else if(format2.test(Password)==false){
          var pass=document.getElementById('inv_pass');
          pass.innerHTML="Please Enter Numbers,Characters,Special Symbols (@,#,_)";
          return false;
        } 
        else if(format3.test(Password)==false){
          var pass=document.getElementById('inv_pass');
          pass.innerHTML="Please Enter Numbers,Characters,Special Symbols (@,#,_)";
          return false;
        }
        else if(Password!=ConfirmPassword){
            var pass=document.getElementById('inv_pass');
            pass.innerHTML="Both the password don't match";
            return false;
        } 
        else{
            var pass=document.getElementById('inv_pass');
            pass.innerHTML="";
        }
      }
      if(OTP!=<?php echo $otp?>){
            var otp=document.getElementById('inv_otp');
            otp.innerHTML="Invalid OTP";
            return false;
        }
      return true;
    }
  </script>
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
            <div class="forgot-box">
                <h1 id="head">Forgot Password</h1>
                <form action="" name="ForgotForm" method="POST" onsubmit="return validateForm()">
                    <label for="otp" class="no">OTP</label><br>
                    <input type="number" name="otp" id="otp" required class="reset_field"><br>
                    <label for="npass" class="no">New Password</label><br>
                    <input type="password" name="npass" id="npass" required class="reset_field"><br>
                    <label for="cpass" class="no">Confirm Password</label><br>
                    <input type="password" name="cpass" id="cpass" required class="reset_field"><br>
                    <input type="submit" value="Reset" id="button2" style="margin-top: -10px;">
                    <p class="invalid_otp" id="inv_otp"></p>
                    <p class="invalid_pass" id="inv_pass"></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>