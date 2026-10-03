<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>avis</title>
   
    <link rel="stylesheet" href="votre-style.css">
    <style>
       
        .success-message {
            background-color: #d4edda; 
            color: #155724; 
            padding: 10px; 
            border: 1px solid #c3e6cb; 
            border-radius: 5px; 
            margin-bottom: 20px; 
            text-align: center; 
        }
    </style>
</head>
<body>
  

    <?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['avis']) && isset($_POST['note'])) {

        if(isset($_SESSION['prenom']) && isset($_SESSION['nom'])) {
            $prenom = $_SESSION['prenom'];
            $nom = $_SESSION['nom'];
            $avis = $_POST['avis'];
            $note = $_POST['note']; 

            include_once('conexionbdd.php');

            $query = "INSERT INTO avis_clients (prenom, nom, avis, note) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("sssi", $prenom, $nom, $avis, $note);

                if ($stmt->execute()) {
                 
                    echo '<div class="success-message">';
                    echo 'Votre avis et votre note ont été enregistrés avec succès !';
                    echo '</div>';
                } else {
                    echo "Erreur lors de l'enregistrement de l'avis et de la note : " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Erreur lors de la préparation de la requête.";
            }

            $conn->close();
        } else {
            echo "Les informations de session sont manquantes pour enregistrer l'avis et la note.";
        }
    } else {
        echo "Veuillez soumettre un avis et une note.";
    }
    ?>

</body>
</html>
