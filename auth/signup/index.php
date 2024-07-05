<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>موبي شوب</title>
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
</head>

<body>
    <form action="http://localhost/web/database.php" method="post" >
        <a href="/web">
            <img src="../../assets/images/logo.png" alt="logo" width="150px">
        </a>
        <br>
        <h1>حساب جديد</h1>
        <p>يرجي ادخال البيانات الخاصة بك للإنظمام</p>
        <br>
        <div>
            الإسم الاول :
            <input name="first_name" placeholder="Ali" type="text">
            <br />
            الإسم الثاني :
            <input name="last_name" type="text" placeholder="Ahmed">
            <br />
            البريد الإلكتروني :
            <input name="email" type="email" placeholder="example@gmail.com">
            <br />
            كلمة السر :
            <input name="password" type="password">
        </div>
        <br>
        <input id="submit" type="submit" name="signup" value="إنشاء حساب">
        <br>
        <a href="http://localhost/web/auth/login/" style="text-decoration: none;">لديك حساب من قبل؟ تسجيل الدخول</a>
    </form>
</body>

</html>