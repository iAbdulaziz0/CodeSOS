<?php
include 'conn.php';

$problem_id = $_GET['id'];

// استعلام لاسترجاع تفاصيل المشكلة
$problem_sql = "SELECT problems.title, problems.image, problems.description, users.name, users.profile FROM problems JOIN users ON problems.user_id = users.id WHERE problems.id = $problem_id";
$problem_result = $conn->query($problem_sql);
$problem = $problem_result->fetch_assoc();

// استعلام لاسترجاع التعليقات
$comments_sql = "SELECT comments.comment, users.name, users.profile FROM comments JOIN users ON comments.user_id = users.id WHERE comments.problem_id = $problem_id";
$comments_result = $conn->query($comments_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problem Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .profile-photo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
        .problem-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
        .comment {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card my-4">
                    <img src="uploads/<?php echo $problem['image']; ?>" class="card-img-top problem-image" alt="Problem Image">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="uploads/<?php echo $problem['profile']; ?>" class="profile-photo mr-3" alt="Profile Photo">
                            <h5 class="card-title mb-0"><?php echo $problem['name']; ?></h5>
                        </div>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $problem['title']; ?></h6>
                        <p class="card-text"><?php echo $problem['description']; ?></p>
                    </div>
                </div>
                <div class="card my-4">
                    <div class="card-body">
                        <h5 class="card-title">Comments</h5>
                        <?php
                        if ($comments_result->num_rows > 0) {
                            while($comment = $comments_result->fetch_assoc()) {
                                echo '<div class="comment">';
                                echo '<div class="d-flex align-items-center mb-3">';
                                echo '<img src="uploads/' . $comment['profile'] . '" class="profile-photo mr-3" alt="Profile Photo">';
                                echo '<h6 class="mb-0">' . $comment['name'] . '</h6>';
                                echo '</div>';
                                echo '<p class="mb-0">' . $comment['comment'] . '</p>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>No comments yet.</p>';
                        }
                        ?>
                        <form action="add_comment.php" method="post">
                            <input type="hidden" name="problem_id" value="<?php echo $problem_id; ?>">
                            <input type="hidden" name="user_id" value="1"> <!-- يجب استبدال هذا بقيمة ديناميكية -->
                            <div class="form-group">
                                <textarea class="form-control" name="comment" rows="3" placeholder="Add a comment" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Comment</button> <br>
                            <a href="index.php">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
