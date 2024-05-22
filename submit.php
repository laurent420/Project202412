<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['agree']) && $_POST['agree'] == 'yes') {
        echo "Danku voor het accepteren van de gebruiksvoorwaarden.";
    } else {
        echo "U moet de gebruiksvoorwaarden accepteren om verder te kunnen gaan.";
    }
} else {
    echo "Onbevoegde aanvraagmethode.";
}
?>
