<?php
    session_start();

    if ( !isset($_SESSION['username']) ) 
    {
        header("Location: loginForm.php");
        exit();
    }

    include("config.php");

    $userName = $_SESSION['username'];
    $safeUserName = mysqli_real_escape_string($db, $userName);

    $sql = "SELECT * FROM users WHERE userName='" . $safeUserName . "'";
    $cevap = mysqli_query($db, $sql);

    // Eğer sorgu başarısız olursa hata mesajı yazdırıyoruz ve betiği sonlandırıyoruz
    if(!$cevap) 
    {
        echo '<br>Hata:' . mysqli_error($db);
        exit;
    }

    // Sorgudan dönen veriyi diziye çeviriyoruz
    $userData = mysqli_fetch_assoc($cevap);

    // Eğer kullanıcı verisi bulunamazsa hata mesajı yazdırıyoruz ve betiği sonlandırıyoruz
    if (!$userData) 
    {
        echo '<br>Hata: Kullanıcı bulunamadı.';
        exit;
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilim</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style_profile.css">
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-transparent">
    <div class="container">
        <a class="navbar-brand" href="menu.php">GameNest</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="https://github.com/lutfubedel">GitHub</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="menu.php">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="games.php">Games</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="aboutUs.php">About Us</a>
                </li>
                <li class="nav-item">
                    <?php 
                    if (isset($_SESSION['username'])) {
                        echo '<a class="btn btn-signin" href="logout.php">Log Out</a>';
                    } else {
                        echo '<a class="btn btn-signin" href="loginForm.php">Log In</a>';
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="container mt-5">
        <div class="card">
        <div class="card-body text-center">
            <img src="<?php echo htmlspecialchars($userData['userImage']); ?>" alt="Profil Resmi" class="rounded-circle profile-img">
            <h2 class="mt-3"><?php echo htmlspecialchars($userData['userName']); ?></h2>
            <p class="text-muted"><?php echo htmlspecialchars($userData['userProffesion']); ?></p>
            <p><?php echo htmlspecialchars($userData['userBio']); ?></p>
            <div class="social-links mt-4">
                <a href="<?php echo htmlspecialchars($userData['userLinkedin']); ?>" class="btn btn-outline-primary btn-sm mx-1"><i class="fab fa-linkedin"></i> LinkedIn</a>
                <a href="<?php echo htmlspecialchars($userData['userGithub']); ?>" class="btn btn-outline-primary btn-sm mx-1"><i class="fab fa-github"></i> GitHub</a>
            </div>
            <a href="editProfile.php" class="btn btn-primary btn-edit-profile">Edit Profile</a>
            <hr><br><br>
      
        </div>
    </div>
</div>
    
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

<!-- Footer -->
<footer class="text-center mt-5">
    <p>Copyright &copy; 2077 GameNest Gaming Company. All rights reserved.</p>
</footer>

</html>
