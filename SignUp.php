<?php
// Include your database connection code here (e.g., create a database connection object)

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get user input
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate and sanitize input (you can add more validation rules)
    $errors = [];
    
    if (empty($fullname)) {
        $errors[] = "Full name is required.";
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    
    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    // Check for duplicate email
    // Replace this with your database query to check if the email already exists
    $existingEmail = false; // Set this to true if the email exists in your database
    
    if ($existingEmail) {
        $errors[] = "Email is already registered.";
    }

    // If there are validation errors, display them to the user
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert user data into the database
        // Replace this with your actual database insertion code
        // You should also handle database errors here
        // Example SQL query (replace with your table name and column names):
        // $sql = "INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)";
        // $stmt = $pdo->prepare($sql);
        // $stmt->execute([$fullname, $email, $hashedPassword]);

        // Redirect to a success page
        header("Location: Users.php");
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="login-box">
        <h1>Sign Up</h1>
        <form action="processes/signup_process.php" method="POST" autocomplete="off">
            <div class="user-box">
                <input type="text" id="name" name="fullname" required>
                <label for="name">Full Name</label><br><br>
            </div>
            <div class="user-box">
                <input type="email" id="email" name="email" required>
                <label for="email">Email</label><br><br>
            </div>
            <div class="user-box">
                <input type="Password" id="Password" name="password" required>
                <label for="Password">Password</label><br><br>
            </div>
            <div class="btn">
                <button type="submit" name="register">SignUp</button>
            </div>
        </form>
    </div>
</body>
</html>

