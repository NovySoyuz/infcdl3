<?php
$host = 'localhost';
$db   = 'infcdl3';
$user = 'root';
$pass = 'root';
$charset = 'utf8mb4';

//Traitement des erreurs à la connexion de la BDD
try {
    $PDO = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    /* Decocher puis lancer le fichier pour config.php pour la création de la bdd
    // Chemin vers le fichier SQL
    $sqlFile = 'db_init.sql';

    // Lecture du contenu du fichier SQL
    $sql = file_get_contents($sqlFile);

    // Exécution du script SQL
    $mysqlClient->exec($sql);
    */
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}