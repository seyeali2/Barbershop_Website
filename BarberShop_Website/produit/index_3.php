<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

     <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS File -->
    <link href="css/inscriptiion_connexion.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1 class="sujet">Inscription</h1>
                <form action="inscription.php" method="post" class="my-form">
                    <div class="form-group">
                        <label for="prenom">Prénom :</label>
                        <input type="text" name="prenom" id="prenom" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="nom">Nom :</label>
                        <input type="text" name= "nom" id="nom" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tel">Numéro de téléphone :</label>
                        <input type="text" name="tel" id="tel" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="mot_de_passe">Mot de passe :</label>
                        <input type="password" name="mot_de_passe" id="mot_de_passe" class="form-control" required>
                    </div>

                    <div class="text-center">
                        <input type="submit" value="S'inscrire" class="btn btn-primary"><a href="index_2.php">se connecter</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="js/main.js"></script>
</body>
</html>
