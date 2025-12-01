<?php
function numberCard($card) :int
{
    $pattern = '/^(?=.*\d).{16,}$/';
    return preg_match($pattern, $card);
}

function dateExpiry($date) :int
{
    $pattern = '/^(?=.*\d).{4,}$/';
    return preg_match($pattern, $date);
}

function redirectIfConnected(): void{
    if (isset($_SESSION['connected']) && $_SESSION['connected'] === true) {
        header('Location: dashboard.php');
        exit();
    }
}

function requireLogin(): void{
    if (!isset($_SESSION['connected']) || $_SESSION['connected'] !== true) {
    header('Location: connexion.php');
        exit();
    }
}

function redirectIfAdmin(): void{
    if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
        header('Location: dashboard.php');
        exit();
    }
}