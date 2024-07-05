<?php
session_start();

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>موبي شوب</title>
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
</head>

<body>
 
    <form action="http://localhost/web/database.php" method="post">
        <a href="/web">
            <img src="../../assets/images/logo.png" alt="logo" width="150px">
        </a>
        <br>
        <h1>تسجيل الدخول</h1>
        <p>يرجي ادخال البيانات الخاصة بك للمتابعة</p>
        <br>
        <div>
            البريد الإلكتروني :
            <input type="email" name="email">
            <br />
            <br />
            كلمة السر :
            <input type="password" name="password">
        </div>
        <br>
        <input id="submit" type="submit" name="login" value="تسجيل الدخول">
        <br>
        <a href="http://localhost/web/auth/signup/" style="text-decoration: none;">إنشاء حساب جديد</a>
    </form>
</body>

</html>