<?php
session_start();


include('conexionbdd.php');

if (isset($_GET['searchDate']) || isset($_GET['searchName'])) {
    $searchDate = isset($_GET['searchDate']) ? $_GET['searchDate'] : "";
    $searchName = isset($_GET['searchName']) ? $_GET['searchName'] : "";

    // Requête pour rechercher les rendez-vous par date et/ou nom/prénom dans la base de données
    $sql = "SELECT * FROM rendezvous WHERE 1";

    if (!empty($searchDate)) {
        $sql .= " AND date = '$searchDate'";
    }

    if (!empty($searchName)) {
        $sql .= " AND name LIKE '%$searchName%'";
    }

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
     echo "<table>
     <tr>
     <th>Nom</th>
     <th>Date</th>
     <th>Heure</th>
     <th>Service</th>
     <th>Email</th>
     <th>État</th>
     <th>Action</th>
     </tr>";

     while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
        <td>{$row['name']}</td>
        <td>{$row['date']}</td>
        <td>{$row['time']}</td>
        <td>{$row['service']}</td>
        <td>{$row['email']}</td>
        <td>
        <form method='POST' action='update_status.php'> 
        <input type='hidden' name='rendezvous_id' value='{$row['id']}'>
        <select name='status'>
        <option value='En attente' " . ($row['status'] === 'En attente' ? 'selected' : '') . ">En attente</option>
        <option value='Effectué' " . ($row['status'] === 'Effectué' ? 'selected' : '') . ">Effectué</option>
        </select>
        <input type='submit' value='Modifier'>
        </form>
        </td>
        <td>
        <form method='POST' action='supprimer_rendezvous.php'>
        <input type='hidden' name='rendezvous_id' value='{$row['id']}'>
        <input type='submit' value='Supprimer'>
        </form>
        </td>
        </tr>";
    }

    echo "</table>";

} else {
    echo "Aucun rendez-vous trouvé pour ces critères de recherche.";
}
}
?>
<style>
    
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
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