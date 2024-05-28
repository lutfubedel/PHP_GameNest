<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: loginForm.php");
    exit();
}

include("config.php");

$userName = $_SESSION['username'];

$sql = "SELECT * FROM games WHERE gameCreator='" . $userName . "'";
$cevap = mysqli_query($db, $sql);

if (!$cevap) 
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
        <title>My Games - GameNest</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="style_games.css">
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

        <!-- My Games Section -->
        <section class="container mt-5">
            <div class="card-container">
                <h2 class="section-header">My Games</h2><hr><br><br>
                <div class="row">
                    <?php
                    if (mysqli_num_rows($cevap) > 0) {
                        while ($row = mysqli_fetch_assoc($cevap)) {
                            ?>
                            <div class="col-md-3 product-card">
                                <div class="card game-card">
                                    <img src="<?php echo $row["gameIcon"]; ?>" class="img-fluid" alt="Game Thumbnail">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row["gameName"]; ?></h5>
                                        <p class="card-text"><?php echo $row["gamePlatform"]; ?></p>
                                        <a href="gamesDetail.php?id=<?php echo $row["gameID"]; ?>" class="btn btn-danger">Play Now</a>
                                        <a href="editGames.php?id=<?php echo $row["gameID"]; ?>" class="btn btn-secondary">Edit</a>

                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } 
                    ?>
                    <div class="col-md-4">
                        <a href="addGames.php" class="card add-game-card" style="text-decoration: none;">
                            <i class='bx bx-plus'></i>
                        </a>
                    </div>     
                </div>
            </div>
            <br><br><br><br><br><br><br><br><br><br><hr>
        </section>

        <!-- Footer -->
        <footer class="footer mt-auto py-3 bg-light">
            <div class="container text-center">
                <span class="text-muted">© 2024 GameNest. All rights reserved.</span>
            </div>
        </footer>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>
    <?php
}

mysqli_close($db);
?>
