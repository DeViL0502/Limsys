<?php
$servername = "localhost";
$username = "root";
$password = "";
$database="limsys";

$conn = new mysqli($servername, $username, $password,$database);
session_start();

$member_id=$_SESSION["member_id"];
$date=date("y-m-d");
$num=0;

$ret5=$conn->query("select return_date,book_name,fine from issue_data where admission_number='$member_id' and return_date<'$date'");
$r5=$ret5->fetch_all();
if(count($r5)==0){
    $display="display:none";
}
else{
    $bookData=$conn->query("select author,img from books_data where book_name='".$r5[0][1]."'");
    $bd=$bookData->fetch_all();
    $tf=0;
    for($i=0;$i<count($r5);$i++){
        $today_month_name = date("F", mktime(0, 0, 0,(int) substr($date,3,5), 10));
        $return_month_name = date("F", mktime(0, 0, 0,(int) substr($r5[$i][0],3,5), 10));
        $diff=((strtotime(''.$today_month_name.' '.substr($date,6,8).', 20'.substr($date,0,2).'')-strtotime(''.$return_month_name.' '.substr($r5[$i][0],6,8).', 20'.substr($r5[$i][0],0,2).''))/86400);
        $fine="UPDATE issue_data SET fine=".$diff*0.5." WHERE book_name='".$r5[$i][1]."'";
        $sql=$conn->query($fine);
       $tf=$tf+($diff*0.5);
    }
    $total_fine="UPDATE `student_data` SET `total_fine`=".$tf." WHERE admission_number='".$member_id."';";
    $conn->query($total_fine);
    $display="display:flex";
}

if(isset($_POST["search"])){
    $book_name=$_POST["search"];
    $add = "INSERT INTO `search_data`(`admission_number`, `book_name`, `date`) VALUES (\"$member_id\",\"$book_name\",\"$date\");";
    $conn->query($add);
    $_SESSION['search-name']=$book_name;
    echo "<script> location.replace('search_pg.php') </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <script>
        function popupClose(){
            document.getElementById("popup").style.display="none";
        }
    </script>
</head>
<link rel="stylesheet" href="homepage.css">
<link rel="stylesheet" href="universal.css">
<body>
    <div class="popup" id="popup" style=<?php echo $display?>>
        <img src="<?php echo $bd[0][1] ?>.jpg" alt="" class="popup-book-img">
        <div class="popup-innerBox">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8f/Flat_cross_icon.svg/1024px-Flat_cross_icon.svg.png" alt="" class="popup-cross"  onclick="return popupClose()">
            <h1 class="popup-head">Return Date Expired</h1>
            <?php
                echo "<h3 class='popup-name'>".$r5[0][1]."</h3>";
            ?>
            <h3 class="popup-author"><?php echo $bd[0][0] ?></h3>
            <h3 class="popup-fine">Fine: ₹<?php echo $r5[0][2] ?></h3>
            <p class="popup-text">You have to pay fine for late return. If not paid cannot issue another book. </p>
        </div>
    </div>
    <div class="navbar">
        <div class="nav1">
            <img src="limsys_logo.png" alt="" class="limsys_logo">
            <h1 class="nav-name">Limsys</h1>
            <form action="" method="POST" name="searchInput">
                <input type="text" placeholder="Search" class="search-bar" name="search" id="search">
                <button class="form-button">
                    <div class="search-btn">
                        <img src="search-icon.png" alt="" class="search-icon">
                    </div>
                </button>
            </form>
        </div>
        <div class="nav2">
            <div class="nav-tabs">
                <a class="tab" href="homepage.php" style="color: black;font-weight:600">HOME</a>
                <a class="tab" href="profile.php">PROFILE</a>
                <a class="tab" href="books.php">ISSUED</a>
                <a class="tab" href="history.php">HISTORY</a>
                <a class="tab" href="about.php">ABOUT</a>
            </div>
        </div>
    </div>
    <div class="mid-box">
        <img src="homepage-image.jpg" alt="" class="homepage-img">
        <p class="quote">The library is the temple of learning, and learning has liberated more people than all the wars in history.</p>
    </div>
    <div class="head-box">
        <p class="category-head">Books Category</p>
    </div>
    <div class="category-box">
        <a href="loading_page.php?name=comp"><div class="branch-box">
            <img src="comp.png" alt="" class="branch-img">
            <p class="branch-text">Computer</p>
        </div></a>
        <a href="loading_page.php?name=it"><div class="branch-box">
            <img src="it.jpg" alt="" class="branch-img">
            <p class="branch-text">IT</p>
        </div></a>
        <a href="loading_page.php?name=extc"><div class="branch-box">
            <img src="extc.png" alt="" class="branch-img">
            <p class="branch-text">EXTC</p>
        </div></a>
        <a href="loading_page.php?name=mech"><div class="branch-box">
            <img src="mechanical.png" alt="" class="branch-img">
            <p class="branch-text">Mechanical</p>
        </div></a>
        <a href="loading_page.php?name=civil"><div class="branch-box">
            <img src="civil.jpg" alt="" class="branch-img">
            <p class="branch-text">Civil</p>
        </div></a>
        <a href="loading_page.php?name=ebook"><div class="branch-box">
            <img src="ebook.png" alt="" class="branch-img">
            <p class="branch-text">Ebooks</p>
        </div></a>
    </div>
    <div class="footer">
        <div class="foo1">
            <img src="limsys_logo.png" alt="" class="footer_logo">
            <h1 class="foo-name">Limsys</h1>
            <div class='social-logo'>
                <a href="https://www.instagram.com/pillaiscollege/"><img src="https://www.nicepng.com/png/full/356-3563301_instagram-instagram-circle-icon.png" alt="" class="insta-logo"/></a>
                <a href="https://twitter.com/pillaiscollege"><img src="https://cdn4.iconfinder.com/data/icons/social-media-icons-the-circle-set/48/twitter_circle-512.png" alt="" class="twitter-logo"/></a>
                <a href="https://www.facebook.com/pillaicollege"><img src="https://www.edigitalagency.com.au/wp-content/uploads/Facebook-logo-blue-circle-large-transparent-png.png" alt="" class="facebook-logo"/></a>
            </div>
        </div>
        <div class="foo2">
            <div class="projectby">
                <p class="foo2-head">Project By</p>
                <p class="foo2-item" style="margin-top: 10px;">Deepraj Pagare</p>
                <p class="foo2-item">Shruti Patil</p>
                <p class="foo2-item">Swaraj Naralkar</p>
            </div>
            <div class="projectby">
                <p class="foo2-head">Support</p>
                <p style="margin-top: 10px;"><a href="mailto:dpagare21comp@student.mes.ac.in" class="foo2-item">dpagare21comp@student.mes.ac.in</a></p>
                <p><a href="mailto:shrutis21comp@student.mes.ac.in" class="foo2-item">shrutis21comp@student.mes.ac.in</a></p>
                <p><a href="mailto:snaralkar21comp@student.mes.ac.in" class="foo2-item">snaralkar21comp@student.mes.ac.in</a></p>
            </div>
            <div class="projectby" style="width: 37%;">
                <p class="foo2-head">Location</p>
                <p style="margin-top: 10px;width:90%"><a href="https://goo.gl/maps/568aA67ydMaCWZhr9" class="foo2-item">Dr. K. M. Vasudevan Pillai Campus, Plot No. 10, Sector 16, New Panvel East, Navi Mumbai, Maharashtra 410206</a></p>
            </div>
        </div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3772.669434283395!2d73.12548141489991!3d18.990200987137168!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7e866de88667f%3A0xc1c5d5badc610f5f!2sPillai%20College%20of%20Engineering%2C%20New%20Panvel!5e0!3m2!1sen!2sin!4v1674372496022!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="map"></iframe>
    </div>
</body>
</html> 