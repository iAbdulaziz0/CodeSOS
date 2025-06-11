🔹 Project Overview: CodeSOS
CodeSOS is a community-driven web application that allows developers to share programming problems and get help from others. Users can sign up, log in, and post problems with an optional image and detailed description. Other users can browse, view, and comment on these problems to offer support or solutions.

The platform is built to foster collaboration and quick troubleshooting among developers by creating a centralized space for coding issues.

🔹 Main Features
Secure user authentication (sign up & login)

Post a new programming problem with a title, description, and image

Browse latest shared problems

View problem details and user profiles

Comment system for interactive discussions

Session management to ensure only logged-in users can post or comment

🔹 Project Structure

CodeSOS/
│
├── index.php                 → Homepage that lists all shared problems
├── login.php                 → Login page for registered users
├── signup.php                → Registration page for new users
├── post_problem.php          → Page to create and submit a new problem
├── problem_details.php       → Page to view a specific problem and its comments
├── user_profile.php          → Displays a user's profile and their posted problems
│
├── conn.php                  → Contains database connection logic
│
├── uploads/                  → Folder to store uploaded images (problems & profile pictures)
│
├── image/                    → Static images (logo, placeholders, etc.)
│
├── design.css                → Custom CSS styles for layout and appearance
├── style.css                 → Additional styles (e.g., Arabic form styling)
│
└── comments.php              → Handles comment submission logic
