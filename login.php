
<?php
session_start();

if(!isset($_SESSION['name'] )){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/form.css">
</head>
<body>

<div class="form-head">
    <div class="sub-head">
        <h2 class="form-h2">User Login</h2>
    <form action="" method="post">

    <div class="form-email">
            <label class="form-label" for="email">Email &nbsp; : &nbsp;</label>
        <input type="email" name="email" autocomplete="off" placeholder="Enter your email" /><br/>
        </div>
        <div class="form-password">
            <label class="form-label" for="password">Password &nbsp; : &nbsp;</label>
        <input type="password" name="password" id="password" autocomplete="off" placeholder="Enter your password" /> <br/>
        </div>
        <div class="form-button">
        <button class="form-btn" name="submit" type="submit">Submit</button>
        </div>
    </form>
   <p class="form-redirect"> Don't have an account? <a href="index.html"> Sign Up</a> </p>
   <?php

        include 'oop/user.php';
        $user = new User();
        $register = $user->login();
    ?>
</div>
</div>
</body>
</html>
<?php
}else{
    header("Location: pages/home.php");
}

?>