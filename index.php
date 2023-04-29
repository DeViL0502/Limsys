<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Limsis</title>
    <script>
        function navigate(){
            location.href="login.php";
        }
    </script>
</head>
<link rel="stylesheet" href="index.css">
<body>
    <div class="outer">
        <div class="inner-box" id="popup-box">
            <img src="welcome_image.jpg" alt="image" class="welcome-img">
            <h1 class="welcome-head">LIMSYS</h1>
            <p class="welcome-subhead">My Digital Library</p>
            <p class="welcome-quote"><img src="https://www.pngall.com/wp-content/uploads/4/Quotation-Symbol-PNG.png" alt="" class="welcome-quote-img1">Libraries store the energy that fuels the imagination. They open up windows to the world and inspire us to explore and achieve, and contribute to improving our quality of life.
            <img src="https://www.pngall.com/wp-content/uploads/4/Quotation-Symbol-PNG.png" alt="" class="welcome-quote-img2"></p>
            <button class="welcome-btn" onclick="return navigate()">Login / Register</button>
        </div>
    </div>
</body>
</html>