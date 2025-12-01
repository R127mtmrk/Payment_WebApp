<?php
/**
 * CONFIGURATION DU PROJET
 * 1. Renommez ce fichier en 'config.php'
 * 2. Modifiez les valeurs ci-dessous selon votre environnement
 */

// --- BASE DE DONNÉES ---
// On remplace define() par const
const DB_HOST    = 'localhost';
const DB_NAME    = 'Payment_WebApp';
const DB_USER    = 'root';
const DB_PASS    = '';
const DB_CHARSET = 'utf8mb4';

// --- SÉCURITÉ ---
// Clé pour chiffrer les numéros de carte (AES-256).
const ENCRYPTION_KEY = 'caff668d230c4ac2c4b790e04b9c8911137bc31f3d2913dd258e5213e1e1ea58';

// Mode Debug (true affiche les erreurs PHP, false les cache pour la prod)
const DEBUG_MODE = true;

if (DEBUG_MODE) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}