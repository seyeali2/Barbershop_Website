<?php
include_once('conexionbdd.php');

if ($conn) {
    $queryAvgStars = "SELECT AVG(note) AS moyenne_note FROM avis_clients";
    $resultAvgStars = $conn->query($queryAvgStars);
    $averageStars = 0;

    if ($resultAvgStars->num_rows > 0) {
        $row = $resultAvgStars->fetch_assoc();
        $averageStars = $row['moyenne_note'];
    }

    $queryTotalGain = "SELECT SUM(prix) AS total_gain FROM rendezvous WHERE status = 'Effectué'";
    $resultTotalGain = $conn->query($queryTotalGain);
    $totalGain = 0;

    if ($resultTotalGain->num_rows > 0) {
        $row = $resultTotalGain->fetch_assoc();
        $totalGain = $row['total_gain'];
    }

    // Fermeture des résultats
    $resultAvgStars->free();
    $resultTotalGain->free();
    $conn->close();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Graphique</title>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link href="img/favicon.ico" rel="icon">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <title>Récapitulatif</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding-top: 60px; /* Ajout de l'espace pour la barre de navigation */
            }
            .summary {
                background-color: #f4f4f4;
                padding: 20px;
                border-radius: 5px;
                margin: 20px;
            }
            h2 {
                margin-top: 0;
            }
        </style>
    </head>
    <body>
        <div class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top"> <!-- Modification pour fixer la barre de navigation en haut -->
            <div class="container-fluid">
                <a href="index.php" class="navbar-brand">Sunu <span>Cut</span></a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto">
                        <a href="admin_page.php" class="nav-item nav-link">rendez-vous</a>
                        <a href="graph.php" class="nav-item nav-link">graph</a>
                        <a href="evaluation.php" class="nav-item nav-link active">evaluation</a>
                        <a href="utilisateurs.php" class="nav-item nav-link">utilisateurs</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="summary">
            <h2>Récapitulatif</h2>
            <p>Moyenne des étoiles : <?php echo number_format($averageStars, 2); ?></p>
            <p>Gain total : <?php echo number_format($totalGain, 2); ?></p>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "La connexion à la base de données a échoué.";
}
?>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/isotope/isotope.pkgd.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>

  
        <script src="mail/jqBootstrapValidation.min.js"></script>
        <script src="mail/contact.js"></script>