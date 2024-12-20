<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}

if (!isset($_SESSION['pla_id']) || empty($_SESSION['pla_id'])) {
    header('Location: connexion');
    exit(); 
}
