<?php
// Paramètres de connexion à la base de données
$servername = "localhost"; // Nom de l'hôte du serveur de base de données
$username = "root";        // Nom d'utilisateur pour se connecter à la base de données
$password = "";            // Mot de passe pour se connecter à la base de données
$dbname = "todo_list";     // Nom de la base de données à laquelle se connecter

// Créer un nouvel objet MySQLi pour établir une connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier si la connexion a réussi
if ($conn->connect_error) {
    // En cas d'erreur de connexion, afficher le message d'erreur et arrêter le script
    die("Échec de la connexion : " . $conn->connect_error);
}
?>
