<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database="limsys";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password,$database);
  session_start();

  

  if(isset($_POST["CollegeId"])){
    $member_id=$_POST["CollegeId"];
    $pass=$_POST["Password"];
    $st_name=strtoupper($_POST["StudentName"]);
    $email_id=$_POST["EmailId"];
    $mb=$_POST["MobileNumber"];
    $class=strtoupper($_POST["Class"]);

    $sql = "INSERT INTO `student_data`(`member_id`, `password`, `name`, `email_id`, `mobile_number`, `class`, `gender`) VALUES ($member_id,\"$pass\",\"$st_name\",\"$email_id\",\"$mb\",\"$class\");";
    $sql2= "SELECT member_id FROM faculty_data WHERE member_id=$member_id;";
    $st_id=$conn->query($sql2);
    $result=$st_id->fetch_assoc();
    if(is_null($result)){
      try {
        $conn->query($sql);
        $_SESSION["member_id"]=$member_id;
        echo "<script> alert('Registration Successfull!!') </script>" ;
        echo "<script> window.location='homepage.php';</script>";
        $_SESSION["member_id"]=$member_id;
        $_SESSION["type"]=1;
      }
      catch (Exception $e) {
        echo "<script> alert('Member Id Already Registered!!Click to Login') </script>";
        echo "<script> window.location='login.php';</script>";
      }
    }
    else{
      echo "<script> alert('Member Id Already Registered!!Click to Login') </script>";
      echo "<script> window.location='login.php';</script>";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register</title>
  <script>
    function validateForm(){
      var MemberId=document.RegForm.MemberId.value;
      var Password=document.RegForm.Password.value;
      var StudentName=document.RegForm.StudentName.value;
      var EmailId=document.RegForm.EmailId.value;
      var MobileNumber=document.RegForm.MobileNumber.value;
      var Class=document.RegForm.Class.value;
      var Gender=document.RegForm.Gender.value;
      var format1 = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
      var format2 = /[abcdefghijklmnopqrstuvwzyzABCDEFGHIJKLMNOPQRSTUVWXYZ]+/;
      var format3 = /[1234567890]+/;

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
      if (EmailId == ""){
        alert("Enter Email ID");
        return false;
      }
      if (MobileNumber.length !=10){
        alert("Invalid Mobile Number");
        return false;
      }
      if (Class == ""){
        alert("Enter Class");
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
            <input type="number" name="CollegeId" id="username"><br>
            <label for="pass" id="ps">Password</label><br>
            <input type="password" name="Password" id="pass">
            <label for="name" id="sn">Student Name</label><br>
            <input type="text" name="StudentName" id="name"><br>
            <label for="email" id="mi">Email Id</label><br>
            <input type="text" name="EmailId" id="email"><br>
            <label for="m_number" id="mn">Mobile Number</label><br>
            <input type="text" name="MobileNumber" id="m_number" ><br>
            <label for="class" id="cs">Class</label><br>
            <input type="text" name="Class" id="class" placeholder="FY-B"><br>
            <!-- <label id="gender">Gender</label>
            <input type="radio" id="male" name="Gender" value="MALE" >
            <label for="male" id="m">MALE</label>
            <input type="radio" id="female" name="Gender" value="FEMALE">
            <label for="female" id="f">FEMALE</label>
            <input type="radio" id="other" name="Gender" value="OTHER">
            <label for="other" id="o">OTHER</label> -->
            <input type="submit" value="REGISTER" id="button2">
        </form>
    </div>
</body>
</html>