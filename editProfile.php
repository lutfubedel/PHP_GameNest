<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: loginForm.php");
    exit();
}

require_once "config.php";

$userName = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form data
    $userProffesion = $_POST['userProffesion'];
    $userBio = $_POST['userBio'];
    $userLinkedin = $_POST['userLinkedin'];
    $userGithub = $_POST['userGithub'];
    $userMail = $_POST['userMail'];

    // Handle file upload
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($_FILES['userImage']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES['userImage']['tmp_name']);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }



    // Check file size (limit to 5MB)
    if ($_FILES['userImage']['size'] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES['userImage']['tmp_name'], $uploadFile)) {
            // File is uploaded successfully
            $userImage = $uploadFile;

            // Update database
            $sql = "UPDATE users SET 
                    userImage='$userImage', 
                    userProffesion='$userProffesion',
                    userBio='$userBio',
                    userLinkedin='$userLinkedin',
                    userMail='$userMail',
                    userGithub='$userGithub' 
                    WHERE userName='$userName'";

            if (mysqli_query($db, $sql)) {
                header("Location: profile.php");
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($db);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - GameNest</title>
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
                <h2 class="text-center mb-4">Edit Profile</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="profileImage">Profile Image</label>
                        <input type="file" class="form-control-file" id="profileImage" name="userImage" required>
                    </div>
                    <div class="form-group">
                        <label for="eposta">E-posta</label>
                        <input type="email" class="form-control" id="userMail" name="userMail" placeholder="Enter your mail address" required>
                    </div>
                    <div class="form-group">
                        <label for="profession">Profession</label>
                        <select class="form-control" id="profession" name="userProffesion" required>
                            <option value="" disabled selected>Select your profession</option>
                            <option>Game Programming</option>
                            <option>Designer</option>
                            <option>Game Developer</option>
                            <option>Project Manager</option>
                            <option>Graphic Design and Animation</option>
                            <option>Level Design</option>
                            <option>Sound Design and Music</option>
                            <option>Game Testing and Quality Assurance</option>
                            <option>Web Developer</option>
                            <option>Storytelling and Narrative</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <textarea class="form-control" id="bio" rows="3" name="userBio" placeholder="Introduce yourself briefly"></textarea required>
                    </div>
                    <div class="form-group">
                        <label for="linkedin">LinkedIn</label>
                        <input type="url" class="form-control" id="linkedin" name="userLinkedin" placeholder="Enter your LinkedIn profile URL" required>
                    </div>
                    <div class="form-group">
                        <label for="github">GitHub</label>
                        <input type="url" class="form-control" id="github" name="userGithub" placeholder="Enter your GitHub profile URL" required>
                    </div>
                    <br><br>
                    <button type="submit" class="btn btn-primary btn-block">Save Profile</button>                
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
