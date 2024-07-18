<?php
require_once "../../core/DBC.php";

session_start();
$loggedIn = isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true;
if ($loggedIn) {
    header('Location: http://localhost/web');
    exit;
}

$msg = "";
$dbc =new DBC();
$users = $dbc->get('users');
if (isset($_POST['login']) && isset($users)) {
    $email = $_POST['email'];
    $password  = $_POST['password'];
    $find = false;
    foreach ($users as $user) {
        if ($user['email'] == $email && $password == $user['password']) {
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['loggedIn'] = true;
            header('Location: http://localhost/web');
            exit;
        }
    }
    if (!$find) {
        $msg = "البريد الإلكتروني أو كلمة المرور غير صحيحة";
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>موبي شوب</title>
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="./style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
</head>

<body>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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
        <?php
        if (!empty($msg)) {
            echo "<div class='error'>
            {$msg}
            </div>";
        }

        ?>
        <br>
        <input id="submit" type="submit" name="login" value="تسجيل الدخول">

        <br>
        <a href="http://localhost/web/auth/signup/" style="text-decoration: none;">إنشاء حساب جديد</a>
    </form>
</body>

</html>