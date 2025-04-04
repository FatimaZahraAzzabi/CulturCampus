<?php
@include 'conn_db.php';

// Vérifiez si l'identifiant de l'épisode est envoyé via POST
if(isset($_POST['episode_id'])) {
    $episodeId = $_POST['episode_id'];
    
    // Mettez à jour le nombre de "listeners" dans la base de données
    // Vous devez vous connecter à votre base de données et exécuter une requête de mise à jour appropriée ici
    // Exemple de requête : UPDATE episodes SET listeners = listeners + 1 WHERE id_episode = $episodeId;
    
    // Exemple de connexion à la base de données MySQLi
    if($conn->connect_error) {
        die('Erreur de connexion à la base de données : ' . $conn->connect_error);
    }
    
    $updateQuery = "UPDATE episodes SET listeners = listeners + 1 WHERE id_episode = $episodeId";
    if($conn->query($updateQuery) === TRUE) {
        echo 'Nombre de listeners mis à jour avec succès pour l\'épisode ' . $episodeId;
    } else {
        echo 'Erreur lors de la mise à jour du nombre de listeners pour l\'épisode ' . $episodeId . ': ' . $conn->error;
    }
    
    $conn->close();
} else {
    echo 'ID de l\'épisode non spécifié.';
}
?>
