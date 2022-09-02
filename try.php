<?php
     $date=date("m/d/y");
     echo date("d/m/y", strtotime($date.'+15 days'));
     $servername = "localhost";
	$username = "root";
	$password = "";
	$database="limsys";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password,$database);
     $sql="select member_id from student_data where member_id=211009;";
     $result=$conn->query($sql);
     $mi=$result->fetch_assoc();
     if(is_null($mi)){
          echo "true";
     }
?>

<script>
            for(var j=0;j<"<?php echo count($books)?>";j++)
            {
                var image=document.createElement("img");
                image.setAttribute("src","<?php echo $books[0][2]?>");
                var h1=document.createElement("h1");
                h1.innerHTML="<?php echo $books[0][0]?>";
                var br=document.createElement("br");
                var h3=document.createElement("h3");
                h3.innerHTML="~ <?php echo $books[0][1]?>";
                var box=document.getElementById("box");
                var form=document.createElement("form");
                form.setAttribute("name","RegForm");form.setAttribute("onsubmit","return validateForm()");
                form.setAttribute("method","POST");
                form.innerHTML="<a href='book_avlb.php'><input type='submit' value='Request'></a>"
                box.appendChild(image);
                box.appendChild(h1);
                box.appendChild(br.cloneNode());
                box.appendChild(h3);
                box.appendChild(form);
                "<?php
                $a= "<script>document.write(j);</script>";
                echo $a;
                ?>";
            }
        </script>


<?php
            for($i=0;$i<count($books_issued);$i++)
            {
                echo "<script>var mid=document.createElement('h1');</script>";
                echo "<script>mid.id='mid';</script>";
                echo "<script>mid.innerHTML='".$books_issued[$i][0]."';</script>";
                echo "<script>var bid=document.createElement('h1');</script>";
                echo "<script>bid.id='bid';</script>";
                echo "<script>bid.innerHTML='".$books_issued[$i][1]."';</script>";
                echo "<script>var bname=document.createElement('h1');</script>";
                echo "<script>bname.id='bname';</script>";
                echo "<script>bname.innerHTML='".$books_issued[$i][2]."';</script>";
                echo "<script>var accept=document.createElement('p');</script>";
                echo "<script>accept.id='accept';</script>";
                echo "<script>accept.setAttribute('onclick','accept()');</script>";
                echo "<script>accept.innerHTML='Accept';</script>";
                echo "<script>var reject=document.createElement('p');</script>";
                echo "<script>reject.id='reject';</script>";
                echo "<script>reject.setAttribute('onclick','reject()');</script>";
                echo "<script>reject.innerHTML='Reject';</script>";
                echo "<script>var br=document.createElement('br');</script>";
                echo "<script>var box=document.getElementById('data');</script>";
                echo "<script>box.appendChild(mid);</script>";
                echo "<script>box.appendChild(bid);box.appendChild(bname);box.appendChild(accept);box.appendChild(reject);box.appendChild(br.cloneNode());</script>";
            }
            ?>
