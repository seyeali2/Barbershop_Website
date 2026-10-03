<?php
// Inclure le fichier de connexion à la base de données
include_once('conexionbdd.php');

if ($conn) {
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['rendezvous_id'])) {
        $rendezvous_id = mysqli_real_escape_string($conn, $_POST['rendezvous_id']);

        // Écrivez une requête pour supprimer le rendez-vous
        $query = "DELETE FROM rendezvous WHERE id = $rendezvous_id";
        if ($conn->query($query)) {
            // La suppression a réussi
            header('Location: admin_page.php'); // Redirigez de nouveau vers la page d'administration
            exit();
        } else {
            echo "Erreur lors de la suppression du rendez-vous : " . $conn->error;
        }
    }

    // Fermez la connexion à la base de données
    $conn->close();
} else {
    echo "La connexion à la base de données a échoué.";
}
?>
