<?php
include_once('conexionbdd.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $service = $_POST['service'];

    // Obtenir la durée de la session en minutes en fonction du service choisi
    $session_duration = 30; // Durée par défaut (en minutes)
    
    switch ($service) {
        case 'rasage_simple':
            $session_duration = 20;
            break;
        case 'buzz_cut':
            $session_duration = 15;
            break;
        case 'tailler_barbe':
        case 'rasage_barbe':
            $session_duration = 15;
            break;
        case 'soins_complets_barbe':
            $session_duration = 60;
            break;
        case 'taper':
            $session_duration = 30;
            break;
        case 'lavage_cheveux':
            $session_duration = 15;
            break;
        case 'degrade':
            $session_duration = 30;
            break;
        case 'coloration':
            $session_duration = 60;
            break;
        case 'coiffure_mariage':
            $session_duration = 120;
            break;
        case 'locks':
            $session_duration = 180;
            break;
        case 'tresse':
            $session_duration = 120;
            break;
        case 'contours':
            $session_duration = 25;
            break;
        default:
            $session_duration = 30; // Valeur par défaut si l'option n'est pas reconnue
            break;
    }

    // Convertir la durée en intervalle pour l'utilisation dans le calcul de la période de réservation
    $session_interval = 'PT' . $session_duration . 'M';

    // Calculer les dates de début et de fin de la période de réservation
    $dateTimeSelected = new DateTime($date . ' ' . $time);
    $dateTimeStart = clone $dateTimeSelected;
    $dateTimeStart->sub(new DateInterval($session_interval));

    $dateTimeEnd = clone $dateTimeSelected;
    $dateTimeEnd->add(new DateInterval($session_interval));

    if ($conn->connect_error) {
        die("La connexion à la base de données a échoué : " . $conn->connect_error);
    }

    // Requête SQL pour vérifier si des rendez-vous existent dans la période de réservation
    $sql_check = "SELECT COUNT(*) AS count FROM rendezvous WHERE date = ? AND time BETWEEN ? AND ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("sss", $date, $dateTimeStartFormatted, $dateTimeEndFormatted);
    $dateTimeStartFormatted = $dateTimeStart->format('H:i:s');
    $dateTimeEndFormatted = $dateTimeEnd->format('H:i:s');

    $stmt_check->execute();
    $result = $stmt_check->get_result();
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        echo '<style>.error-message { background-color: #ff6b6b; color: #fff; padding: 10px; border: 1px solid #ff0000; margin: 10px 0; border-radius: 5px; }</style>';
        echo '<div class="error-message">La période de réservation est déjà occupée 🥺.</div>';
    } else {
        // L'heure n'est pas réservée dans la période de réservation, procédez à l'insertion
        $sql_insert = "INSERT INTO rendezvous (name, email, date, time, service) VALUES (?, ?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("sssss", $name, $email, $date, $time, $service);

        if ($stmt_insert->execute()) {
            echo '<style>.success-message { background-color: #6dff8c; color: #000; padding: 10px; border: 1px solid #00ff00; margin: 10px 0; border-radius: 5px; }</style>';
            echo '<div class="success-message">Rendez-vous enregistré avec succès, A bientot 😀.</div>';
        } else {
            echo '<style>.error-message { background-color: #ff6b6b; color: #fff; padding: 10px; border: 1px solid #ff0000; margin: 10px 0; border-radius: 5px; }</style>';
            echo '<div class="error-message">Erreur : ' . $conn->error . '</div>';
        }

        $stmt_insert->close();
    }

    $stmt_check->close();
    $conn->close();
}
?>