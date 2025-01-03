<?php
// Inclure le fichier de fonctions pour accéder à la base de données et aux fonctions utilitaires
include 'includes/functions.php';

// Vérifier si la méthode de requête est POST (lorsque le formulaire est soumis)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer le titre de la tâche depuis la requête POST
    $title = $_POST['task'];

    // Appeler la fonction addTask pour ajouter la nouvelle tâche à la base de données
    if (addTask($conn, $title)) {
        // Si l'ajout de la tâche est réussi, retourner une réponse de succès au format JSON
        echo json_encode(['status' => 'success']);
    } else {
        // Si l'ajout de la tâche échoue, retourner une réponse d'erreur au format JSON
        echo json_encode(['status' => 'error']);
    }
}
?>
