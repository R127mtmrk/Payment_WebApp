<?php
require_once 'Select.php';

function DeleteAccount($username, $password) {
    global $pdo;

    $user = SelectUser($username);

    if ($user) {
        if (password_verify($password, $user['mdp_user'])) {

            $sql = "DELETE FROM Users WHERE id_user = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $user['id_user'], PDO::PARAM_INT);

            try {
                if ($stmt->execute()) {
                    return true;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        } else {
            echo "Mot de passe incorrect.";
            return false;
        }
    } else {
        echo "Cet utilisateur n'existe pas.";
        return false;
    }
    return false;
}

function DeleteTransaction($idTransac) {
    global $pdo;

    $sql = "DELETE FROM Transac WHERE id_transac = :id_transac";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_transac', $idTransac, PDO::PARAM_INT);

    try {
        return $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}
?>