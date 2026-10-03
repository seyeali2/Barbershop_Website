<?php
session_start();

include('conexionbdd.php');

// Vérification du rôle de l'utilisateur à partir de la base de données
$userRole = 0; // Par défaut, aucun rôle
$user_id = '123'; // ID de l'utilisateur à vérifier

$sql = "SELECT role FROM roles WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_bind_result($stmt, $userRole);
        mysqli_stmt_fetch($stmt);
    }

    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Avis</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="img/favicon.ico" rel="icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="css/avis.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<style>
.checked {
  color: orange;
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

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto">
                        <a href="about.html" class="nav-item nav-link">A propos</a>
                        <a href="service.html" class="nav-item nav-link">Service</a>
                        <a href="price.html" class="nav-item nav-link">Prix</a>
                        <a href="rendezvous.php" class="nav-item nav-link">Entrevue</a>
                        <a href="portfolio.html" class="nav-item nav-link">Gallerie</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu">
                                <a href="single.html" class="dropdown-item">FAQ's</a>
                                <a href="events.php" class="dropdown-item">roue mensuel</a>
                            </div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link active">Contact</a>
                    </div>
                </div>
            </div>
        </div>

    <?php
if (!isset($_SESSION['roles'])) {
    ?>
    <style>
        .login-register-container {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 70px;
        }

        .login-register-buttons {
            display: flex;
            align-items: center; 
        }

        .login-register-buttons a {
            background-color: #555; 
            color: #fff;
            padding: 15px 30px; 
            border-radius: 5px;
            text-decoration: none;
            margin: 0 10px; 
            font-size: 18px; 
        }

        .login-register-message {
            text-align: center;
            font-size: 20px; /* Augmenter la taille de la police du message */
            margin-top: 20px; /* Espace au-dessus du message */
        }
    </style>
    <div class="login-register-container">
        <div class="login-register-buttons">
            <a href="index_3.php" class="nav-item nav-link" id="inscriptionLink">S'inscrire</a>
            <a href="index_2.php" class="nav-item nav-link" id="connexionLink">Se connecter</a>
        </div>
        <p class="login-register-message">Inscrivez-vous et connectez-vous pour pouvoir laisser un commentaire</p>
    </div>
    <?php
    exit();
}


$query = "SELECT prenom, nom, avis FROM avis_clients";
$result = $conn->query($query);
?>


    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Laisser un avis</h2>
            <!-- Formulaire pour laisser un avis -->
            <form action="traitement_avis.php" method="post">
                <label for="avis">Votre avis :</label><br>
                <textarea id="avis" name="avis" rows="4" cols="50" required></textarea><br><br>
                <label for="note">Votre note :</label><br>
                <input type="number" id="note" name="note" min="1" max="5" required><br><br>
                <input type="submit" value="Soumettre l'avis">
            </form>
        </div>
    </div>

    <div class="avis-container">
        <?php
        // Récupération des avis des clients depuis la base de données
        $query = "SELECT id, prenom, nom, avis, note FROM avis_clients";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='avis-item'>";
                    echo "<p><strong>{$row['prenom']} {$row['nom']} :</strong> {$row['avis']}</p>";

                    // Affichage des étoiles en fonction de la note
                    if (isset($row['note'])) {
                        $note = intval($row['note']);
                        $total_stars = 5; // Nombre total d'étoiles

                        echo "<div class='rating'>";
                        for ($i = 1; $i <= $total_stars; $i++) {
                            if ($i <= $note) {
                                echo "<span class='fa fa-star checked'></span>";
                            } else {
                                echo "<span class='fa fa-star'></span>";
                            }
                        }
                        echo "</div>";
                    } else {
                        echo "Pas de note disponible."; // Afficher si la note est absente
                    }

                    // Affichage des options de suppression et de bannissement si l'utilisateur a un certain rôle
                    if (isset($_SESSION['roles']) && $_SESSION['roles'] === '2') {
                        echo "<div class='action-buttons'>";
                        echo "<form action='supprimer_avis.php' method='post'>";
                        echo "<input type='hidden' name='avis_id' value='{$row['id']}'>";
                        echo "<button type='submit' class='btn-delete'>Supprimer</button>";
                        echo "</form>";
                        echo "<a href='utilisateurs.php' class='btn btn-ban float-right' style='border: 3px solid red;'>Bannir</a>";
                        echo "</div>";
                    }

                    echo "</div>";
                }
            } else {
                echo "Aucun avis disponible."; // Afficher si aucun avis n'est trouvé
            }

            $stmt->close();
        } else {
            echo "Erreur lors de la récupération des avis.";
        }

        $conn->close();
        ?>
    </div>

    <!-- Vos balises de script restent inchangées -->
</body>
</html>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/isotope/isotope.pkgd.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>

  
        <script src="mail/jqBootstrapValidation.min.js"></script>
        <script src="mail/contact.js"></script>