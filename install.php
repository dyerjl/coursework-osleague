<?php
    #creates variables with server details
    $servername="localhost";
    $username= "root";
    $password= "root";

    #creates the database
    $conn=new PDO("mysql:host=$servername",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql="CREATE DATABASE IF NOT EXISTS OSleague";
    $conn->exec($sql);
    $sql="USE OSleague";
    $conn->exec($sql);
    echo("DB made");

    #creates tblplayers
    $stmt1=$conn->prepare("DROP TABLE IF EXISTS tblplayers;
    CREATE TABLE tblplayers
    (PlayerID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Firstname VARCHAR(20) NOT NULL,
    Lastname VARCHAR(20) NOT NULL,
    Email VARCHAR(254) NOT NULL,
    Password VARCHAR(256) NOT NULL,
    PositionID VARCHAR(3) NOT NULL,
    Role TINYINT(1));
    ");
    $stmt1->execute();
    echo(" tblplayers made");
    $hashedpassword=password_hash("password", PASSWORD_DEFAULT);
    echo($hashedpassword);
    $stmt1 = $conn->prepare("INSERT INTO tblplayers
    (PlayerID, Firstname, Lastname, Email, Password, PositionID, Role)
    VALUES
    (NULL,'Jonny', 'Dyer', 'dyer.jl@oundleschool.org.uk', :Password, 'LW', 0),
    (NULL,'Charlie', 'Hoyle', 'hoyle.c@oundleschool.org.uk', :Password, 'ST', 2),
    (NULL,'Oscar', 'Perring', 'perring.o@oundleschool.org.uk', :Password, 'CM', 1),
    (NULL,'Thomas', 'Mills', 'mills.t@oundleschool.org.uk', :Password, 'RW', 0)
    ");
    $stmt1->bindParam(":Password",$hashedpassword);
    $stmt1->execute();
    

    #creates tblteams
    $stmt1=$conn->prepare("DROP TABLE IF EXISTS tblteams;
    CREATE TABLE tblteams
    (TeamID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Teamname VARCHAR(50) NOT NULL,
    ManagerID INT(4));
    ");
    $stmt1->execute();
    echo(" tblteams made");
    $stmt1 = $conn->prepare("INSERT INTO tblteams
    (TeamID, Teamname, ManagerID)
    VALUES
    (NULL,'Founders FC', 2),
    (NULL,'Eze Cash', 3)
    ");
    $stmt1->execute();

    #creates tblplayerinteam
    $stmt1=$conn->prepare("DROP TABLE IF EXISTS tblplayerinteam;
    CREATE TABLE tblplayerinteam
    (PlayerID INT(4) PRIMARY KEY,
    TeamID INT(4));
    ");
    $stmt1->execute();
    echo(" tblplayerinteam made");
    $stmt1 = $conn->prepare("INSERT INTO tblplayerinteam
    (PlayerID, TeamID)
    VALUES
    (1,2),
    (4,2)
    ");
    $stmt1->execute();

    #creates tblfixtures
    $stmt1=$conn->prepare("DROP TABLE IF EXISTS tblfixtures;
    CREATE TABLE tblfixtures
    (FixtureID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Team1ID INT(4),
    Team1Goals INT(2) NOT NULL,
    Team2ID INT(4),
    Team2Goals INT(2) NOT NULL,
    Gameweek INT(4) NOT NULL,
    Date DATETIME
    );
    ");
    $stmt1->execute();
    echo(" tblfixtures made");
    $stmt1 = $conn->prepare("INSERT INTO tblfixtures
    (FixtureID, Team1ID, Team1Goals, Team2ID, Team2Goals, Gameweek, Date)
    VALUES
    (NULL, 1, 2, 2, 3, 5, '2026-03-16 21:30:00')
    ");
    $stmt1->execute();
    
?>



