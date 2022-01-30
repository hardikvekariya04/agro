<?php

$msg = "";

include 'config.php';

if (isset($_GET['reset'])) {
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE code='{$_GET['reset']}'")) > 0) {
        if (isset($_POST['submit'])) {
            $password = mysqli_real_escape_string($conn, md5($_POST['password']));
            $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm-password']));

            if ($password === $confirm_password) {
                $query = mysqli_query($conn, "UPDATE users SET password='{$password}', code='' WHERE code='{$_GET['reset']}'");

                if ($query) {
                    header("Location: index.php");
                }
            } else {
                $msg = "<div class='alert alert-danger'style='margin-bottom:-40px;'>Password and Confirm Password do not match.</div>";
            }
        }
    } else {
        $msg = "<div class='alert alert-danger'style='margin-bottom:-40px;'>Reset Link do not match.</div>";
    }
} else {
    header("Location: forgot-password.php");
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register</title>
    <link rel="stylesheet" href="css/style-login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900&amp;subset=latin,latin-ext">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/app.js"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
    max-width: 450px;
    margin: 0 auto;
    margin-top:40px;
}
.content-wthree {
    /* flex-basis: 80%;
    -webkit-flex-basis: 60%; */
    box-sizing: border-box;
    padding: 3em 3em;
    background: #fff;
    box-shadow: 2px 9px 49px -17px rgba(0, 0, 0, 0.1);
    border-radius:10px;
    height:450px;
    margin:10px;
}
.content-wthree form {
    margin-top: 40px;
    margin-bottom: 30px; 
}
    </style>
</head>
<body>
    <img src="assets/logo.png" width="250">
    <section class="w3l-mockup-form">
        <div class="container">
                    <div class="content-wthree">
                        <h2>Login Now</h2>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                        <input type="password" class="password" name="password" placeholder="Enter Your Password" required>
                            <input type="password" class="confirm-password" name="confirm-password" placeholder="Enter Your Confirm Password" required>
                            <button name="submit" class="btn" type="submit">Change Password</button>
                        </form>
                        <div class="social-icons" style="text-align:center">
                        <p>Back to! <a href="index.php">Login</a>.</p>
                        </div>
                    </div>
        </div>
    </section>
</body>
</html>