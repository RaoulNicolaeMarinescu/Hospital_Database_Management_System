<?php 
    include 'config.php'; 

    $tabella = $_SESSION['tabella'];
    $_SESSION['toupdate'] = $_POST['toupdate'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Control</title>
</head>
    <body>
        <?php
            switch ($tabella) {
                case "personalemedico":
                    header('Location: update_personale.php');
                    break;
                
                case "ospedale":
                    header('Location: update_ospedale.php');
                    break;

                case "paziente":
                    header('Location: update_pazienti.php');
                    break;

                case "esame":
                    header('Location: update_esami.php');
                    break;
                
                case "prenotazione":
                    header('Location: update_prenotazioni.php');
                    break;
            }
        ?>
    </body>
</html>

