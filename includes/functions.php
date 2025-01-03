<?php
// Inclure le fichier de connexion à la base de données
include 'db.php';

/**
 * Récupérer toutes les tâches de la base de données.
 *
 * @param mysqli $conn La connexion à la base de données.
 * @return mysqli_result|bool Le résultat de la requête, ou false en cas d'échec.
 */
function getTasks($conn) {
    // Requête SQL pour sélectionner toutes les tâches, triées par date de création (ordre décroissant)
    $sql = "SELECT * FROM tasks ORDER BY created_at DESC";
    // Exécuter la requête et retourner le résultat
    $result = $conn->query($sql);
    return $result;
}

/**
 * Ajouter une nouvelle tâche à la base de données.
 *
 * @param mysqli $conn La connexion à la base de données.
 * @param string $title Le titre de la tâche.
 * @return bool True en cas de succès, false en cas d'échec.
 */
function addTask($conn, $title) {
    // Préparer la requête SQL pour insérer une nouvelle tâche
    $stmt = $conn->prepare("INSERT INTO tasks (title) VALUES (?)");
    // Associer le titre de la tâche à la requête SQL
    $stmt->bind_param("s", $title);
    // Exécuter la requête et retourner le résultat
    return $stmt->execute();
}

/**
 * Supprimer une tâche de la base de données.
 *
 * @param mysqli $conn La connexion à la base de données.
 * @param int $id L'ID de la tâche à supprimer.
 * @return bool True en cas de succès, false en cas d'échec.
 */
function deleteTask($conn, $id) {
    // Préparer la requête SQL pour supprimer une tâche
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    // Associer l'ID de la tâche à la requête SQL
    $stmt->bind_param("i", $id);
    // Exécuter la requête et retourner le résultat
    return $stmt->execute();
}

/**
 * Mettre à jour une tâche dans la base de données.
 *
 * @param mysqli $conn La connexion à la base de données.
 * @param int $id L'ID de la tâche à mettre à jour.
 * @param string|null $status Le nouveau statut de la tâche (optionnel).
 * @param string|null $title Le nouveau titre de la tâche (optionnel).
 * @return bool True en cas de succès, false en cas d'échec.
 */
function updateTask($conn, $id, $status = null, $title = null) {
    // Vérifier si le statut est fourni
    if ($status !== null) {
        // Préparer la requête SQL pour mettre à jour le statut de la tâche
        $stmt = $conn->prepare("UPDATE tasks SET status = ? WHERE id = ?");
        // Associer le nouveau statut et l'ID de la tâche à la requête SQL
        $stmt->bind_param("si", $status, $id);
    } 
    // Vérifier si le titre est fourni
    elseif ($title !== null) {
        // Préparer la requête SQL pour mettre à jour le titre de la tâche
        $stmt = $conn->prepare("UPDATE tasks SET title = ? WHERE id = ?");
        // Associer le nouveau titre et l'ID de la tâche à la requête SQL
        $stmt->bind_param("si", $title, $id);
    }
    // Exécuter la requête et retourner le résultat
    return $stmt->execute();
}
?>
