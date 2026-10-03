<?php
include_once('conexionbdd.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id']) && isset($_POST['duree_ban'])) {
    $user_id = $_POST['user_id'];
    $duree_ban = $_POST['duree_ban'];

    // Requête SQL pour mettre à jour la durée de bannissement de l'utilisateur
    $sql = "UPDATE utilisateurs SET duree_banissement = ? WHERE id = ?";
    
    // Préparation de la requête
    $stmt = $conn->prepare($sql);
    
    // Liaison des paramètres
    $stmt->bind_param("ii", $duree_ban, $user_id);
    
    // Exécution de la requête
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "L'utilisateur a été banni pour une durée de $duree_ban jours.";
    } else {
        echo "Erreur lors du bannissement de l'utilisateur.";
    }

    // Fermeture du statement et de la connexion
    $stmt->close();
    $conn->close();
} elseif (!isset($_POST['user_id'])) {
    echo "Identifiant d'utilisateur non spécifié.";
}
?>
<form action="banir_utilisateur.php" method="post">
    <input type="hidden" name="user_id" value="<?php echo isset($_POST['user_id']) ? $_POST['user_id'] : ''; ?>">
    <label for="duree_ban">Durée de bannissement (en jours) :</label>
    <input type="number" id="duree_ban" name="duree_ban" min="1" required>
    <input type="submit" value="Bannir">
</form>
<link href="css/ban.css" rel="stylesheet">