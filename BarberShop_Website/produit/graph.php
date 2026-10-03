<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Graphique</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="img/favicon.ico" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <style>
        .chart-box {
            margin: 30px auto;
            width: 50%;
            text-align: center;
        }

        .chart-box canvas {
            width: 300px; /* Largeur du canvas réduite */
            height: 200px; /* Hauteur du canvas réduite */
        }
    </style>
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
                    <a href="graph.php" class="nav-item nav-link active">graph</a>
                    <a href="evaluation.php" class="nav-item nav-link">evaluation</a>
                    <a href="utilisateurs.php" class="nav-item nav-link">utilisateurs</a>
                </div>
            </div>
        </div>
    </div>

    <div class="chart-container">
        <div class="chart-box">
            <h3 style="text-align: center;">Nombre de rendez-vous par service</h3>
            <canvas id="myBarChart" width="1000" height="500"></canvas>
        </div>
    </div>

    <div class="chart-container">
        <div class="chart-box">
            <h3 style="text-align: center;">Répartition des rendez-vous</h3>
            <canvas id="myPieChart" width="400" height="200"></canvas> 
        </div>
    </div>

    <?php
    include_once('conexionbdd.php');

    if ($conn) {
        $query = "SELECT service, COUNT(*) AS total FROM rendezvous GROUP BY service";
        $result = $conn->query($query);

        $labels = array();
        $data = array();
        $backgroundColors = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $labels[] = $row['service'];
                $data[] = $row['total'];
                $backgroundColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            }
        }
        ?>

        <script>
            var dataBar = {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Nombre de rendez-vous par service',
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: <?php echo json_encode($backgroundColors); ?>,
                    borderWidth: 1
                }]
            };

            var ctxBar = document.getElementById('myBarChart').getContext('2d');
            var myBarChart = new Chart(ctxBar, {
                type: 'bar',
                data: dataBar,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

        <?php
        $result->free();
        
        $queryStatus = "SELECT COUNT(*) AS total, status FROM rendezvous GROUP BY status";
        $resultStatus = $conn->query($queryStatus);

        $labelsStatus = array();
        $dataStatus = array();
        $backgroundColorsStatus = array();

        if ($resultStatus->num_rows > 0) {
            while ($row = $resultStatus->fetch_assoc()) {
                $labelsStatus[] = $row['status'];
                $dataStatus[] = $row['total'];
                $backgroundColorsStatus[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            }
        }
        ?>

        <script>
            var dataPie = {
                labels: <?php echo json_encode($labelsStatus); ?>,
                datasets: [{
                    label: 'Répartition des rendez-vous par statut',
                    data: <?php echo json_encode($dataStatus); ?>,
                    backgroundColor: <?php echo json_encode($backgroundColorsStatus); ?>,
                    borderWidth: 1
                }]
            };

            var ctxPie = document.getElementById('myPieChart').getContext('2d');
            var myPieChart = new Chart(ctxPie, {
                type: 'pie',
                data: dataPie,
                options: {
                // Options personnalisées pour le graphique camembert
                }
            });
        </script>

        <?php
        $resultStatus->free();
        $conn->close();
    } else {
        echo "La connexion à la base de données a échoué.";
    }
    ?>

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