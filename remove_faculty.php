<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database="limsys";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password,$database);

	$sql1="select member_id from faculty_data;";
	$result1=$conn->query($sql1);
    $sql2="select name from faculty_data;";
	$result2=$conn->query($sql2);
    $sql4="select gender from faculty_data;";
	$result4=$conn->query($sql4);
    $sql5="select email_id from faculty_data;";
	$result5=$conn->query($sql5);
    $sql6="select mobile_number from faculty_data;";
	$result6=$conn->query($sql6);

    $id=$result1->fetch_all();
    $name=$result2->fetch_all();

    $gender=$result4->fetch_all();

    $eid=$result5->fetch_all();
    $mn=$result6->fetch_all();

    if(isset($_POST["MemberId"])){
        $member_id=$_POST["MemberId"];
        $n=strtoupper($_POST["StudentName"]);
        $sql="DELETE FROM `faculty_data` WHERE member_id=$member_id AND name=\"$n\";";;
        $conn->query($sql);
        if($conn->affected_rows==0){
            echo "<script>alert('Invalid Credentials!!')</script>";
        }
        else{
            echo "<script>window.location=window.location</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Remove</title>
    <script>
        function validateForm(){
            if(confirm("Confirm want to remove faculty") == true){
                return true;
            }
            else{
                return false;
            }
        }
    </script>
</head>
<link rel="stylesheet" href="admin_remove_faculty.css">
<body>
    <div class="head">
        <img src="ic_logo2.svg" alt="">
        <h1>Limsys Library</h1>
    </div>
    <div class="top">

    </div>
    <div class="box">
        <h1>Remove Faculty</h1>
        <div class="box2">
            <form name="RegForm" action="" onsubmit="return validateForm()" method="post">
                <label for="MemberId">Member Id</label><br>
                <input type="number" name="MemberId" id="member_id" required><br>
                <label for="StudentName">Faculty Name</label><br>
                <input type="text" name="StudentName" id="student_name" required>
                <input type="submit" value="Remove Faculty">
            </form>
        </div>
        <div class="box3">
            <table>
                <tr>
                    <th>Member Id</th>
                    <th>Faculty Name</th>
                </tr>
            </table>
            <?php
                echo "<script>let table=document.querySelector('table');let tbody=table.createTBody();</script>";
                for($i=0;$i<count($id);$i++)
                {
                    echo "<script>trow=tbody.insertRow();</script>";
                    echo "<script>trow.innerHTML='<td>".$id[$i][0]."</td><td>".$name[$i][0]."</td>';</script>";
                }
            ?>
        </div>
    </div>
    <div class="tags">
        <img src="admin_logo_m.jpg">       <!-- For Male Admin Profle Pic-->

        <!-- 
        <img src="admin_logo_f.png">        For Female Admin Profle Pic
        -->
        <p>Admin</p>
        <p>Deepraj Anil Pagare</p>
        <a href="admin_homepage.php" style="text-decoration: none;">
            <h3>Home</h3>
        </a>
        <a href="admin_books.php" style="text-decoration: none;">
            <h3>Books</h3>
        </a>
        <a href="return_data.php" style="text-decoration: none;">
            <h3>Return Data</h3>
        </a>
        <a href="index.php" style="text-decoration: none;">
            <h3>Logout</h3>
        </a>
    </div>
</body>
</html>