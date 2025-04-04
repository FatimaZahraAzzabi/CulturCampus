<?php
@include '../conn_db.php';

// Assurez-vous que l'utilisateur est connecté et est un administrateur
// Vérifiez s'il existe des paramètres d'ID et de visibilité dans l'URL
if (isset($_GET['table']) && isset($_GET['id']) && isset($_GET['visibility'])) {
    // Récupérez les valeurs des paramètres
    $table = $_GET['table'];
    $id = $_GET['id'];
    $visibility = $_GET['visibility'];

    // Mettez à jour l'état de visibilité dans la base de données
    switch ($table) {
        case 'grille_programme':
            $column = 'id_planing';
            break;
        case 'podcast':
            $column = 'id_podcast'; // Remplacez 'id' par le nom de la colonne appropriée pour cette table
            break;
        case 'news':
            $column = 'id_news'; // Remplacez 'id' par le nom de la colonne appropriée pour cette table
            break;
        case 'programme':
            $column = 'id_programme'; // Remplacez 'id' par le nom de la colonne appropriée pour cette table
            break;
        case 'episodes':
            $column = 'id_episode'; // Remplacez 'id' par le nom de la colonne appropriée pour cette table
            break;
        default:
            echo "Table non prise en charge";
            exit;
    }

    // Préparez la requête SQL en utilisant la variable de colonne déterminée par la table
    $stmt = $conn->prepare("UPDATE $table SET visibility = ? WHERE $column = ?");
    $stmt->bind_param("ii", $visibility, $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

// Redirigez l'utilisateur vers la page précédente
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>
