<?php
include "./core/DBC.php";
$db = new DBC();
$db->set('users',[
    [
        'id' => 1,
        'name' => 'zeko',
    ],
    [
        'id' => 2,
        'name' => 'ali',
    ],
]);
$users = $db->get('users');
foreach ($users as $user) {
    echo $user['name'] ."<br>";
}

$db->remove('users',4);


$users = $db->get('users');
foreach ($users as $user) {
    echo $user['name'] ."<br>";
}