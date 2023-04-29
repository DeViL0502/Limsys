<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database="limsys";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password,$database);
  session_start();

  if(isset($_POST["username"])){
    $member_id=$_POST["username"];
    $pass=$_POST["pass"];
    $st_name=strtoupper($_POST["name"]);
    $email_id=$_POST["email"];
    $mb=$_POST["m_number"];

    $sql = "INSERT INTO `student_data`(`admission_number`, `password`, `name`, `email_id`, `mobile_number`) VALUES (\"$member_id\",'".password_hash($_POST['pass'],PASSWORD_DEFAULT)."',\"$st_name\",\"$email_id\",\"$mb\");";
    $sql2= "SELECT admission_number FROM student_data WHERE admission_number='$member_id';";
    $st_id=$conn->query($sql2);
    $result=$st_id->fetch_assoc();
    if(is_null($result)){
      try {
        $conn->query($sql);
        $_SESSION["member_id"]=$member_id;
        echo "<script> alert('Registration Successfull!!') </script>" ;
        echo "<script> window.location='homepage.php';</script>";
      }
      catch (Exception $e) {
        echo "<script> alert('Student Already Registered!!') </script>";
        echo "<script> window.location='login.php';</script>";
      }
    }
    echo "<script> alert('Student Already Registered!!') </script>";
    echo "<script> window.location='login.php';</script>";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register</title>
  <script>
    function validateForm(){
      var MemberId=document.RegForm.username.value;
      var Password=document.RegForm.pass.value;
      var StudentName=document.RegForm.name.value;
      var EmailId=document.RegForm.email.value;
      var MobileNumber=document.RegForm.m_number.value;
      var Check=document.RegForm.check;
      var format1 = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
      var format2 = /[abcdefghijklmnopqrstuvwzyzABCDEFGHIJKLMNOPQRSTUVWXYZ]+/;
      var format3 = /[1234567890]+/;
      var emailtest= '@student.mes.ac.in';

      if (MemberId == ""){
        alert("Enter Member ID");
        return false;
      }
      if (Password == ""){
        alert("Enter Password");
        return false;
      }
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
      if (StudentName == ""){
        alert("Enter Student Name");
        return false;
      }
      if (EmailId.substr(-18) != "@student.mes.ac.in"){
        alert("Enter College Email ID");
        return false;
      }
      if (MobileNumber.length !=10){
        alert("Invalid Mobile Number");
        return false;
      }
      if (!Check.checked){
        alert("Please accept the terms and conditions.");
        return false;
      }
      else{
        return true;
      }
    }
  </script>
</head>
<link rel="stylesheet" href="register_pg_student.css">
<body>   
    <div class="box">
        <h1 id="head">Register</h1>
        <form name="RegForm" action="" onsubmit="return validateForm()" method="post">
            <label for="username" id="ci">Admission Number</label><br>
            <input type="text" name="username" id="username" required><br>
            <label for="pass" id="ps">Password</label><br>
            <input type="password" name="pass" id="pass">
            <label for="name" id="sn">Student Name</label><br>
            <input type="text" name="name" id="name"><br>
            <label for="email" id="mi">Email Id</label><br>
            <input type="text" name="email" id="email"><br>
            <label for="m_number" id="mn">Mobile Number</label><br>
            <input type="text" name="m_number" id="m_number"><br>
            <input type="checkbox" name="check" id="check">
            <label for="check" id="check">I accept all terms and conditions</label><br>
            <input type="submit" value="REGISTER" id="button2">
        </form>
    </div>
</body>
</html>