<?php
session_start();

include('conexionbdd.php');

if ($conn) {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
        $nom = mysqli_real_escape_string($conn, $_POST['nom']);
        $mot_de_passe = $_POST['mot_de_passe'];

        if (!empty($prenom) && !empty($nom)) {
            $sql = "SELECT * FROM utilisateurs WHERE prenom = '$prenom' AND nom = '$nom'";
            $result = $conn->query($sql);

            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();

                if ($row['duree_banissement'] !== null) {
                    $duree_banissement = $row['duree_banissement'];
                    ?>
                    <!DOCTYPE html>
                    <html>
                    <head>
                        <title>Bannissement</title>
                        <style>
                            <style>
                            body {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                height: 100vh;
                                margin: 0;
                                background-color: #f7f7f7;
                            }

                            .message {
                                text-align: center;
                                font-size: 24px;
                                color: #ff0000;
                                border: 2px solid #ff0000;
                                padding: 20px;
                                border-radius: 8px;
                            }

                            .exclamation {
                                font-size: 36px;
                                margin-bottom: 10px;
                            }
                        </style>
                    </style>
                </head>
                <body>
                    <div class="message">
                        <div class="exclamation">!</div>
                        Vous êtes banni pour encore <?php echo $duree_banissement; ?> jours. Contactez cutsunu@gmail.com pour plus d'informations.
                    </div>
                </body>
                </html>
                <?php
                exit;
            }


            if (password_verify($mot_de_passe, $row['mot_de_passe'])) {
                $_SESSION['prenom'] = $row['prenom'];
                $_SESSION['nom'] = $row['nom'];
                $_SESSION['roles'] = $row['roles'];

                header('Location: http://localhost/produit/index.php'); 
                exit;
            } else {
                echo "Mot de passe incorrect.";
            }
        } else {
            echo "Utilisateur non trouvé.";
        }
    } else {
        echo "Le prénom et le nom sont obligatoires.";
    }
}

$conn->close();
} else {
    echo "La connexion à la base de données a échoué.";
}
?>
