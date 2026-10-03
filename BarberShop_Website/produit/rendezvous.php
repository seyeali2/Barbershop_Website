
<?php
session_start();


include('conexionbdd.php');

$sql = "SELECT role FROM roles WHERE user_id = '123'"; 
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $userRole = $row['roles'];
} else {
    // Gestion de l'erreur si la requête échoue.
    // Vous pouvez définir une valeur par défaut ou une gestion d'erreur personnalisée.
    $userRole = 0; // Par défaut, aucun rôle.
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>rendez vous sunu cut</title>
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
        <link href="css/style.css" rel="stylesheet">
    </head>


    <body>
        <!-- Top Bar Start -->
        <div class="top-bar d-none d-md-block">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="top-bar-left">
                            <div class="text">
                                <h2>8:00 - 21:00</h2>
                                <p>Ouvert Lun - Dim</p>
                            </div>
                            <div class="text">
                                <h2>+1 819 555 5555</h2>
                                <p>Appelez pour un rendez vous</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="top-bar-right">
                            <div class="social">
                                 <a href="https://twitter.com/Sunu_Cut"><i class="fab fa-twitter"></i></a>
                                <a href="https://www.facebook.com/profile.php?id=100090007423693&sk=photos&locale=fr_FR"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://www.instagram.com/sunu.cut/?next=%2F"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top Bar End -->

        <!-- Nav Bar Start -->
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
                        <a href="rendezvous.php" class="nav-item nav-link active">Entrevue</a>
                        <a href="portfolio.html" class="nav-item nav-link">Gallerie</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu">
                                <a href="single.html" class="dropdown-item">Single Page</a>
                            </div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Nav Bar End -->


        <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Rendez-vous</h2>
                    </div>
                    <div class="col-12">
                        <a href="price.html">Prix</a>
                        <a href="portfolio.html">Gallerie</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->


        <!-- Appointment Start -->
    <?php if(isset($_SESSION['roles'])){
        ?>

             <div class="container">
    <div class="row">
        <div class="col-lg-10 offset-lg-1"> <!-- Augmentation de la largeur du formulaire -->
            <div class="rendez">
                <h1>Prendre un rendez-vous</h1>
                <form action="entrevue.php" method="post">
                    <div class="form-group">
                        <label for="name">Nom :</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="date">Date :</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>

                    <div class="form-group">
                        <label for="time">Heure :</label>
                        <input type="time" class="form-control" id="time" name= "time" required>
                    </div>

                <div class="form-group">
                    <label for="service">Service :</label>
                    <select class="form-group" id="service" name="service" required>
                        <option value="rasage_simple">Rasage simple</option>
                        <option value="coupe_courte">Coupe courte</option>
                        <option value="tailler_barbe">Tailler la barbe</option>
                        <option value="rasage_barbe">Rasage de la barbe</option>
                        <option value="soins_barbe">Soins complets de la barbe</option>
                        <option value="taper">Taper</option>
                        <option value="lavage_cheveux">Lavage des cheveux</option>
                        <option value="degrade">Dégradé</option>
                        <option value="coloration">Coloration</option>
                        <option value="coiffure_mariage">Coiffure de mariage</option>
                        <option value="locks">Locks</option>
                        <option value="tresse">Tresse</option>
                        <option value="contours">Contours</option>
                    </select>
                </div>


                 <div class="text-center">
                         <button type="submit" class="btn btn-custom">Confirmer le rendez-vous</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php } ?>
    <!-- Appointment Start -->
   <?php if (!isset($_SESSION['roles'])) { ?>
    <style>
        .login-register-container {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 20px;
        }

        .login-register-buttons {
            display: flex;
            align-items: center; /* Centrer les éléments horizontalement */
        }

        .login-register-buttons a {
            background-color: #555; /* Couleur grise pour les boutons */
            color: #fff;
            padding: 15px 30px; /* Augmenter la taille des boutons */
            border-radius: 5px;
            text-decoration: none;
            margin: 0 10px; /* Espace entre les boutons */
            font-size: 18px; /* Augmenter la taille de la police */
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
        <p class="login-register-message">Inscrivez-vous et Connectez-vous pour bénéficier de la prise de rendez-vous</p>
    </div>
<?php } ?>




        <!-- apointment End -->


        <!-- Footer Start -->
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                       <div class="row">
                            <div class="col-md-6">
                                <div class="footer-contact">
                                    <h2>Salon Address</h2>
                                    <p><i class="fa fa-map-marker-alt"></i>Downtown, Ottawa, ON, Canada</p>
                                    <p><i class="fa fa-phone-alt"></i>+1 819 555 5555</p>
                                    <p><i class="fa fa-envelope"></i>SunuCut@gmail.com</p>
                                    <div class="footer-social">
                                       <a href="https://twitter.com/Sunu_Cut"><i class="fab fa-twitter"></i></a>
                                        <a href="https://www.facebook.com/profile.php?id=100090007423693&sk=photos&locale=fr_FR"><i class="fab fa-facebook-f"></i></a>
                                        <a href="https://www.youtube.com/channel/UCGoudNtzpLnqf8z7JMkapsg"><i class="fab fa-youtube"></i></a>
                                        <a href="https://www.instagram.com/sunu.cut/?next=%2F"><i class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="footer-link">
                                    <h2>Quick Links</h2>
                                    <a href="single.html">FAQs</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                    </div>
                </div>
            </div>
            <div class="container copyright">
                <div class="row">
                    <div class="col-md-6">
                        <p>&copy; <a href="#">Sunu Cut</a>, All Right Reserved.</p>
                    </div>
                    <div class="col-md-6">
                       
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/isotope/isotope.pkgd.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>

        <!-- Contact Javascript File -->
        <script src="mail/jqBootstrapValidation.min.js"></script>
        <script src="mail/contact.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>
