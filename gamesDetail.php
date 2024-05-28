<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: loginForm.php");
        exit();
    }

    include("config.php");

    $gameDetails = null; // Oyun bilgilerini saklamak için değişken
    $error = null; // Hata mesajı için değişken

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $gameID = $_GET['id'];

        // Veritabanından oyunun detaylarını al
        $sql = "SELECT * FROM games WHERE gameID = $gameID";
        $result = mysqli_query($db, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Oyunun detaylarını al
            $gameDetails = mysqli_fetch_assoc($result);
        } else {
            $error = "Oyun bulunamadı.";
        }

        // Bağlantıyı kapat
        mysqli_close($db);
    } else {
        $error = "Geçersiz oyun ID'si.";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameNest</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style_gamesDetail.css">
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
        <div class="card-body">
            <?php if (isset($gameDetails)) : ?>
                <h2 class="card-title text-center"><?php echo $gameDetails["gameName"]; ?></h2>
                <p class="card-text text-center text-muted">by <?php echo $gameDetails["gameCreator"]; ?></p>
                <hr><br><br>
                <div class="game-details mt-4">
                <p class="game-description">Kategori : <?php echo $gameDetails["gameCategory"]; ?></p>
                    <p class="game-description">Platform : <?php echo $gameDetails["gamePlatform"]; ?></p>
                    <p class="game-description"><?php echo $gameDetails["gameInfo"]; ?></p>
                    <br><br><br>
                    <div class="text-center">
                        <img src="<?php echo $gameDetails["gameImage1"]; ?>" class="img-fluid mb-4 game-image" alt="Game Image">
                        <img src="<?php echo $gameDetails["gameImage2"]; ?>" class="img-fluid mb-3 game-image" alt="Game Image">
                        <br><br><br><hr>
                        <a href="<?php echo $gameDetails["gameDownloadLink"]; ?>" class="btn btn-primary btn-block">Download Game</a>
                    </div>
                </div>
            <?php elseif (isset($error)) : ?>
                <p class="text-center text-danger"><?php echo $error; ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
<br><br><br>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Footer -->
<footer class="text-center mt-5">
    <p>Copyright &copy; 2077 GameNest Gaming Company. All rights reserved.</p>
</footer>

</body>
</html>
