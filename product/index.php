<?php
session_start(); // تأكد من بدء الجلسة

if (isset($_GET['id']) && isset($_GET['name']) && isset($_GET['description']) && isset($_GET['price']) && isset($_GET['image'])) {
    $productID = $_GET['id'];
    $productName = $_GET['name'];
    $productDescription = $_GET['description'];
    $productPrice = $_GET['price'];
    $productImage = $_GET['image'];
} else {
    header('Location: http://localhost/web/');
    exit;
}


?>

<!DOCTYPE html>
<html lang="ar">
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
    <nav>
        <p><a href="/web">المنتجات</a> / <?php echo $productName; ?></p>
        <a href="/web"><img src="../assets/images/logo.png" width="100px" alt="Logo"></a>
    </nav>
    <div class="product">
        <div class="content">
            <img src="https://www.freepnglogos.com/uploads/apple-logo-png/apple-logo-png-index-content-uploads-10.png" alt="Apple Logo">
            <h2><?php echo $productName; ?></h2>
            <p><?php echo $productDescription; ?></p>
            <h2><?php echo $productPrice; ?> د.ل </h2>
            <form action="http://localhost/web/index.php" method="post">
                <input type="hidden" name="id" value="<?php echo $productID; ?>">
                <input type="hidden" name="name" value="<?php echo $productName; ?>">
                <input type="hidden" name="description" value="<?php echo $productDescription; ?>">
                <input type="hidden" name="price" value="<?php echo $productPrice; ?>">
                <input type="hidden" name="image" value="<?php echo $productImage; ?>">
                <input type="submit" name="addCart" class="button" value="إضافة الي السلة">
            </form>
        </div>
        <img src="<?php echo $productImage; ?>" alt="Product Image">
    </div>

    <div class="map">
        <h2>موقع المتجر</h2>
        <p>الزاوية , طريق الصقري , التقنية مول</p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d604.5927638883584!2d12.753746758124795!3d32.76912811247205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13a9213a2132cbaf%3A0x8af283154c2f12fe!2z2KfZhNiq2YLZhtmK2Kkg2YXZiNmEIC0gVGVjaCBNYWxs!5e0!3m2!1sar!2sly!4v1720383572439!5m2!1sar!2sly" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <?php include "../footer.php"; ?>
</body>
</html>
