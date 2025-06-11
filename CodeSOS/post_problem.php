<?php


session_start();




include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    
    // حفظ الصورة إن وجدت
    $image = '';
    if (!empty($_FILES['image']['name'])) {
        $image = time() . '_' . basename($_FILES['image']['name']);
        $target_path = 'uploads/' . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $target_path);
    }

    // دمج الفئة داخل العنوان أو الوصف (لأن الجدول لا يحتوي على حقل فئة)
    $full_description = "[الفئة: $category]\n\n" . $description;

    $sql = "INSERT INTO problems (user_id, title, image, description) 
            VALUES ('$user_id', '$title', '$image', '$full_description')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit;
    } else {
        $error = "حدث خطأ أثناء إضافة المشكلة.";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إضافة مشكلة - CodeSOS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>📝 أضف مشكلة جديدة</h2>
    <?php if (isset($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <label>عنوان المشكلة:</label><br>
        <input type="text" name="title" required><br><br>

        <label>وصف المشكلة:</label><br>
        <textarea name="description" rows="6" required></textarea><br><br>

        <label>فئة المشكلة:</label><br>
        <select name="category" required>
            <option value="تطبيق">تطبيق</option>
            <option value="موقع">موقع</option>
            <option value="نظام">نظام</option>
        </select><br><br>

        <label>صورة توضيحية (اختياري):</label><br>
        <input type="file" name="image" accept="image/*"><br><br>

        <button type="submit" class="big-button">نشر المشكلة</button>
    </form>
</div>

</body>
</html>
