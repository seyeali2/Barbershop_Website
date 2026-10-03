<!DOCTYPE html>
<html>
<head>
    <title>Liste des utilisateurs</title>
    <style>
        h1{
            text-align: center;
        }
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
    <link href="img/favicon.ico" rel="icon">

    
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
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
                   <a href="admin_page.php" class="nav-item nav-link">rendez-vous</a>
                   <a href="graph.php" class="nav-item nav-link">graph</a>
                   <a href="evaluation.php" class="nav-item nav-link">evaluation</a>
                   <a href="utilisateurs.php" class="nav-item nav-link active">utilisateurs</a>
               </div>
           </div>
       </div>
   </div>
<div class="container">
                        <div class="row">
                            <div class="col-lg-6 offset-lg-3">
                                <form action="recherche-utilisateurs.php" method="get">
                                    <div class="form-group">
                                        <label for="searchName">Rechercher par nom/prénom :</label>
                                        <input type="text" class="form-control" id="searchName" name="searchName">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Rechercher</button>
                                </form>
                            </div>
                        </div>
                    </div>
   <h1>Liste des utilisateurs</h1>

   <table>
    <thead>
        <tr>
            <th>Prénom</th>
            <th>Nom</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include 'conexionbdd.php';

        $sql = "SELECT prenom, nom FROM utilisateurs";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["prenom"] . "</td>";
                echo "<td>" . $row["nom"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>Aucun utilisateur trouvé.</td></tr>";
        }

        mysqli_close($conn);
        ?>
    </tbody>
</table>

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