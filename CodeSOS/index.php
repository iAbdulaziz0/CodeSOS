<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeSOS</title>
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
        }

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

        .problem-card {
            margin-bottom: 20px;
            transition: transform 0.3s;
            height: 100%; /* Ensure consistent card height */
        }

        .problem-card:hover {
            transform: translateY(-5px);
        }

        .profile-photo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .problem-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .profile-link {
            cursor: pointer;
        }
        
        .card-body {
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        
        .card-text {
            flex-grow: 1; /* Allow description to grow and push button down */
            overflow: hidden; /* Hide overflow */
        }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="logo">
            <img src="image/logo.png" alt="CodeSOS Logo">
        </div>
        <div class="login-link">
            <a href="login.php">Log In</a>
        </div>
    </header>

    <div class="container">
        <h1 class="text-center my-4">Latest Shared Problems</h1>
        <a href="post_problem.php" class="btn btn-primary mb-4">Post a Problem</a>
        <div class="row">
            <?php
            session_start();
            include 'conn.php';
            
           
   
    echo "Session User ID: " . ($_SESSION['user_id'] ?? 'غير مسجل');



            // Fixed: Added ORDER BY to show latest problems first
            $sql = "SELECT problems.id, problems.title, problems.image, problems.description, 
                           users.id as user_id, users.name, users.profile 
                    FROM problems 
                    JOIN users ON problems.user_id = users.id
                    ORDER BY problems.id DESC"; // Show latest first

            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    // Escape output for security
                    $title = htmlspecialchars($row['title']);
                    $name = htmlspecialchars($row['name']);
                    $description = htmlspecialchars($row['description']);
                    $truncatedDesc = (strlen($description) > 100) ? substr($description, 0, 100) . '...' : $description;
                    
                    // Handle missing images
                    $problemImage = !empty($row['image']) ? 'uploads/' . $row['image'] : 'image/placeholder.jpg';
                    $profileImage = !empty($row['profile']) ? 'uploads/' . $row['profile'] : 'image/profile_placeholder.jpg';
                    
                    echo '<div class="col-md-4 mb-4">';
                    echo '<div class="card problem-card h-100">'; // Added h-100 for equal height
                    echo '<img src="' . $problemImage . '" class="card-img-top problem-image" alt="Problem Image">';
                    echo '<div class="card-body">';
                    echo '<div class="d-flex align-items-center mb-3">';
                    echo '<a href="user_profile.php?id=' . $row['user_id'] . '" class="profile-link">';
                    echo '<img src="' . $profileImage . '" class="profile-photo mr-3" alt="' . $name . '">';
                    echo '</a>';
                    echo '<h5 class="card-title mb-0">' . $name . '</h5>';
                    echo '</div>';
                    echo '<h6 class="card-subtitle mb-2 text-muted">' . $title . '</h6>';
                    echo '<p class="card-text">' . $truncatedDesc . '</p>';
                    echo '<a href="problem_details.php?id=' . $row['id'] . '" class="btn btn-outline-primary mt-auto">View Details</a>'; // Added mt-auto
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="col-12">';
                echo '<p class="text-center alert alert-info">No problems found. Be the first to post one!</p>';
                echo '</div>';
            }
            if ($conn) {
                $conn->close();
            }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>