<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignIn Form</title>
    <link rel="stylesheet" href="css/style.css">
</head>
    <body>
        <div class = "login-box">
            <h1>Sign In</h1>
                <form action="mail.php" method="post" autocomplete="on">
                    <div class = "user-box">
                        <input type="text" id="name" name="name" required="">
                        <label for="name"> Username</label><br><br>
                    </div>
                    <div class = "user-box">
                        <input type="email" id="email" name="email" required="">
                        <label for="email"> Email</label><br><br>
                    </div>
                    <div class = "user-box">
                        <input type="Password" id="Password" name="Password" required="">
                        <label for="Password">Password</label><br><br>
                    </div>
                    <div class="btn">
                        <button type="submit" name="submit">Submit</button>
                    </div>
  
                </form>
        </div>
    </body>
</html>
