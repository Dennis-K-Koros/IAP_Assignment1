<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="css/style.css">
</head>
    <body>
        <div class = "login-box">
            <h1>Contact Us</h1>
                <form action="mail.php" method="post" autocomplete="on">
                    <div class = "user-box">
                    <input type="text" id="name" name="name" required="">
                    <label for="name"> Name</label><br><br>
                    </div>
                    <div class = "user-box">
                    <input type="email" id="email" name="email" required="">
                    <label for="email"> Email</label><br><br>
                    </div>
                    <div class = "user-box">
                    <textarea id="message" name="message" rows="2" required=""></textarea>
                    <label for="message"> Message</label><br><br>
                    </div>
                    <div class ="btn">
                        <a href ='#'>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            Submit
                        </a>
                    </div>  
                </form>
        </div>
    </body>
</html>
