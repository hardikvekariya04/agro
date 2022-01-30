<?php
    session_start();
    if (isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: index/local/dashboard.html");
        die();
    }

    include 'config.php';
    $msg = "";

    if (isset($_GET['verification'])) {
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE code='{$_GET['verification']}'")) > 0) {
            $query = mysqli_query($conn, "UPDATE users SET code='' WHERE code='{$_GET['verification']}'");
            
            if ($query) {
                $msg = "<div class='alert alert-success'style='margin-bottom:-40px;'>Account verification has been successfully completed.</div>";
            }
        } else {
            header("Location: index.php");
        }
    }

    if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        $sql = "SELECT * FROM users WHERE email='{$email}' AND password='{$password}'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if (empty($row['code'])) {
                $_SESSION['SESSION_EMAIL'] = $email;
                header("Location: index/local/dashboard.html");
            } else {
                $msg = "<div class='alert alert-info' style='margin-bottom:-35px;'>First verify your account and try again.</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger' style='margin-bottom:-35px;'>Email or password do not match.</div>";
        }
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
                            <input type="email" class="email" name="email" placeholder="Enter Your Email" required>
                            <input type="password" class="password" name="password" placeholder="Enter Your Password" style="margin-bottom: 2px;" required>
                            <p><a href="forgot-password.php" style="margin-bottom: 15px;margin-top:10px; display: block; text-align: right;color:gray;">Forgot Password?</a></p>
                            <button name="submit" name="submit" class="btn" type="submit">Login</button>
                        </form>
                        <div class="social-icons" style="text-align:center">
                            <p>Create Account! <a href="register.php" style="color:gray;text-decoration:underline;">Register</a>.</p>
                        </div>
                    </div>
        </div>
    </section>
</body>
</html>