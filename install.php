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

    #creates tblteams
    $stmt1=$conn->prepare("DROP TABLE IF EXISTS tblteams;
    CREATE TABLE tblteams
    (TeamID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Teamname VARCHAR(50) NOT NULL,
    ManagerID INT(4));
    ");
    $stmt1->execute();
    echo(" tblteams made");

    #creates tblplayerinteam
    $stmt1=$conn->prepare("DROP TABLE IF EXISTS tblplayerinteam;
    CREATE TABLE tblplayerinteam
    (PlayerID INT(4) PRIMARY KEY,
    TeamID INT(4));
    ");
    $stmt1->execute();
    echo(" tblplayerinteam made");

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
    
?>



