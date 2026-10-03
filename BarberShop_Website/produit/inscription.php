<?php
include_once('conexionbdd.php');


if ($conn) {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
        $nom = mysqli_real_escape_string($conn, $_POST['nom']);
        $tel = mysqli_real_escape_string($conn, $_POST['tel']);
        $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);


        if (!empty($prenom) && !empty($nom)) {

            $insertion = "INSERT INTO utilisateurs (prenom, nom, tel, mot_de_passe) VALUES ('$prenom', '$nom', '$tel', '$mot_de_passe')";

            if ($conn->query($insertion) === TRUE) {
 
                header('Location: http://localhost/produit/index_2.php');
                exit; 
            } else {
                echo "Erreur lors de l'inscription : " . $conn->error;
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
