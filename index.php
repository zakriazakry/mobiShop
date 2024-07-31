<?php
include "./consts.php";
session_start();

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

$loggedIn = isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true;
if (isset($_POST['addCart'])) {
  if (!$loggedIn) {
    header('Location: http://localhost/web/auth/login');
    exit;
  }

  $product = [
    'id' =>$_POST['id'],
    'name' =>$_POST['name'],
    'description' =>$_POST['description'],
    'price' =>$_POST['price'],
    'image' =>$_POST['image']
     
  ];

  $productExists = false;
  foreach ($_SESSION['cart'] as $cartProduct) {
    if ($cartProduct['id'] == $product['id']) {
      $productExists = true;
      break;
    }
  }

  if (!$productExists) {
    $_SESSION['cart'][] = $product;
  }
}

if ((isset($_POST['logout']) && isset($_SESSION['timeLogin'])) || (isset($_SESSION['timeLogin']) && (time() > $_SESSION['timeLogin']))) {
  session_unset();
  session_destroy();
  header('Location: /web');
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
  <link rel="stylesheet" href="./style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
</head>
<body>
  <!-- nav bar start -->
  <nav>
    <a id="logo" href="/web">
      <?php
      if (!$loggedIn) {
        echo "
        <img src='./assets/images/logo.png' alt='logo' width='100px'>
        ";
      } else {
        echo <<<EOD
        <img id='profileImg' src='https://i.pinimg.com/474x/b5/4c/e1/b54ce1bf5679515d1a062c85037eeb1c.jpg'>
        {$_SESSION['first_name']} {$_SESSION['last_name']}
        
        EOD;
      }

      ?>
    </a>
    <ul>
      <a href="#hero">الرئيسي</a>
      <a href="#productsSec">المنتجات</a>
      <a href="#about">حولنا</a>
      <a href="https://web.whatsapp.com/send?phone=218942667816">تواصل معنا</a>
    </ul>
    <?php
    if (isset($_SESSION["email"])) {
      $count = count($_SESSION['cart']) ?? 0;
      echo "<form action='{$_SERVER['PHP_SELF']}' method='post'> ";
      echo "<div class='cartHoverWrapper'> 
               ({$count}) <i class='fa-solid fa-cart-shopping cartHover'></i> 
              <input class='buttonBorder' type='submit' name='logout' value='تسجيل الخروج'> 
              </form>
                ";

      if (!empty($_SESSION['cart'])) {
        echo "
          <div class='cart cartHover'>
              <ul>";
        foreach ($_SESSION['cart'] as $key => $value) {
          echo "<li>
                    <img src={$value['image']} width='60px' alt=''>
                    <div class='cartdetails'>
                    <p>{$value['name']}</p>
                    <p>{$value['price']} $</p>
                  </div>
                </li>";
        }

        echo  "
              </ul>
              <form action='http://localhost/web/cart/index.php' method='post'>
                <input type='submit' value='إتمام الشراء' name='submit' class='button'/>
          </div>";
      }

      echo "
              </div>";
      echo '</form>';
    } else {
      echo <<<EOD
        <div> 
            <a class='buttonBorder' href='http://localhost/web/auth/signup/'>حساب جديد</a>
            <a class='button' href='http://localhost/web/auth/login/'>تسجيل الدخول</a>
        </div>
        EOD;
    }
    ?>
  </nav>
  <div>
    <!-- nav bar end -->
    <!-- Hero start  -->
    <div id="hero" class="hero">
      <div class="content">
        <img src="https://www.freepnglogos.com/uploads/apple-logo-png/apple-logo-png-index-content-uploads-10.png">
        <h1>افضل العروض </br>من متجر <span>موبي شوب!</span></h1>
        <p>
          iPhone 15 Pro Max من Apple بسعة 256 جيجا وشاشة 6.7 بوصة.
          كاميرا خلفية متعددة العدسات بدقة 48 + 12 + 12 ميجابيكسل وكاميرا أمامية بدقة 12 ميجابيكسل.
          مميزات الكاميرا تشمل وضع الليل وبانوراما بدقة تصل إلى 63 ميجابيكسل ونظام مزدوج لاستقرار الصورة البصري.
          نظام التشغيل: iOS 17.
          دعم شبكات 5G وتقنيات الاتصال بلوتوث وواي فاي وNFC.
          سلسلة الموديل: أبل ايفون 15 ونوع الشريحة نانو.</p>

        <div>
          <a class="button" href=""> اشتري الان! <span>s</span> <i class="fa-brands fa-opencart"></i></a>
        </div>
        <div class="soical">
          <i class="fa-brands fa-facebook"></i>
          <i class="fa-brands fa-whatsapp"></i>
          <i class="fa-brands fa-instagram"></i>

        </div>
      </div>
      <img src="./assets/images/Hero.png" alt="logo" width="900px">
    </div>
    <!-- Hero end  -->
    <div class='divider'></div>
    <br>
    <!-- Products start  -->
    <center>
      <h1 id="productsSec">كل المنتجات</h1>
      <p>اكثر من <?php echo count($products) ?> منتج مميز لك خصصياً</p>
    </center>
    <br>
    <div class="Products">
    <?php
foreach ($products as $product) {
    $productID = $product['id'];
    $productName = $product['name'];
    $productDescription = $product['description'];
    $productPrice = $product['price'];
    $productImage = $product['image'];

    echo <<<EOD
    <div class="card">
        <a href="http://localhost/web/product/index.php?id=$productID&name={$productName}&description={$productDescription}&price={$productPrice}&image={$productImage}">
            <img src="{$productImage}" alt="{$productName}">
            <h3>{$productName}</h3>
            <p>{$productDescription}</p>
        </a>
        <div class="row">
            <p>{$productPrice} د.ل</p>
            <form method="POST" action="{$_SERVER['PHP_SELF']}">
                <input type="hidden" name="id" value="{$productID}">
                <input type="hidden" name="name" value="{$productName}">
                <input type="hidden" name="description" value="{$productDescription}">
                <input type="hidden" name="price" value="{$productPrice}">
                <input type="hidden" name="image" value="{$productImage}">
                <input type="submit" name="addCart" class="button" value="إضافة إلى السلة">
            </form>
        </div>
    </div>
    EOD;
}
?>

    </div>



    <br>
    <br>

    <!-- About setion Start-->
    <div id="about">
      <h2>حولنا</h2>
      <p>متجر متخصص في بيع جميع القطع الإلكترونية و كماليات الهواتف من اكسسورات والخ... نتميز بسرعه في التوصيل و اسعارنا الرخيصة</p>
    </div>
    <!-- About setion end -->
<?php include"./footer.php";?>
</body>

</html>