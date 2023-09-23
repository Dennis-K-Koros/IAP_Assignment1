<?php
class layouts{
    public function headers($conf){
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php print $conf["site_name"]; ?></title>
    <link rel="stylesheet" href="css/layout.css">
</head>
     <?php
         }
         public function content(){
            ?>
    <body>
        <div class = "login-box">
            <h1>Verification</h1>
                <form action="mail.php" method="POST" autocomplete="on">
                    <div class = "user-box">
                        <input type="text" id="name" name="name" required>
                        <label for="name"> Name</label><br><br>
                    </div>
                    <div class = "user-box">
                        <input type="email" id="email" name="email" required>
                        <label for="email"> Email</label><br><br>
                    </div>
                    <div class="btn">
                        <button type="submit" name="submit">Submit</button>
                    </div>
  
                </form>
              
        </div>
        
    </body>
</html>
<?php
} 
}
    