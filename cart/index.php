<?php


session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_SESSION['cart']) ) {
    header('Location: http://localhost/web');
    exit;
}

$cart = $_SESSION['cart'];
$_SESSION['cart'] = [];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>موبي شوب</title>
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
</head>
<body>
    <h1>تمت عملية الدفع بنجاح! </h1> 
    <div class="conanier">
       <div class="headCont">
        <img src="https://i.pinimg.com/474x/b5/4c/e1/b54ce1bf5679515d1a062c85037eeb1c.jpg" loading="lazy" alt="">
        <div class="conent">
            <h2><?php echo $_SESSION['first_name'] . " ".$_SESSION['last_name']; ?></h2>
            <p>Payment checkout</p>
        </div>
       </div>
<div class="divider">
</div>
       <ul>
        <?php 
        
foreach ($cart as $key => $value) {
    echo <<<EOD
        <li>
            <div>
                <h3>{$value['name']}</h3>
                <p>{$value['price']}$</p>
            </div>
            <img  src="{$value['image']}" alt="">
        </li>
    EOD;
}

        ?>

  
       </ul>
    </div> 
    <a href="/web" class="button" type="button">الصفحة الرئيسية</a>
</body>
</html>