<?php
session_start();

include_once('conexionbdd.php');

$responseContent = "Vous devez être connecté pour accéder à cette fonctionnalité.";
$won = false; // Indicateur si l'utilisateur a gagné
$canSpin = false; // Initialisation de $canSpin à false

if (isset($_SESSION['prenom'], $_SESSION['nom'])) {
    $prenom = $conn->real_escape_string($_SESSION['prenom']);
    $nom = $conn->real_escape_string($_SESSION['nom']);

    $stmt = $conn->prepare("SELECT lastSpinDate FROM coupons WHERE prenom = ? AND nom = ?");
    $stmt->bind_param("ss", $prenom, $nom);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($row = $result->fetch_assoc()) {
        if (!is_null($row['lastSpinDate']) && $row['lastSpinDate'] > 0) {
            $daysLeft = $row['lastSpinDate'];
            $responseContent = "Désolé, {$prenom} {$nom}, vous ne pouvez pas participer avant que le compteur ne soit réinitialisé. Réessayez dans {$daysLeft} jours.";
        } else {
            $canSpin = true;
        }
    } else {
        $canSpin = true;
    }

    if ($canSpin && isset($_POST['discountWon'])) {
        $discountWon = $conn->real_escape_string($_POST['discountWon']);
        $couponCode = rand(1000, 9999);
        $daysToReset = 30; // Supposons que le compteur se réinitialise à 30 jours

        // Mise à jour ou insertion avec lastSpinDate défini à $daysToReset
        $stmt = $conn->prepare("REPLACE INTO coupons (prenom, nom, discountWon, couponCode, lastSpinDate) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $prenom, $nom, $discountWon, $couponCode, $daysToReset);
        if ($stmt->execute()) {
            if ($discountWon === '0%') {
                $responseContent = "{$prenom} {$nom}, désolé, vous n'avez rien gagné. Réessayez le mois prochain! 😔";
            } else {
                $responseContent = "{$prenom} {$nom}, félicitations! Vous avez gagné {$discountWon} de réduction. Votre coupon unique est {$couponCode}. 👏";
                $won = true;
            }
        } else {
            $responseContent = "Erreur lors de l'enregistrement des données : " . $stmt->error;
        }
        $stmt->close();
    }
} else {
    echo $responseContent;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
        <title>Contact Sunu cut</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
      
        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

        <!--Stylesheet -->
        <script src="js/script.js"></script>
        <link href="css/style.css" rel="stylesheet">
        <link href="css/single.css" rel="stylesheet">
<meta charset="UTF-8">
<title>Résultat du concours</title>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.3.2/dist/confetti.browser.min.js"></script>
<style>
    body, html {
        height: 100%;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 24px;
    }
    .message {
        text-align: center;
    }
</style>
</head>
<body>
    
    <div class="navbar navbar-expand-lg bg-dark navbar-dark">
            <div class="container-fluid">
                <a href="index.php" class="navbar-brand">Sunu <span>Cut</span></a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
<div class="message">
    <?php echo $responseContent; ?>
</div>
<?php if ($won): ?>
<script>
    // Déclencher l'animation de confettis
    confetti({
        particleCount: 100,
        spread: 70,
        origin: { y: 0.6 }
    });
</script>
<?php endif; ?>
</body>
</html>
