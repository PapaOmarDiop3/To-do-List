<?php
// Inclure le fichier de fonctions pour accéder à la base de données et aux fonctions utilitaires
include 'includes/functions.php';

// Vérifier si la méthode de requête est POST (lorsque la requête de mise à jour est envoyée)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer l'ID de la tâche depuis la requête POST
    $id = $_POST['id'];
    
    // Vérifier si le statut est défini dans la requête POST, sinon le définir à null
    $status = isset($_POST['status']) ? $_POST['status'] : null;
    
    // Vérifier si le titre est défini dans la requête POST, sinon le définir à null
    $title = isset($_POST['title']) ? $_POST['title'] : null;

    // Appeler la fonction updateTask pour mettre à jour la tâche dans la base de données
    if (updateTask($conn, $id, $status, $title)) {
        // Si la mise à jour est réussie, retourner une réponse de succès au format JSON
        echo json_encode(['status' => 'success']);
    } else {
        // Si la mise à jour échoue, retourner une réponse d'erreur au format JSON
        echo json_encode(['status' => 'error']);
    }
}
?>
