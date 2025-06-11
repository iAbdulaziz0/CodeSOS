<!DOCTYPE html>
<html lang="en">
<head>
    <title>CodeSOS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="design.css">
</head>
<body>
    <header class="site-header">
        <div class="logo">
            <img src="image/logo.png" alt="Logo">
        </div>
        <div class="login-link">
            <a href="signup.php">Sign Up</a>
        </div>
    </header>

    <section>
    <div class="transparent-box">
        <form action="index.php" method="post" enctype="multipart/form-data">
            <legend> <h1>Welcome Again!</h1> </legend>
            <p>If you don't have an account you can sign up and join us</p>

            <label> <b> Email </b> </label>
            <input class="form-control" type="email" name="email" required>

            <label> <b> Password </b> </label>
            <input class="form-control" type="password" name="password" required> <br>

            <input class="btn btn-primary" type="submit" name="submit" value="Log in">
        </form>
    </div>
    </section>

    <?php
    session_start(); // Start the session

    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password_db = "";
        $dbname = "codesos";

        // Create connection
        $conn = new mysqli($servername, $username, $password_db, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind
        $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);

        // Execute the query
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $name, $hashed_password);
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                // Password is correct, start a new session
                $_SESSION['user_id'] = $id;
                $_SESSION['user_name'] = $name;

                // Redirect to user dashboard page
                header("Location: index.php");
                exit();
            } else {
                echo "<p>Invalid password.</p>";
            }
        } else {
            echo "<p>No user found with that email address.</p>";
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
