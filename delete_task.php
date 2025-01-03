<?php
// Inclure le fichier de fonctions pour accéder à la base de données et aux fonctions utilitaires
include 'includes/functions.php';

// Vérifier si la méthode de requête est POST (lorsque la requête de suppression est envoyée)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer l'ID de la tâche depuis la requête POST
    $id = $_POST['id'];

    // Appeler la fonction deleteTask pour supprimer la tâche de la base de données
    if (deleteTask($conn, $id)) {
        // Si la suppression est réussie, retourner une réponse de succès au format JSON
        echo json_encode(['status' => 'success']);
    } else {
        // Si la suppression échoue, retourner une réponse d'erreur au format JSON
        echo json_encode(['status' => 'error']);
    }
}
?>
