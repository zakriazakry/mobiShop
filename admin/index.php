<?php
require_once "../core/DBC.php";
$DBC = new DBC();
$msg = "";

if (isset($_POST["submit"]) && $_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['ProductName'];
    $decs = $_POST['ProductDesc'];
    $price = $_POST['price'];
    $image = $_FILES['image'];
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $targetFile = $targetDir . basename($image["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $check = getimagesize($image["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $msg =  "الملف ليس صورة";
        $uploadOk = 0;
    }

    if (file_exists($targetFile)) {
        $msg =  " الملف موجود مسبقاً";
        $uploadOk = 0;
    }

    if ($image["size"] > 500000) {
        $msg =  " حجم الملف كبير جداً.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $msg =  " فقط الملفات بصيغ JPG, JPEG, PNG مسموح بها";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $msg =  " لم يتم رفع الملف.";
    } else {
        if (move_uploaded_file($image["tmp_name"], $targetFile)) {
            $msg =  "تم رفع الملف ". basename($image["name"]) . " بنجاح.";

            $products = $DBC->get('products');

            $DBC->add('products', [
                "id" => count($products) + 1,
                "name" => $name,
                "description" => $decs,
                "price" => $price,
                "image" => $targetFile
            ]);
        } else {
            $msg =  " حدث خطأ أثناء رفع الملف.";
        }
    }
}

$products = $DBC->get('products');
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="shortcut icon" href="../assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="./style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
</head>

<body>
    <div class="title">
        <h1>Admin Dashboard</h1>
    </div>
    <div class="content">
        <form action="#" method="post" enctype="multipart/form-data">
            <img src="../assets/images/logo.png" width="140px">
            <div class="file-input-container">
                <label for="image">صورة المنتج</label>
                <input type="file" name="image" id="image" onchange="showFileName(this)" required>
                <div class="file-name" id="file-name">لا يوجد ملف مختار</div>
                <label class="custom-file-label" for="image">اختر ملف</label>
            </div>
            <div>
                اسم المنتج
                <input type="text" name="ProductName" required>
            </div>
            <div>
                وصف للمنتج
                <textarea name="ProductDesc" required></textarea>
            </div>
            <div>
                سعر المنتج
                <input type="text" name="price" required>
            </div>
            
          
            <input type="submit" id="submit" name="submit" value="نشر">
            <?php 
            echo $msg;
            ?>
        </form>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>الصورة</th>
                        <th>الاسم</th>
                        <th>الوصف</th>
                        <th>السعر</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($products as $product) {
                        echo <<<EOD
                            <tr>
                                <td>{$product['id']}</td>
                                <td data-label='الصورة'><img src='{$product['image']}' alt='{$product['name']}' width='100px' higth='140px'></td>
                                <td data-label='الاسم'>{$product['name']}</td>
                                <td data-label='الوصف'>{$product['description']}</td>
                                <td data-label='السعر'>\${$product['price']}</td>
                            </tr>
                            EOD;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function showFileName(input) {
            var fileName = input.files[0] ? input.files[0].name : 'لا يوجد ملف مختار';
            document.getElementById('file-name').textContent = fileName;
        }
    </script>
</body>
</html>
