<?php
include_once "PDO.php";

function CreateNewUser($pseudo, $password) {
    global $PDO;
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (pseudo, password) VALUES (:pseudo, :password)";
    $pdo_prepare = $PDO->prepare($sql);
    $pdo_prepare->execute(['pseudo' => $pseudo, 'password' => $passwordHash]);

    return $PDO->lastInsertId();
}

function IsNickNameFree($pseudo) {
    global $PDO;

    $sql = "SELECT * FROM user WHERE pseudo = :pseudo";
    $pdo_prepare = $PDO->prepare($sql);
    $pdo_prepare->execute([':pseudo' => $pseudo]);

    return $pdo_prepare->rowCount();

}

function Login($pseudo, $password) {
    global $PDO;

    $sqlQuery = 'SELECT * FROM user WHERE pseudo = :pseudo';
    $pdo_prepare = $PDO->prepare($sqlQuery);
    $pdo_prepare->execute(['pseudo' => $pseudo]);
    $user = $pdo_prepare->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        return $user['id_user'];
    } else {
        return -1;
    }
}

