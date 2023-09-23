<!DOCTYPE html>
<html>
<head>
    <title>List of Users</title>
    <link rel="stylesheet" type="text/css" href="css/users.css"> 
</head>
<body>
    <h1>List of Users</h1>

    <?php
   
    $mysqli = new mysqli("localhost", "root", "", "User details");
    if ($mysqli->connect_error) {
        die('Error connecting to the database: ' . $mysqli->connect_error);
    }

    $sql = "SELECT userId, fullname FROM users ORDER BY userId ASC";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        echo '<ol>'; // Start an ordered list
        while ($row = $result->fetch_assoc()) {
            $userId = $row['userId'];
            $fullname = $row['fullname'];
            echo "<li>User ID: $userId, Full Name: $fullname</li>";
        }
        echo '</ol>'; // End the ordered list
    } else {
        echo "No users found.";
    }

    $mysqli->close();
    ?>

</body>
</html>
