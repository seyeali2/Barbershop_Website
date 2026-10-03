<?php
session_start();
include('conexionbdd.php');

if (isset($_GET['searchName'])) {
    $searchName = isset($_GET['searchName']) ? $_GET['searchName'] : "";

    // Requête pour rechercher les utilisateurs par nom/prénom dans la base de données
    $sql = "SELECT * FROM utilisateurs WHERE nom LIKE '%$searchName%' OR prenom LIKE '%$searchName%'";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table>
        <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Action</th>
        </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
            <td>{$row['nom']}</td>
            <td>{$row['prenom']}</td>
            <td>
                <form action='banir_utilisateur.php' method='post'>
                    <input type='hidden' name='user_id' value='{$row['id']}'>
                    <input type='submit' value='Bannir'>
                </form>
            </td>
            </tr>";
        }

        echo "</table>";
    } else {
        echo "Aucun utilisateur trouvé pour ce nom/prénom.";
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

a {
    color: red;
    text-decoration: none;
}
</style>
