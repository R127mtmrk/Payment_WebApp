# 🏦 Application de Paiement Sécurisée (Payment WebApp)

Ce projet est une application web de gestion de transactions bancaires développée en PHP natif (sans framework). Elle met en œuvre une architecture MVC simplifiée et intègre plusieurs mesures de sécurité robustes.

## 🚀 Fonctionnalités

* **Authentification :** Inscription, Connexion, Déconnexion.
* **Rôles :**
    * **Utilisateur :** Peut ajouter des cartes bancaires, effectuer des virements, voir son historique.
    * **Administrateur :** Peut visualiser toutes les transactions et effectuer des remboursements.
* **Sécurité :** Chiffrement des données sensibles (AES-256), Protection CSRF, Hashage des mots de passe (Argon2/Bcrypt), Protection XSS & SQL Injection.

## 📋 Prérequis

* Serveur Web (Apache)
* PHP 8.0 ou supérieur
* MySQL / MariaDB
* Extension PHP `openssl` activée
* Extension PHP `pdo_mysql` activée

## 🛠️ Installation

1.  **Cloner le projet** ou extraire l'archive dans votre dossier serveur (ex: `www`).
2.  **Base de données :**
    * Ouvrez phpMyAdmin ou votre terminal SQL.
    * Importez le fichier `SQL/Creation.sql` puis `SQL/Insertion.sql`.
    * Cela créera la base `Payment_WebApp` et les tables nécessaires.
3.  **Configuration :**
    * Renommez le fichier `config.example.php` en **`config.php`**.
    * Ouvrez `config.php` et vérifiez les identifiants de base de données (User/Password).
    * *(Optionnel)* Modifiez la clé de chiffrement `ENCRYPTION_KEY` si nécessaire.

## 🔑 Identifiants de Démonstration

Pour tester l'application rapidement, des comptes sont pré-configurés (si vous avez importé le SQL fourni) :

| Rôle               | Pseudo  | Mot de passe |
|:-------------------|:--------|:-------------|
| **Administrateur** | `admin` | `admin123!`  |
| **Utilisateur 1**  | `user1` | `user123!`   |
| **Utilisateur 2**  | `user2` | `user123!`   |

> **Note :** Le mot de passe doit respecter la politique de sécurité : 8 caractères min, 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial.

## 📂 Structure du projet

* `/Controller` : Logique métier et traitement des formulaires.
* `/Views` : Interfaces HTML/CSS et JavaScript.
* `/SQL_Request` : Modèles et interactions avec la base de données.
* `/SQL` : Scripts d'initialisation de la BDD.