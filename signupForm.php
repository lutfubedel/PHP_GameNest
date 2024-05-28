<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameNest Sign Up</title>
    <link rel="stylesheet" href="style_login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper">
        <form action="" method="POST">
            <h1>Sign Up</h1>
            <div class="input-box">
                <input type="text" placeholder="Name" name="username" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="email" placeholder="Email" name="email" required>
                <i class='bx bxs-envelope'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" name="password">
                <i class='bx bxs-lock-alt' ></i>
            </div>

            <button type="submit" class="btn"> Create Account</button>

            <div class="register-link">
                <p>Already have an account? <a href="loginForm.php">Login</a></p>
            </div>

            
            <?php

                // Veritabanı konfigürasyon dosyasını dahil eder
                require_once "config.php";

                // POST isteği ile gelen 'username' varsa işlemlere başlar
                if (isset($_POST["username"])) 
                {
                    // Formdan gelen kullanıcı adı, şifre ve e-posta bilgilerini değişkenlere atar
                    $form_username = $_POST["username"];
                    $form_password = $_POST["password"];
                    $form_email = $_POST["email"];

                    // Şifre uzunluğunu kontrol eder
                    $passlen = strlen($form_password);
                    if ($passlen < 6 || $passlen > 15) 
                    {
                        // Şifre uzunluğu uygun değilse uyarı mesajı gösterir ve işlemi sonlandırır
                        echo "<div class='register-warning'><p>Şifre en az 6, en fazla 15 karakterden oluşmalıdır!</p></div>";
                        exit;
                    }

                    // Kullanıcı bilgilerini veritabanına ekler
                    $rt = mysqli_query($db, "INSERT INTO `users` (`userName`, `userPassword`, `userMail`) VALUES ('".$form_username."', '".$form_password."', '".$form_email."')");

                    // Veritabanı sorgusunda hata olup olmadığını kontrol eder
                    if (mysqli_errno($db) != 0) 
                    {
                        // Hata varsa uyarı mesajı gösterir ve işlemi sonlandırır
                        echo "<div class='register-warning'><p>Bir hata meydana geldi!</p></div>";
                        exit;
                    }

                    // İşlem başarılıysa kullanıcıyı giriş formuna yönlendirir
                    header("Location: loginForm.php");
                    exit;
                } 

            ?>
        </form>
    </div>
</body>
</html>
