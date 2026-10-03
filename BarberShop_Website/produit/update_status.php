<?php
include_once('conexionbdd.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rendezvous_id'], $_POST['status'])) {
    $rendezvous_id = $_POST['rendezvous_id'];
    $status = $_POST['status'];

    // Validation et nettoyage des données (pour éviter les attaques par injection SQL)

    // Exemple de requête SQL pour mettre à jour l'état du rendez-vous
    $sql = "UPDATE rendezvous SET status = ? WHERE id = ?";
    
    // Préparation de la requête
    $stmt = $conn->prepare($sql);
    
    // Liaison des paramètres et exécution de la requête
    $stmt->bind_param("si", $status, $rendezvous_id);
    $stmt->execute();

    // Rediriger vers la page où se trouve le tableau des rendez-vous
    header('Location: admin_page.php');
    exit();
} else {
    // Gérer les cas où les données ne sont pas envoyées correctement
    echo "Erreur lors de la mise à jour de l'état du rendez-vous.";
}
?>
