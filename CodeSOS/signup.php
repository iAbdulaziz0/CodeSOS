<?php
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $gender = $_POST['gender'];
    $level = $_POST['level'];
    $dev_type = $_POST['dev_type'];

        include 'conn.php';

        $sql = "INSERT INTO users (name, email, password, gender, level, dev_type) VALUES ('$name', '$email', '$password', '$gender', '$level', '$dev_type')";
        $result = mysqli_query($conn, $sql);


    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>CodeSOS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="design.css">
</head>
<body>
    <header class="site-header">
        <div class="logo"> <img src="image/logo.png" alt="Logo"> </div>
        <div class="login-link">
            <a href="login.php">Log In</a>
        </div>
    </header>

    <section>
    <div class="transparent-box">
        <form action="login.php" method="post" enctype="multipart/form-data">
            <legend> <h1>Form Registration</h1> </legend>
            <p>Create a new account to get started. It's quick and easy!</p>

            <label> <b> Name </b> </label> <input class="form-control" type="text" name="name" required>
            <label> <b> Email </b> </label> <input class="form-control" type="email" name="email" required>
            <label> <b> Password </b> </label> <input class="form-control" type="password" name="password" required> <br>

            <label>Gender</label> <br>
            <input type="radio" name="gender" value="Male"> <label>Male</label>
            <input type="radio" name="gender" value="Female"> <label>Female</label> <br><br>
            <hr class="mb-3" style="border-top: 2px solid white;">
            <label>Developer level</label> <br>
            <input type="radio" name="level" value="Junior Developer"> <label>Junior Developer</label> <br>
            <input type="radio" name="level" value="Mid-Level Developer"> <label>Mid-Level Developer</label> <br>
            <input type="radio" name="level" value="Senior Develope"> <label>Senior Developer</label> <br><br>

            <b>What Kind of Developer Are You?</b>
            <select name="dev_type">
                <option>Choose one</option>
                <option>Web Developer</option>
                <option>Mobile App Developer</option>
                <option>Software Developer</option>
                <option>AI & Data Developer</option>
            </select> <br><br>

            <label>Profile</label> <input type="file" name="profile"> <br><br>
            <input class="btn btn-primary" type="submit" name="submit" value="Sign up">
        </form>
    </div>
</section>
</body>
</html>
