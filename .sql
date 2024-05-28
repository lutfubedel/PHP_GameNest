CREATE TABLE games (
    gameID INT AUTO_INCREMENT PRIMARY KEY,
    gameName VARCHAR(100) NOT NULL,
    gameCategory VARCHAR(50) NOT NULL,
    gamePlatform VARCHAR(50) NOT NULL,
    gameInfo TEXT NOT NULL,
    gameCreator VARCHAR(100) NOT NULL,
    gameImage1 VARCHAR(255),
    gameImage2 VARCHAR(255),
    gameIcon VARCHAR(255),
    gameDownloadLink VARCHAR(255),
    gameGithubLink VARCHAR(255),
    gameWebsiteLink VARCHAR(255)
);

CREATE TABLE users (
    userID INT AUTO_INCREMENT PRIMARY KEY,
    userName VARCHAR(255),
    userProffesion VARCHAR(255),
    userBio TEXT,
    userLinkedin VARCHAR(255),
    userGithub VARCHAR(255),
    userImage VARCHAR(255),
    userPassword VARCHAR(255),
    userMail VARCHAR(255)
);