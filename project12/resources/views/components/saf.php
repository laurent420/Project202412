<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoekresultaten</title>
</head>
<body>
    <h1>Zoekresultaten</h1>
    <?php
    // Controleer of de zoekterm is ingediend
    if (isset($_GET['query'])) {
        // Verbind met de database (vervang 'host', 'gebruikersnaam', 'wachtwoord', 'database' met de juiste gegevens)
        $conn = new mysqli('host', 'gebruikersnaam', 'wachtwoord', 'database');

        // Controleer op fouten bij het maken van de verbinding
        if ($conn->connect_error) {
            die("Kan geen verbinding maken met de database: " . $conn->connect_error);
        }

        // Voer een zoekopdracht uit op basis van de zoekterm
        $search_query = $_GET['query'];
        $sql = "SELECT * FROM your_table WHERE column_name LIKE '%$search_query%'";
        $result = $conn->query($sql);

        // Controleer of er resultaten zijn gevonden
        if ($result->num_rows > 0) {
            // Loop door de resultaten en toon ze
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row['column_name'] . "</p>";
            }
        } else {
            echo "Geen resultaten gevonden voor '" . $search_query . "'";
        }

        // Sluit de databaseverbinding
        $conn->close();
    } else {
        echo "Geen zoekterm opgegeven.";
    }
    ?>
</body>
</html>