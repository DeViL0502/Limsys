<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database="limsys";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password,$database);

    if(isset($_POST["username"])){
        $member_id=$_POST["username"];
        $pass=$_POST["pass"];
        $cpass=$_POST["cpass"];
        $sql1 = "UPDATE `student_data` SET `password`=\"$cpass\" WHERE member_id=$member_id;";
        $sql2 = "UPDATE `faculty_data` SET `password`=\"$cpass\" WHERE member_id=$member_id;";
        $q1=$conn->query("select member_id from student_data;");
        $q2=$conn->query("select member_id from faculty_data;");
        $mid1=$q1->fetch_all();
        $mid2=$q2->fetch_all();
        $found=0;
        for($i=0;$i<count($mid1);$i++)
        {
            if($member_id==$mid1[$i][0])
            {
                $found=1;
            }
            }
        for($i=0;$i<count($mid2);$i++)
        {
            if($member_id==$mid2[$i][0])
            {
                $found=1;
            }
        }
        if($found==0){
            echo "<script> alert('Member Not Found!!')</script>";
            echo "<script> window.location=window.location;</script>";
        }
        else{
            try{
                $conn->query($sql1);
                echo "<script> alert('Password Changed!!')</script>";
                echo "<script> window.location='login.php';</script>";
            }
            catch (Exception $e){
                $conn->query($sql2);
                echo "<script> alert('Password Changed!!')</script>";
                echo "<script> window.location='login.php';</script>";
            }
        }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset</title>
    <script>
        function validateForm(){
        var MemberId=document.RegForm.username.value;
        var Password=document.RegForm.pass.value;
        var ConfirmPassword=document.RegForm.cpass.value;
        var format1 = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
        var format2 = /[abcdefghijklmnopqrstuvwzyzABCDEFGHIJKLMNOPQRSTUVWXYZ]+/;
        var format3 = /[1234567890]+/;
        if (Password !=""){
            if(format1.test(Password)==false){
            alert("Please Enter Numbers,Characters,Special Symbols (@,#,_)");
            return false;
            }
            if(format2.test(Password)==false){
            alert("Please Enter Numbers,Characters,Special Symbols (@,#,_)");
            return false;
            } 
            if(format3.test(Password)==false){
            alert("Please Enter Numbers,Characters,Special Symbols (@,#,_)");
            return false;
            } 
        }
        if (Password!=ConfirmPassword){
            alert("Password Don't Match!!");
            return false
        }
        else{
            
            return true;
        }
        }
    </script>
</head>
<link rel="stylesheet" href="forgot.css">
<body>
    <div class="box">
        <h1 id="head">Password Reset</h1>
        <form name="RegForm" action="" onsubmit="return validateForm()" method="post">
            <label for="username">Member Id</label><br>
            <input type="number" name="username" id="username" required><br>
            <label for="pass">New Password</label><br>
            <input type="password" name="pass" id="pass" required>
            <label for="cpass">Confirm New Password</label><br>
            <input type="password" name="cpass" id="cpass" required>
            <input type="submit" value="RESET PASSWORD" id="button2">
        </form>
    </div>
</body>
</html>