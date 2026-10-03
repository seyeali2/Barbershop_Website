<?php
session_start();

// Inclure le fichier de connexion à la base de données (connexionbdd.php)
include('conexionbdd.php');

// Assurez-vous que la table s'appelle "roles" et que le rôle de l'utilisateur est stocké dans une colonne appelée "role".
// Effectuez une requête pour obtenir le rôle de l'utilisateur actuellement connecté.
// Remarque : Le code de la requête SQL peut varier en fonction de votre base de données.

// Exemple de requête SQL pour obtenir le rôle d'un utilisateur fictif (remplacez cela par la requête réelle) :
$sql = "SELECT role FROM roles WHERE user_id = '123'"; // Remplacez '123' par l'ID de l'utilisateur actuel.

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
        <title>Sunu Cut</title>
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
                                <p>Appelez pour un rendez-vous</p>
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
                <a href="rendezvous.php" class="nav-item nav-link">Entrevue</a>
                <a href="portfolio.html" class="nav-item nav-link">Gallerie</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu">
                        <a href="single.html" class="dropdown-item">FAQ's</a>
                        <a href="events.php" class="dropdown-item">roue mensuel</a>
                    </div>
                </div>
                <a href="contact.html" class="nav-item nav-link">Contact</a>
                
                <?php
                if (isset($_SESSION['roles']) && $_SESSION['roles'] === '2') {
                    // Affichez le lien "Admin" uniquement si le rôle de l'utilisateur est égal à 2 (administrateur)
                    echo '<a href="admin_page.php" class="nav-item nav-link" id="adminLink">admin</a>';
                }
                if (!isset($_SESSION['prenom']) && !isset($_SESSION['nom'])) {
                    // Affichez le lien "S'inscrire" uniquement si l'utilisateur n'est pas connecté
                    echo '<a href="index_3.php" class="nav-item nav-link active" id="inscriptionLink">S\'inscrire</a>';
                }
                ?>
                <?php if(isset($_SESSION['roles'])){
                      echo '<a href="deconnexion.php" class="nav-item nav-link" id="inscriptionLink">Deconnexion</a>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>



        <!-- Nav Bar End -->


        <!-- Hero Start -->
        <div class="hero">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="hero-text">
                            <h1>Sunu Cut</h1>
                            <p>
                                Bienvenue chez Sunu Cut - Votre Destination de Style Masculin

                                Au Salon de Coiffure Sunu Cut nous sommes fiers de transformer les cheveux en œuvres d'art 
                            </p>
                            <a class="btn" href="https://www.pinterest.fr/search/pins/?rs=ac&len=2&q=coupe%20de%20cheveux%20homme&eq=coupe%20d&etslf=5956">Visit styles</a>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 d-none d-md-block">
                        <div class="hero-image">
                            <img src="img/heroo.jpg" alt="Hero Image">
                        </div>
                    </div>
                </div>
                <button type="button" class="btn-play" data-toggle="modal" data-src="https://www.gq.com/video/watch/gq-matty-conrad-grooming-show-face-shapes" data-target="#videoModal">
                    <span></span>
                </button>
            </div>
        </div>
        <!-- Hero End -->

        <!-- Video Modal Start-->
        <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>        
                        <!-- 16:9 aspect ratio -->
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <!-- Video Modal End -->



        <!-- About Start -->
        <div class="about">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-6">
                        <div class="about-img">
                            <img src="img/about.jpeg" alt="Image">
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6">
                        <div class="section-header text-left">
                            <p>Apprendre a propos de nous</p>
                            <h2>3 annés d'experience</h2>
                        </div>
                        <div class="about-text">
                            <p>
                                Nous sommes fiers de servir une communauté de clients fidèles qui reviennent pour l'expérience Sunu Cut. Joignez-vous à notre famille de clients satisfaits et découvrez pourquoi nous sommes le choix numéro un en matière de coiffure masculine.
                            </p>
                            <p>
                                Chez Sunu, nous croyons que chaque homme est une toile vierge avec un potentiel de style illimité. Notre équipe de coiffeurs talentueux est dévouée à vous aider à explorer ce potentiel et à créer une image qui exprime votre personnalité unique. Chaque coupe, chaque rasage et chaque soin sont exécutés avec une précision artistique, pour que vous puissiez vous sentir confiant à chaque pas.
                            </p>
                            <a class="btn" href="about.html">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Service Start -->
        <div class="service">
            <div class="container">
                <div class="section-header text-center">
                    <p>les Servives Salon</p>
                    <h2>Meilleur Services pour vous!</h2>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="img/service-1.jpg" alt="Image">
                            </div>
                            <h3>coiffure</h3>
                            <p>
                                Que vous recherchiez une coupe tendance qui suit les dernières tendances de la mode, une coupe classique intemporelle ou même une transformation audacieuse.
                            </p>
                            <a class="btn" href="service.html">Plus</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="img/service-2.jpg" alt="Image">
                            </div>
                            <h3>style barbe</h3>
                            <p>
                                Nos barbiers experts sont là pour vous offrir une expérience. Que vous souhaitiez une coupe de barbe classique, une taille précise, ou même une transformation audacieuse.
                            </p>
                            <a class="btn" href="service.html">Plus</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="img/service-3.jpg" alt="Image">
                            </div>
                            <h3>Coloration & lavage</h3>
                            <p>
                                Chez nous, chaque client est unique, tout comme ses cheveux. Notre équipe de coiffeurs professionnels est formée pour prendre soin de vos cheveux de la racine aux pointes.
                            </p>
                            <a class="btn" href="service.html">Plus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->

        
        
        <!-- Testimonial Start -->
        <div class="testimonial">


            <div class="container">
               <h2 style="color: beige;">Les clients populaires</h2>

                <div class="owl-carousel testimonials-carousel">
                    <div class="testimonial-item">
                        <img src="img/testimonial-1.jpg" alt="Image">
                        <p>
                           Je tiens à exprimer ma grande satisfaction envers la coupe de cheveux que j'ai récemment obtenue au salon "Sunu Cut". Mon coiffeur a vraiment su comprendre mes attentes et mes préférences. La coupe était précise et parfaitement adaptée à mon style. Je suis particulièrement heureux du résultat et je me sens vraiment bien dans ma peau grâce à cette nouvelle coupe. Je recommande vivement le salon "Sunu Cut" à tous ceux et celles à la recherche d'une expérience coiffure exceptionnelle. Merci encore pour ce travail remarquable !
                        </p>
                        <h2>jean pascal</h2>
                        <h3>Boxeur</h3>
                        
                    </div>
                    <div class="testimonial-item">
                        <img src="img/testimonial-2.jpg" alt="Image">
                        <p>
                            Je viens tout juste de sortir du salon "Sunu Cut" et je ne pourrais pas être plus satisfait de ma coupe de cheveux. Mon coiffeura fait un travail exceptionnel en écoutant attentivement ce que je voulais, et le résultat est tout simplement incroyable. Ma coupe est précise, moderne et correspond exactement à ce que je recherchais. Le service au salon était également excellent, avec une ambiance agréable et un personnel amical. Je suis ravi de ma visite chez "Sunu Cut" et je le recommande vivement à quiconque cherche une expérience de coiffure de haute qualité. Merci à toute l'équipe pour cette superbe coupe !
                        </p>
                        <h2>Mouhamed VJ</h2>
                        <h3>Chanteur</h3>
                    </div>
                    <div class="testimonial-item">
                        <img src="img/testimonial-3.jpg" alt="Image">
                        <p>
                            Ma récente visite au salon "Sunu Cut" a été une expérience coiffure exceptionnelle. Mon coiffeur a su capturer parfaitement mon style et mes préférences en matière de coupe de cheveux. Le résultat était impeccable, avec une coupe qui met en valeur mon look tout en étant facile à entretenir au quotidien. L'atmosphère chaleureuse et conviviale du salon a également contribué à rendre mon expérience mémorable. Je tiens à remercier l'équipe de "Sunu Cut" pour leur expertise et leur professionnalisme. Je recommande ce salon à quiconque recherche une coupe de cheveux de qualité et une expérience agréable en salon de coiffure.
                        </p>
                        <h2>Shai gielgious alexander</h2>
                        <h3>Basketteur NBA</h3>
                    </div>
                </div>
                 <p style="color: beige;">Si vous avez également eu une expérience chez "Sunu Cut", n'hésitez pas à <a href="avis.php">donner votre avis</a> !</p>
            </div>
        </div>

        <!-- Testimonial End -->


        <!-- Team Start -->
        <div class="team">
            <div class="container">
                <div class="section-header text-center">
                    <p>Notre equipe</p>
                    <h2>Nos Barber Experimente</h2>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="img/team-1.jpg" alt="Team Image">
                            </div>
                            <div class="team-text">
                                <h2>Gerard Foncer</h2>
                                <p>Professionel Barbe</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="img/team-2.jpg" alt="Team Image">
                            </div>
                            <div class="team-text">
                                <h2>John Freaks</h2>
                                <p>Expert Cheuveux</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="img/team-3.jpg" alt="Team Image">
                            </div>
                            <div class="team-text">
                                <h2>Mac Gill Trap</h2>
                                <p>Tresseur</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="img/team-4.jpg" alt="Team Image">
                            </div>
                            <div class="team-text">
                                <h2>Russel Westbrook</h2>
                                <p>Coloration expert</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team End -->
        
        
        
        
        


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
                        <div class="footer-newsletter">
                           
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container copyright">
                <div class="row">
                    <div class="col-md-6">
                        <p>&copy; <a href="index.html">Sunu Cut</a>, All Right Reserved.</p>
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
