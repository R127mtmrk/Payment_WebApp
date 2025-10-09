<?php
require_once 'Select.php';
function DeleteAccount($username, $password) {
    $result = ConnectSelect($username, $password);
    if ($result) {
        $sql = "DELETE FROM users WHERE (psd_user = :pseudo OR email_user = :email) AND mdp_user = :mdp";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $username, PDO::PARAM_STR);
        $stmt->bindParam(':mdp', $password, PDO::PARAM_STR);
        try {
            if (!$stmt->execute()){
                throw new PDOException("Erreur lors de l'inscription");
            }
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}