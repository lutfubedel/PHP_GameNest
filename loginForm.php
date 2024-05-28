<?php
session_start(); // Oturum başlatılıyor
require_once "config.php";

// Initialize an empty error message
$error_message = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) 
{
    $form_username = $_POST["username"];
    $form_password = $_POST["password"];

    // Validate input
    if (empty($form_username) || empty($form_password)) 
    {
        $error_message = "Both username and password are required.";
    } 
    else 
    {
        $q = mysqli_query($db, "SELECT * FROM users WHERE `userName`='$form_username' AND `userPassword`='$form_password'");
        if ($q === false) 
        {
            $error_message = "MySQL error: " . mysqli_error($db);
        } 
        else 
        {
            $num = mysqli_num_rows($q);

            if ($num == 0) 
            {
                $error_message = "Böyle bir kullanıcı bulunamadı! Şifrenizi kontrol ediniz!";
            } 
            else if ($num == 1) 
            {
                $user = mysqli_fetch_assoc($q);
                $_SESSION['username'] = $user['userName']; // Kullanıcı adıyla oturum değişkeni ayarlanıyor

                header("Location: menu.php");
                exit;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameNest Login</title>
    <link rel="stylesheet" href="style_login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper">
        <form action="" method="POST">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" placeholder="Username" name="username">
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" name="password">
                <i class='bx bxs-lock-alt'></i>
            </div>
            <button type="submit" name="login" class="btn">Login</button>
            <div class="register-link">
                <p>Don't have an account? <a href="signupForm.php">Register</a></p>
            </div>
            <?php if (!empty($error_message)): ?>
            <div class="info-message">
                <p><?php echo $error_message; ?></p>
            </div>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
