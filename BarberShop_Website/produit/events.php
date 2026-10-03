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
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Contact Sunu cut</title>
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
        <script src="js/script.js"></script>
        <link href="css/style.css" rel="stylesheet">
        <link href="css/single.css" rel="stylesheet">
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
                            <a href="#" class="nav-link dropdown-toggle active" data-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu">
                                <a href="single.html" class="dropdown-item">FAQ's</a>
                                <a href="events.php" class="dropdown-item">roue mensuel</a>
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
                        <h2>Evenements</h2>
                    </div>
                    <div class="col-12">
                        <a href="portfolio.html">Gallerie</a>
                        <a href="contact.html">Contact</a>
                    </div>
                </div>
            </div>
        </div>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php
if (!isset($_SESSION['roles'])) {
?>

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





<body>

    <section class="roulette" id="roulette">

    <div class="containero">
        <div class="spinBtn"> Spin </div>
        <div class="wheel">
        <div class="number" style="--i:1;--clr:#74cddd;"> <span> 10% </span></div>
        <div class="number" style="--i:2;--clr:#e2d777;"> <span> 15% </span></div>
        <div class="number" style="--i:3;--clr:#7770db;"> <span> 17% </span></div>
        <div class="number" style="--i:4;--clr:#e07f9f;"> <span> 5% </span></div>
        <div class="number" style="--i:5;--clr:#83dd77;"> <span> 0% </span></div>
        <div class="number" style="--i:6;--clr:#dd6161;"> <span> 25% </span></div>
        <div class="number" style="--i:7;--clr:#db70db;"> <span> 20% </span></div>
        <div class="number" style="--i:8;--clr:#d6765e;"> <span> %0 </span></div>
        </div>
        <div class="result"></div>
        </div>


    </section>

   <form id="discountForm" action="generatemessage.php" method="POST" style="display:none;">
    <input type="hidden" name="discountWon" id="discountWonInput">
    <input type="submit">
</form>
     <script>
let wheel = document.querySelector('.wheel');
let spinBtn = document.querySelector('.spinBtn');
let value = 0; // Initialiser à 0 pour garder une trace de l'angle total de rotation

const discounts = ['10%', '15%', '17%', '5%', '0%', '25%', '20%', '0%']; // Assurez-vous que cela correspond à vos segments

spinBtn.addEventListener('click', function() {
    // Ajoutez une rotation aléatoire de 2 à 4 tours pour plus de variabilité
    let additionalDegrees = Math.ceil(Math.random() * 3600) + 1440; // 1440 est 4 tours (360 * 4)
    value += additionalDegrees;
    wheel.style.transition = 'transform 4s ease-out'; // Assurez-vous que cela correspond à la durée de votre animation CSS
    wheel.style.transform = `rotate(${value}deg)`;

    setTimeout(() => {
        let degrees = value % 360; // Obtenir l'angle final dans un tour complet (0-359)
        let segmentSize = 360 / discounts.length; // La taille de chaque segment en degrés
        let segmentIndex = Math.floor(degrees / segmentSize); // Déterminer le segment sur lequel la roue s'est arrêtée

        let discountWon = discounts[discounts.length - segmentIndex - 1]; // Ajustement basé sur la direction de rotation et le positionnement du marqueur

        // Soumettre la réduction gagnée
        document.getElementById('discountWonInput').value = discountWon;
        document.getElementById('discountForm').submit();
    }, 4000); // Correspond à la durée de l'animation CSS
});
</script>



<style>

 
       

        .babyland {
            color: #333;
            font-weight: bold;
            font-size: 2em;
            text-decoration: none;
            padding-left: 30%;
        }

        .babyland span {
            color: #fa8072;
            font-size: 1em;
        }

        p {
            font-family: 'Times New Roman', Times, serif;
            color: #666;
            margin: 5%;
        }

        #roulette {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #ffffff;
        }

        .containero {
            top: -50px;
            position: relative;
            width: 400px;
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
           
        }

        .containero .spinBtn {
            position: absolute;
            width: 60px;
            height: 60px;
            background: #4CAF50;
            border-radius: 50%;
            z-index: 10;
            display: flex;
            justify-content: center;
            align-items: center;
            text-transform: uppercase;
            font-weight: 600;
            color: #fff;
            letter-spacing: 0.1em;
            border: 4px solid rgba(0, 0, 0, 0.75);
            cursor: pointer;
            user-select: none;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }

        .containero .spinBtn::before {
            content: '';
            position: absolute;
            top: -30px;
            width: 20px;
            height: 30px;
            background: #fff;
            clip-path: polygon(50% 0%, 15% 100%, 85% 100%);
        }

        .containero .wheel {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #009688, #F44336);
            border-radius: 50%;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5), inset 0 0 10px rgba(255, 255, 255, 0.5);
            transition: transform 6s ease-out;
        }

        .containero .wheel .number {
            position: absolute;
            width: 50%;
            height: 50%;
            background: rgba(255, 255, 255, 0.8);
            transform-origin: bottom right;
            transform: rotate(calc(45deg * var(--i)));
            clip-path: polygon(0 0, 56% 0, 100% 100%, 0 56%);
            display: flex;
            justify-content: center;
            align-items: center;
            user-select: none;
            cursor: pointer;
        }

        .containero .wheel .number span {
            position: relative;
            transform: rotate(45deg);
            font-size: 2em;
            font-weight: 700;
            color: #333;
            text-shadow: none;
        }

        .containero .wheel .number span::after {
            position: absolute;
            font-size: 0.75em;
            font-weight: 500;
        }


</body>
</html>

