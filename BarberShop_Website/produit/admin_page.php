<?php
session_start();

if (isset($_SESSION['prenom']) && isset($_SESSION['nom']) && isset($_SESSION['roles'])) {
    if ($_SESSION['roles'] === '2') {
        include_once('conexionbdd.php');

        if ($conn) {
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['rendezvous_id'])) {
                $rendezvous_id = mysqli_real_escape_string($conn, $_POST['rendezvous_id']);
                $query = "DELETE FROM rendezvous WHERE id = $rendezvous_id";
                if ($conn->query($query)) {
                    header('Location: admin_page.php');
                    exit();
                } else {
                    echo "Erreur lors de la suppression du rendez-vous : " . $conn->error;
                }
            }

            $query = "SELECT * FROM rendezvous";
            $result = $conn->query($query);

            if ($result) {
                ?>
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Page d'administration</title>
                    <style>
                   
                        body {
                            font-family: Arial, sans-serif;
                            background-color: beige;
                            margin: 0;
                            padding: 0;
                        }

                        h1 {
                            text-align: center;
                            background-color: #333;
                            color: #fff;
                            padding: 10px;
                        }

                        table {
                            width: 80%;
                            margin: 20px auto;
                            border-collapse: collapse;
                            background-color: #fff;
                        }

                        table,
                        th,
                        td {
                            border: 1px solid #333;
                        }

                        th,
                        td {
                            padding: 8px;
                            text-align: left;
                        }

                        th {
                            background-color: #333;
                            color: #fff;
                        }

                        tr:nth-child(even) {
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
                                    <a href="admin_page.php" class="nav-item nav-link active">rendez-vous</a>
                                    <a href="graph.php" class="nav-item nav-link">graph</a>
                                    <a href="evaluation.php" class="nav-item nav-link">evaluation</a>
                                    <a href="utilisateurs.php" class="nav-item nav-link">utilisateurs</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 offset-lg-3">
                                <form action="recherche-rendezvous.php" method="get">
                                    <div class="form-group">
                                        <label for="searchDate">Rechercher par date :</label>
                                        <input type="date" class="form-control" id="searchDate" name="searchDate">
                                    </div>
                                    <div class="form-group">
                                        <label for="searchName">Rechercher par nom/prénom :</label>
                                        <input type="text" class="form-control" id="searchName" name="searchName">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Rechercher</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </form>
            </td>
            <td>
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Service</th>
                        <th>Email</th>
                        <th>État</th>
                        <th>Action</th>
                    </tr>

                    <?php
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo isset($row['name']) ? $row['name'] : ''; ?></td>
                            <td><?php echo isset($row['date']) ? $row['date'] : ''; ?></td>
                            <td><?php echo isset($row['time']) ? $row['time'] : ''; ?></td>
                            <td><?php echo isset($row['service']) ? $row['service'] : ''; ?></td>
                            <td><?php echo isset($row['email']) ? $row['email'] : ''; ?></td>
                            <td>
                                <form method="POST" action="update_status.php"> <!-- Création du formulaire -->
                                    <input type="hidden" name="rendezvous_id" value="<?php echo $row['id']; ?>">
                                    <select name="status"> <!-- Menu déroulant pour l'état -->
                                        <option value="En attente" <?php if ($row['status'] === 'En attente') echo 'selected'; ?>>En attente</option>
                                        <option value="Effectué" <?php if ($row['status'] === 'Effectué') echo 'selected'; ?>>Effectué</option>
                                    </select>
                                    <input type="submit" value="Modifier"> <!-- Bouton pour soumettre les modifications -->
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="rendezvous_id" value="<?php echo $row['id']; ?>">
                                    <input type="submit" value="Supprimer">
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>

            </body>
            </html>
            <?php

            $result->free();
        } else {
            echo "Erreur lors de la récupération des rendez-vous.";
        }

        $conn->close();
    } else {
        echo "La connexion à la base de données a échoué.";
    }
} else {
    header('Location: index_2.php');
    exit();
}
} else {
    header('Location: index_2.php');
    exit();
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

       
