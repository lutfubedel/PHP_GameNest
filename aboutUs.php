<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta bilgileri -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Sayfa başlığı -->
    <title>About Us - GameNest</title>
    <!-- Bootstrap CSS dosyası -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Özel CSS dosyası -->
    <link rel="stylesheet" href="style_aboutUs.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-transparent">
    <div class="container">
        <!-- Marka/link -->
        <a class="navbar-brand" href="menu.php">GameNest</a>
        <!-- Navbar toggler butonu -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar menüsü -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <!-- GitHub linki -->
                <li class="nav-item">
                    <a class="nav-link" href="https://github.com/lutfubedel">GitHub</a>
                </li>
                <!-- Menü linki -->
                <li class="nav-item">
                    <a class="nav-link" href="menu.php">Menu</a>
                </li>
                <!-- Oyunlar linki -->
                <li class="nav-item">
                    <a class="nav-link" href="games.php">Games</a>
                </li>
                <!-- Profil linki -->
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
                <!-- Hakkımızda linki -->
                <li class="nav-item">
                    <a class="nav-link" href="aboutUs.php">About Us</a>
                </li>
                <!-- Oturum durumuna göre giriş/çıkış butonu -->
                <li class="nav-item">
                    <?php 
                    session_start(); 
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

<!-- Hakkımızda Bölümü -->
<section class="about-us-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <!-- Başlık -->
                <h2 class="section-header">About GameNest</h2>
                <!-- İçerik -->
                <p class="text-justify">GameNest is a community-driven platform dedicated to showcasing and supporting indie game developers. Our mission is to provide a space where independent creators can share their passion projects, connect with fellow gamers, and gain visibility in the gaming community.</p>
                <p class="text-justify">At GameNest, we believe in the power of creativity and innovation in gaming. We strive to foster a supportive and inclusive environment where developers of all backgrounds can thrive and succeed.</p>
                <p class="text-justify">Join us in celebrating the diverse world of indie gaming and discover your next favorite game at GameNest!</p>
            </div>
        </div>
    </div>
</section>

<!-- Misyon ve Vizyon Bölümü -->
<section class="mission-vision-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <!-- Başlık -->
                <h2 class="section-header">Our Mission and Vision</h2>
                <div class="mission-vision-content">
                    <!-- Misyon -->
                    <h4>Mission</h4>
                    <p>GameNest is committed to providing a platform for independent game developers to showcase their creativity and innovation. We aim to empower developers by offering them a supportive community where they can connect with fellow gamers and gain visibility for their projects.</p>
                    <!-- Vizyon -->
                    <h4>Vision</h4>
                    <p>Our vision is to become the go-to destination for discovering and supporting indie games. We envision a vibrant community where developers and gamers come together to celebrate the diversity and artistry of independent gaming.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- İletişim Bölümü -->
<section class="contact-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <!-- Başlık -->
                <h2 class="section-header">Contact Us</h2>
                <div class="contact-content">
                    <!-- İletişim bilgileri -->
                    <p>If you have any questions, feedback, or inquiries, feel free to reach out to us using the contact information below:</p>
                    <ul>
                        <li><strong>Email:</strong> lutfubedel02@gmail.com</li>
                        <li><strong>Phone:</strong> 0541 810 54 34</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>
</section>

<!-- Footer -->
<footer class="footer mt-auto py-3 bg-light">
    <div class="container text-center">
        <!-- Telif hakkı bilgisi -->
        <span class="text-muted">© 2024 GameNest. All rights reserved.</span>
    </div>
</footer>

<!-- JavaScript dosyaları -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
