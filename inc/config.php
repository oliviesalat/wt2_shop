<?php
session_start();

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "wt2_library";

// Vytvorenie spojenia
global $conn;
$conn = mysqli_connect("127.0.0.1", "root", "", "wt2_library");


// Kontrola spojenia
if (!$conn)
  die("Connection failed: " . mysqli_connect_error());




// Nastavenie spravnej kodovej sady pre citanie a zapis do DB
mysqli_query($conn, 'SET CHARACTER SET utf8');
mysqli_query($conn, 'SET NAMES "utf8"');
mb_internal_encoding('UTF-8');
