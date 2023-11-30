<?php

session_start();
include '../config.php';


$imie = 'Gość';
$nazwisko = '';
$email =  'Gość@';
$password = '';
$query = $link->prepare("INSERT INTO users VALUES (NULL, ?, ?, ?, ?, 'gosc')");
$query->bind_param('ssss', $imie, $nazwisko, $email, $password);
$query->execute();

$_SESSION['user'] = $email . ' ' . $password;
$_SESSION['userrole'] = 'gosc';
header("Location: ../index.php");
