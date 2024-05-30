<?php
$servername = "localhost";
$username = "safwane.el.masaoudi@student.ehb.be";
$password = "Password";
$dbname = "laravel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$query = isset($_GET['query']) ? $_GET['query'] : '';

if ($query) {
    $sql = "SELECT * FROM votre_table WHERE votre_colonne LIKE ?";
    $stmt = $conn->prepare($sql);
    $search = "%$query%";
    $stmt->bind_param("s", $search);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Résultat: " . htmlspecialchars($row["votre_colonne"]) . "<br>";
        }
    } else {
        echo "0 résultats trouvés";
    }

    $stmt->close();
} else {
    echo "Veuillez entrer un terme de recherche.";
}

$conn->close();
?>
