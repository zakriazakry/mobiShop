<?php
session_start();
include "./consts.php";
// $users = isset($users) ? $users : [];

function login($email, $password, &$users) {
    foreach ($users as $user) {
        if ($user['email'] == $email && $user['password'] == $password) {
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['loggedIn'] = true;
            header('Location: http://localhost/web');
            exit;
        }
    }
    echo "<center>"; 
    echo "<h1>البريد الإلكتروني أو كلمة المرور غير صحيحة</h1>";
    echo "</center>";
}

function signup($first_name, $last_name, $email, $password, &$users) {
    foreach ($users as $user) {
        if ($user['email'] == $email) {
            echo "البريد الإلكتروني مسجل مسبقًا";
            return;
        }
    }
    $user = [
        "first_name" => $first_name,
        "last_name" => $last_name,
        "email" => $email,
        "password" => $password
    ];
    
    $users[] = $user;
    $_SESSION['users'] = $users;
    
    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;
    $_SESSION['email'] = $email;
    $_SESSION['loggedIn'] = true;
    header('Location: http://localhost/web');
    exit;
}

function logout() {
    session_unset();
    session_destroy();
    header('Location: /web');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['signup'])) {
        signup($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password'], $users);
    } elseif (isset($_POST['login'])) {
        login($_POST['email'], $_POST['password'], $users);
    } elseif (isset($_POST['logout'])) {
        logout();
    }
}
?>
