# 🏦 Application de Paiement Sécurisée (Payment WebApp)

Ce projet est une application web de gestion de transactions bancaires développée en PHP natif (sans framework). Elle met en œuvre une architecture MVC simplifiée et intègre plusieurs mesures de sécurité robustes.

## 🚀 Fonctionnalités

* **Authentification :** Inscription, Connexion, Déconnexion.
* **Rôles :**
    * **Utilisateur :** Peut ajouter des cartes bancaires, effectuer des virements, voir son historique.
    * **Administrateur :** Peut visualiser toutes les transactions et effectuer des remboursements.
* **Sécurité :** Chiffrement des données sensibles (AES-256), Protection CSRF, Hashage des mots de passe (Argon2/Bcrypt), Protection XSS & SQL Injection.

## 📋 Prérequis

* Serveur Web (Apache/Nginx)
* PHP 8.0 ou supérieur
* MySQL / MariaDB
* Extension PHP `openssl` activée
* Extension PHP `pdo_mysql` activée

## 🛠️ Installation

1.  **Cloner le projet** ou extraire l'archive dans votre dossier serveur (ex: `htdocs` ou `www`).
2.  **Base de données :**
    * Ouvrez phpMyAdmin ou votre terminal SQL.
    * Importez le fichier `SQL/Creation.sql`.
    * Cela créera la base `Payment_WebApp` et les tables nécessaires.
3.  **Configuration :**
    * Renommez le fichier `config.example.php` en **`config.php`**.
    * Ouvrez `config.php` et vérifiez les identifiants de base de données (User/Password).
    * *(Optionnel)* Modifiez la clé de chiffrement `ENCRYPTION_KEY` si nécessaire.

## 🔑 Identifiants de Démonstration

Pour tester l'application rapidement, des comptes sont pré-configurés (si vous avez importé le SQL fourni) :

| Rôle | Pseudo | Email | Mot de passe |
| :--- | :--- | :--- | :--- |
| **Administrateur** | `admin` | `admin@bank.fr` | `Admin123!` |
| **Utilisateur** | `JeanTest` | `jean@test.com` | `User123!` |

> **Note :** Le mot de passe doit respecter la politique de sécurité : 8 caractères min, 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial.

## 🛡️ Implémentations de Sécurité

Ce projet a été conçu avec un focus particulier sur la sécurité web :

1.  **Protection CSRF :** Utilisation de tokens uniques par session pour valider tous les formulaires `POST`.
2.  **Chiffrement des Cartes (AES-256-CBC) :** Les numéros de cartes (PAN) ne sont jamais stockés en clair. Ils sont chiffrés avec une clé secrète et un vecteur d'initialisation (IV) aléatoire stocké en base.
3.  **Injection SQL :** Utilisation systématique de `PDO::prepare()` pour toutes les requêtes.
4.  **Faille XSS :** Échappement des sorties via `htmlspecialchars()` (Output Encoding).
5.  **Validation :** Double validation (Frontend JS + Backend PHP) de toutes les entrées utilisateur.
6.  **Sécurité des Sessions :** Protection contre le vol de session (`session_regenerate_id`, flags cookie sécurisés).

## 📂 Structure du projet

* `/Controller` : Logique métier et traitement des formulaires.
* `/Views` : Interfaces HTML/CSS et JavaScript.
* `/SQL_Request` : Modèles et interactions avec la base de données.
* `/SQL` : Scripts d'initialisation de la BDD.