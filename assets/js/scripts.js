// Lorsque le document est complètement chargé et prêt
$(document).ready(function() {
    // Attacher un gestionnaire d'événement de soumission au formulaire avec l'ID 'addTaskForm'
    $('#addTaskForm').on('submit', function(e) {
        e.preventDefault(); // Empêcher le comportement par défaut de soumission du formulaire

        // Envoyer une requête AJAX POST à add_task.php
        $.ajax({
            url: 'add_task.php', // URL du fichier PHP pour traiter la requête
            method: 'POST', // Méthode HTTP utilisée pour la requête
            data: $(this).serialize(), // Sérialiser les données du formulaire
            success: function(response) { // Fonction de rappel pour gérer le succès
                let res = JSON.parse(response); // Analyser la réponse JSON
                if (res.status == 'success') {
                    location.reload(); // Recharger la page si la tâche a été ajoutée avec succès
                } else {
                    alert('Échec de l\'ajout de la tâche'); // Afficher un message d'erreur si l'ajout a échoué
                }
            }
        });
    });
});

// Fonction pour supprimer une tâche
function deleteTask(id) {
    // Envoyer une requête AJAX POST à delete_task.php
    $.ajax({
        url: 'delete_task.php', // URL du fichier PHP pour traiter la requête
        method: 'POST', // Méthode HTTP utilisée pour la requête
        data: { id: id }, // Données envoyées au serveur (ID de la tâche)
        success: function(response) { // Fonction de rappel pour gérer le succès
            let res = JSON.parse(response); // Analyser la réponse JSON
            if (res.status == 'success') {
                location.reload(); // Recharger la page si la tâche a été supprimée avec succès
            } else {
                alert('Échec de la suppression de la tâche'); // Afficher un message d'erreur si la suppression a échoué
            }
        }
    });
}

// Fonction pour mettre à jour le statut d'une tâche
function updateTask(id, status) {
    // Envoyer une requête AJAX POST à update_task.php
    $.ajax({
        url: 'update_task.php', // URL du fichier PHP pour traiter la requête
        method: 'POST', // Méthode HTTP utilisée pour la requête
        data: { id: id, status: status }, // Données envoyées au serveur (ID de la tâche et nouveau statut)
        success: function(response) { // Fonction de rappel pour gérer le succès
            let res = JSON.parse(response); // Analyser la réponse JSON
            if (res.status == 'success') {
                // Trouver le bouton de validation pour la tâche
                let button = $('#task-' + id + ' .btn-complete');
                if (status == 'completed') {
                    button.text('Complétée'); // Mettre à jour le texte du bouton en 'Complétée'
                    button.removeClass('btn-success').addClass('btn-secondary'); // Modifier la classe du bouton pour le style
                } else {
                    button.text('Compléter'); // Mettre à jour le texte du bouton en 'Compléter'
                    button.removeClass('btn-secondary').addClass('btn-success'); // Modifier la classe du bouton pour le style
                }
            } else {
                alert('Échec de la mise à jour de la tâche'); // Afficher un message d'erreur si la mise à jour a échoué
            }
        }
    });
}

// Fonction pour modifier le titre d'une tâche
function editTask(id) {
    // Obtenir le titre actuel de la tâche
    let taskTitle = $('#task-' + id + ' .task-title').text();
    // Demander à l'utilisateur d'entrer un nouveau titre
    let newTitle = prompt('Modifier la tâche :', taskTitle);
    if (newTitle && newTitle.trim() !== '') {
        // Envoyer une requête AJAX POST à update_task.php
        $.ajax({
            url: 'update_task.php', // URL du fichier PHP pour traiter la requête
            method: 'POST', // Méthode HTTP utilisée pour la requête
            data: { id: id, title: newTitle }, // Données envoyées au serveur (ID de la tâche et nouveau titre)
            success: function(response) { // Fonction de rappel pour gérer le succès
                let res = JSON.parse(response); // Analyser la réponse JSON
                if (res.status == 'success') {
                    $('#task-' + id + ' .task-title').text(newTitle); // Mettre à jour le titre de la tâche dans le DOM
                } else {
                    alert('Échec de la mise à jour de la tâche'); // Afficher un message d'erreur si la mise à jour a échoué
                }
            }
        });
    }
}
