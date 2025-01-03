<?php
// Inclure le fichier contenant les fonctions nécessaires
include 'includes/functions.php';

// Inclure le fichier contenant le header de la page
include 'templates/header.php';

// Récupérer toutes les tâches depuis la base de données
$tasks = getTasks($conn);
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- Formulaire d'ajout de tâche -->
            <form id="addTaskForm" class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Nouvelle tâche" name="task" required>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Ajouter une tâche</button>
                </div>
            </form>

            <!-- Liste des tâches avec une barre de défilement -->
            <div class="task-list-container" style="max-height: 400px; overflow-y: auto;">
                <ul class="list-group" id="taskList">
                    <?php while($task = $tasks->fetch_assoc()): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center" id="task-<?php echo $task['id']; ?>">
                            <span class="task-title"><?php echo htmlspecialchars($task['title']); ?></span>
                            <div>
                                <button class="btn btn-sm btn-success btn-complete" onclick="updateTask(<?php echo $task['id']; ?>, 'completed')" <?php echo $task['status'] == 'completed' ? 'style="display: none;"' : ''; ?>>Complete</button>
                                <button class="btn btn-sm btn-secondary" <?php echo $task['status'] == 'pending' ? 'style="display: none;"' : ''; ?>>Terminer</button>
                                <button class="btn btn-sm btn-warning" onclick="editTask(<?php echo $task['id']; ?>)">Modifier</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteTask(<?php echo $task['id']; ?>)">Supprimer</button>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
    </div>
</div>


<!-- Inclure le fichier contenant le footer de la page -->
<?php include 'templates/footer.php'; ?>
