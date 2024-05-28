<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: loginForm.php");
        exit();
    }

    require_once "config.php";


    // POST isteği ile gelen 'username' varsa işlemlere başlar
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $userName = $_SESSION['username'];

        // Formdan gelen kullanıcı adı, şifre ve e-posta bilgilerini değişkenlere atar
        $gameName = $_POST["gameName"];
        $gameCategory = $_POST["gameCategory"];
        $gamePlatform = $_POST["gamePlatform"];
        $gameInfo = $_POST["gameInfo"];
        $downloadLink = $_POST["downloadLink"];
        $githubLink = $_POST["githubLink"];

        // Dosyaların yükleneceği dizin
        $targetDir = "uploads/";

        // İlk resim dosyasını yükle
        $targetFile3 = $targetDir . basename($_FILES["gameIcon"]["name"]);
        move_uploaded_file($_FILES["gameIcon"]["tmp_name"], $targetFile3);

        // İlk resim dosyasını yükle
        $targetFile1 = $targetDir . basename($_FILES["gameImage1"]["name"]);
        move_uploaded_file($_FILES["gameImage1"]["tmp_name"], $targetFile1);

        // İkinci resim dosyasını yükle
        $targetFile2 = $targetDir . basename($_FILES["gameImage2"]["name"]);
        move_uploaded_file($_FILES["gameImage2"]["tmp_name"], $targetFile2);

        // Kullanıcı bilgilerini veritabanına ekler
        $rt = mysqli_query($db, "INSERT INTO `games` (`gameName`, `gameCategory`, `gameInfo`,`gameImage1`,`gameImage2`,`gameDownloadLink`,`gameGithubLink`,`gameCreator`,`gameIcon`,`gamePlatform`) 
                VALUES ('".$gameName."', '".$gameCategory."', '".$gameInfo."','".$targetFile1."','".$targetFile2."','".$downloadLink."','".$githubLink."','".$userName."','".$targetFile3."','".$gamePlatform."')");

        // Veritabanı sorgusunda hata olup olmadığını kontrol eder
        if (mysqli_errno($db) != 0) 
        {
            // Hata varsa uyarı mesajı gösterir ve işlemi sonlandırır
            echo "<div class='register-warning'><p>Bir hata meydana geldi!</p></div>";
            exit;
        }

        header("Location: games.php");
        exit;

    } 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Game - GameNest</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style_editProfile.css">
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
                <h2 class="text-center mb-4">Upload Game</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="gameName">Game Name</label>
                        <input type="text" class="form-control" id="gameName" name="gameName" placeholder="Enter your game name" required>
                    </div>
                    <div class="form-group">
                        <label for="gameCategory">Category</label>
                        <select class="form-control" id="gameCategory" name="gameCategory" required>
                            <option value="" disabled selected>Select your game category</option>
                            <option>Aksiyon</option>
                            <option>Strateji</option>
                            <option>Rol Yapma</option>
                            <option>Simülasyon</option>
                            <option>Bulmaca</option>
                            <option>Korku</option>
                            <option>Yarış</option>
                            <option>Platform</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gameCategory">Platform</label>
                        <select class="form-control" id="gamePlatform" name="gamePlatform" required>
                            <option value="" disabled selected>Select your game platform</option>
                            <option>Mobile</option>
                            <option>PC</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gameInfo">Info</label>
                        <textarea class="form-control" id="gameInfo" rows="3" name="gameInfo" placeholder="Introduce your game"></textarea required>
                    </div>
                    <div class="form-group">
                        <label for="gameIcon">Game Icon</label>
                        <input type="file" class="form-control-file" id="gameIcon" name="gameIcon" required>
                    </div>
                    <div class="form-group">
                        <label for="gameImage1">Game Image 1</label>
                        <input type="file" class="form-control-file" id="gameImage1" name="gameImage1" required>
                    </div>
                    <div class="form-group">
                        <label for="gameImage2">Game Image 2</label>
                        <input type="file" class="form-control-file" id="gameImage2" name="gameImage2" required>
                    </div>
                    <div class="form-group">
                        <label for="downloadLink">Download link</label>
                        <input type="url" class="form-control" id="downloadLink" name="downloadLink" placeholder="Enter your game Drive link" required>
                    </div>
                    <div class="form-group">
                        <label for="githubLink">GitHub</label>
                        <input type="url" class="form-control" id="githubLink" name="githubLink" placeholder="Enter your GitHub game link" required>
                    </div>
                    <br><br>
                    <button type="submit" class="btn btn-primary btn-block">Upload Game</button>                
                </form>
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
