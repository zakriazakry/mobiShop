<?php
session_start();
require_once "../../core/DBC.php";

// Check if user is already logged in
$loggedIn = isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true;
if ($loggedIn) {
    header('Location: http://localhost/web');  // Redirect if already logged in
    exit;
}

$msg = "";

if (isset($_POST['signup'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
        $msg = "يرجى ملء جميع الحقول";
    } else {
        // $expiry = time() + (30 * 24 * 60 * 60);
        // $users = json_decode($_COOKIE['users'], true);
        $dbc =new DBC();
        $users = $dbc->get('users');

        $emailExists = false;
        foreach ($users as $user) {
            if ($user['email'] == $email) {
                $emailExists = true;
                break;
            }
        }

        if ($emailExists) {
            $msg = "البريد الإلكتروني مسجل مسبقًا";
        } else {
            $user = [
                "first_name" => $first_name,
                "last_name" => $last_name,
                "email" => $email,
                "password" => $password
            ];
            $dbc->add('users',$user);
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['email'] = $email;
            $_SESSION['loggedIn'] = true;
            header('Location: http://localhost/web');
            exit;
        }
    }
}
?>
<style>
    .error {
        padding: 10px 15px;
        margin: 10px;
        border-radius: 10px;
        color: white;
        font-weight: bold;
        background-color: rgba(208, 63, 63, 0.7);

    }
</style>

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
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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
        <?php
        if (!empty($msg)) {
            echo "<div class='error'>
            {$msg}
            </div>";
        }

        ?>
        <br>
        <input id="submit" type="submit" name="signup" value="إنشاء حساب">
        <br>
        <a href="http://localhost/web/auth/login/" style="text-decoration: none;">لديك حساب من قبل؟ تسجيل الدخول</a>
    </form>
</body>

</html>