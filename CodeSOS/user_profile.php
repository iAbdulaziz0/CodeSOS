<?php
include 'conn.php';

$user_id = $_GET['id'];

// استعلام لاسترجاع تفاصيل المستخدم
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

                .site-header {
            background-color: rgba(255, 255, 255, 0.9);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);   


        .logo img {
            height: 40px;
        }

        .login-link a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .container {
            padding-top: 70px;
        }

        .profile-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .profile-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-details {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="logo">
            <img src="image/logo.png" alt="Logo">
        </div>
        <div class="login-link">
            <a href="login.php">Log In</a>
        </div>
    </header>

    <div class="container">
        <div class="profile-container">
            <div class="text-center">
                <img src="uploads/<?php echo $user['profile']; ?>" class="profile-photo" alt="Profile Photo">
                <h2><?php echo $user['name']; ?></h2>
            </div>
            <div class="profile-details">
                <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
                <p><strong>Gender:</strong> <?php echo $user['gender']; ?></p>
                <p><strong>Level:</strong> <?php echo $user['level']; ?></p>
                <p><strong>Developer Type:</strong> <?php echo $user['dev_type']; ?></p>
                <a href="index.php">Back</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
