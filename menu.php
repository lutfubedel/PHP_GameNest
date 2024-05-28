<?php
    include("config.php"); 


    $sql1 = "SELECT * FROM games WHERE gamePlatform ='Mobile'";
    $sql2 = "SELECT * FROM games WHERE gamePlatform ='PC'";

    $cevap1 = mysqli_query($db, $sql1);
    $cevap2 = mysqli_query($db, $sql2);

    if (!$cevap1 || !$cevap2) 
    {
        echo "Sorguda hata oluştu: " . mysqli_error($db);
    } 
    else
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>GameNest</title>
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="style_menu.css">
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

        <!-- Header Section -->
        <div class="container header-content">
            <h1>GameNest'e Hoş Geldiniz!</h1>
            <p>Bağımsız oyunların buluşma noktası. Yaratıcılığı ve tutkuyu keşfetmek için buradayız. Hazır mısınız?</p>
        </div>

        <!-- Category Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light category-navbar mt-4">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#categoryNav" aria-controls="categoryNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="categoryNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="categories.php?category=Aksiyon"><span>Aksiyon</span><i></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="categories.php?category=Strateji"><span>Strateji</span><i></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="categories.php?category=Rol%20Yapma"><span>Rol Yapma</span><i></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="categories.php?category=Simülasyon"><span>Simülasyon</span><i></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="categories.php?category=Bulmaca"><span>Bulmaca</span><i></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="categories.php?category=Korku"><span>Korku</span><i></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="categories.php?category=Yarış"><span>Yarış</span><i></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="categories.php?category=Platform"><span>Platform</span><i></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        
        <!-- Mobile Game Section -->
        <div class="container mt-5">
            <div class="card-container">
                <h3 class="text-left">Mobile Games</h3>
                <a href="platform.php?gamePlatform=Mobile" class="btn btn-outline-danger view-all-btn">View All</a>
                <div class="row">
                <?php
                    if (mysqli_num_rows($cevap1) > 0) 
                    {
                        while ($row = mysqli_fetch_assoc($cevap1)) 
                        {
                            ?>
                            <div class="col-md-2 product-card">
                                <div class="card game-card">
                                    <img src="<?php echo $row["gameIcon"]; ?>" class="img-fluid" alt="Game Thumbnail">
                                    <h5 class="card-title"><?php echo $row["gameName"]; ?></h5>
                                    <p class="card-text"><?php echo $row["gameCategory"]; ?></p>
                                    <a href="gamesDetail.php?id=<?php echo $row["gameID"]; ?>" class="btn btn-danger">Play Now</a>
                                </div>
                            </div>
                            <?php
                        }
                    } 
                    ?>       
                </div>
            </div>
        </div>

        <!-- PC Game Section -->
        <div class="container mt-5">
            <div class="card-container">
                <h3 class="text-left">PC Games</h3>
                <a href="platform.php?gamePlatform=PC" class="btn btn-outline-danger view-all-btn">View All</a>
                <div class="row">
                <?php
                    if (mysqli_num_rows($cevap2) > 0) 
                    {
                        while ($row = mysqli_fetch_assoc($cevap2)) 
                        {
                            ?>
                            <div class="col-md-2 product-card">
                                <div class="card game-card">
                                    <img src="<?php echo $row["gameIcon"]; ?>" class="img-fluid" alt="Game Thumbnail">
                                    <h5 class="card-title"><?php echo $row["gameName"]; ?></h5>
                                    <p class="card-text"><?php echo $row["gameCategory"]; ?></p>
                                    <a href="gamesDetail.php?id=<?php echo $row["gameID"]; ?>" class="btn btn-danger">Play Now</a>
                                </div>
                            </div>
                            <?php
                        }
                    } 
                    ?>       
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="text-center mt-5">
            <p>Copyright &copy; 2077 GameNest Gaming Company. All rights reserved.</p>
        </footer>

        <!-- Bootstrap JS and dependencies -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        </body>
        </html>
        <?php           
    }

    mysqli_close($db);
    ?>