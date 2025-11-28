<?php
require_once 'Select.php';

function DeleteAccount(string $username, string $password): bool {
    global $pdo;

    $user = SelectUser($username);

    if ($user && password_verify($password, $user['mdp_user'])) {

        $sql = "UPDATE Users SET is_active = 0 WHERE id_user = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $user['id_user'], PDO::PARAM_INT);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    return false;
}
