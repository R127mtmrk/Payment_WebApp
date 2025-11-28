<?php
require_once 'cookie_param.php';
require_once 'function.php';
require_once '../SQL_Request/Select.php';
require_once '../SQL_Request/Insert.php';

session_start();

if (empty($_SESSION['csrf_token'])) {
    try {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    } catch (Exception $e) {
        error_log("Erreur critique d'entropie : " . $e->getMessage());
        die("Erreur critique : Impossible de générer un token de sécurité fiable.");
    }
}
