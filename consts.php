<?php
$cart =  [];
require_once "./core/DBC.php";

$DBC = new DBC();
$products = $DBC->get('products');