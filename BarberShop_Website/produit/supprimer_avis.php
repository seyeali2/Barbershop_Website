<?php
// Inclure le fichier de connexion à la base de données
include_once('conexionbdd.php');

if ($conn) {
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['avis_id'])) {
        $avis_id = mysqli_real_escape_string($conn, $_POST['avis_id']);

        // Écrivez une requête pour supprimer l'avis
        $query = "DELETE FROM avis_clients WHERE id = $avis_id";
        if ($conn->query($query)) {
            // La suppression a réussi
            // Redirection vers une page appropriée après la suppression (ici, admin_page.php)
            header('Location: avis.php');
            exit();
        } else {
            echo "Erreur lors de la suppression de l'avis : " . $conn->error;
        }
    }

    // Fermez la connexion à la base de données
    $conn->close();
} else {
    echo "La connexion à la base de données a échoué.";
}
?>
