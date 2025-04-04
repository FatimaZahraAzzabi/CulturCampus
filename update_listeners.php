<?php
@include 'conn_db.php';

if (isset($_POST['podcast_id'])) {
    $podcastId = $_POST['podcast_id'];

    // Mettre à jour le nombre de listeners dans la base de données
    $updateQuery = "UPDATE podcast SET listeners = listeners + 1 WHERE id_podcast = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("i", $podcastId);
    $stmt->execute();
    $stmt->close();

    // Répondre avec un message de succès
    echo 'Nombre de listeners incrémenté pour le podcast ' . $podcastId;
} else {
    // Répondre avec un message d'erreur si l'ID du podcast n'est pas fourni
    echo 'ID du podcast non fourni';
}
?>
