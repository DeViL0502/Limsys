<?php

//fetch.php;

$connect = new PDO("mysql:host=localhost; dbname=limsys", "root", "");

if(isset($_POST['query']))
{
 $query = "
 SELECT * FROM student_data 
 WHERE email_id LIKE '%".trim($_POST["query"])."%'
 ";

 $statement = $connect->prepare($query);

 $statement->execute();

 $result = $statement->fetchAll();

 $output = '';

 foreach($result as $row)
 {
  $output .= '
  <li class="list-group-item contsearch">
   <a href="javascript:void(0)" class="gsearch" style="color:#333;text-decoration:none;">'.$row["email_id"].'</a>
  </li>
  ';
 }

 echo $output;
}
?>