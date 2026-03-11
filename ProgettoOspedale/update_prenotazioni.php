<!DOCTYPE html>
<html>
    <head>
        <title>Update personale</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php 
            include 'config.php'; 

            $error_message = "";

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $codicePrenotazione = $_POST['codicePrenotazione'];
                $laboratorioAmbulatorio = $_POST['laboratorioAmbulatorio'];
                $tesseraSanitaria = $_POST['tesseraSanitaria'];
                $codiceEsame = $_POST['codiceEsame'];
                $oraEsame = $_POST['oraEsame'];
                $dataPrenotazione = $_POST['dataPrenotazione'];
                $regimeCosto = $_POST['regimeCosto'];
                $urgenza = $_POST['urgenza'];
                $dataEsame = $_POST['dataEsame'];

                $query = "UPDATE prenotazione 
                        SET LaboratorioAmbulatorio='$laboratorioAmbulatorio', TesseraSanitaria='$tesseraSanitaria', CodiceEsame='$codiceEsame', OraEsame='$oraEsame', DataPrenotazione='$dataPrenotazione', RegimeCosto='$regimeCosto', Urgenza='$urgenza', DataEsame='$dataEsame' 
                        WHERE CodicePrenotazione='$codicePrenotazione'";
                
                // Controlli

                $cf_check_query = "SELECT TesseraSanitaria, CodiceEsame, DataEsame
                                   FROM prenotazione
                                   WHERE TesseraSanitaria = '$tesseraSanitaria' 
                                        AND CodiceEsame = '$codiceEsame' 
                                        AND DataEsame = '$dataEsame'";
                $cf_check_result = pg_query($conn, $cf_check_query);

                if (pg_num_rows($cf_check_result) > 0) {
                    $error_message = $error_message . "Errore: Una persona non puo fare una prenotazione di un specifico esame più di una volta al giorno!";
                } else if (($dataEsame <= date('Y-m-d')) && ($oraEsame <= date('H:i'))) {
                    $error_message = $error_message . "Errore: La data dell'esame deve essere dopo o lo stesso giorno della data di prenotazione!";
                } else if (pg_query($conn, $query)) {
                        echo "<div class='container'>";
                        echo "<div class='box'>";
                        echo "<p class='success'>Record aggiornato con successo</p>";
                        echo "<div class='footer'><a href='homepage.php'>indietro</a> </div>";
                        echo "</div>";
                        echo "</div>";
                        exit();
                    }
                }
        ?>

        <div class='container'>
        <div class='box'>

        <?php 
        //form
        if (!empty($error_message)) {
            echo "<p class='error'>$error_message</p>";
        }

        $query = "SELECT * FROM prenotazione WHERE CodicePrenotazione='". $_SESSION['toupdate'] . "'";
        $result = pg_query($conn, $query);

        if (!$result) {
            die('Errore nella query: ' . pg_last_error($conn));
        }

        $row = pg_fetch_row($result);

        echo "<table>";
            echo "<form action='' method='POST'>";
                echo "<tr>";
                    echo "<th>Codice Prenotazione</th>";
                    echo "<td><input type='text' name='codicePrenotazione' value='" . $row[0] . "' required readonly></td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>Laboratorio / Ambulatorio</th>";
                    echo "<td>";
                    echo "<select name='laboratorioAmbulatorio'>";
                    $query2 = "SELECT CodiceLabAmb, Tipo FROM laboratorioambulatorio";
                    $result2 = pg_query($conn, $query2);
                    while ($row2 = pg_fetch_row($result2)) {
                        echo "<option value='" . $row2[0] . "'>(" . $row2[0] . ") - " . $row2[1] . "</option>";
                    }
                    echo "</select>";
                    echo "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>Tessera Sanitaria</th>";
                    echo "<td>";
                    echo "<select name='tesseraSanitaria'>";
                    $query2 = "SELECT TesseraSanitaria, Nome, Cognome FROM paziente";
                    $result2 = pg_query($conn, $query2);
                    while ($row2 = pg_fetch_row($result2)) {
                        echo "<option value='" . $row2[0] . "'>(" . $row2[0] . ") - " . $row2[1] . " " . $row2[2] . "</option>";
                    }
                    echo "</select>";
                    echo "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>Codice Esame</th>";
                    echo "<td>";
                    echo "<select name='codiceEsame'>";
                    $query2 = "SELECT CodiceEsame, Descrizione FROM esame";
                    $result2 = pg_query($conn, $query2);
                    while ($row2 = pg_fetch_row($result2)) {
                        echo "<option value='" . $row2[0] . "'>(" . $row2[0] . ") - " . $row2[1] . "</option>";
                    }
                    echo "</select>";
                    echo "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>Ora Esame</th>";
                    echo "<td><input type='time' name='oraEsame' value='" . $row[4] . "' required></td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>Data Prenotazione</th>";
                    echo "<td><input type='date' name='dataPrenotazione' value='" . $row[5] . "'></td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>Regime Costo</th>";
                    echo "<td>";
                        echo '<select name="regimeCosto">';
                            echo '<option value="privato">Privato</option>';
                            echo '<option value="pubblico">Pubblico</option>';
                        echo '</select>';
                    echo '</td>';
                echo "</tr>";

                echo "<tr>";
                    echo "<th>Urgenza</th>";
                    echo "<td>";
                        echo '<select name="urgenza">';
                            echo '<option value="verde">Verde</option>';
                            echo '<option value="giallo">Giallo</option>';
                            echo '<option value="rosso">Rosso</option>';
                        echo '</select>';
                    echo '</td>';
                echo "</tr>";

                echo "<tr>";
                    echo "<th>Data Esame</th>";
                    echo "<td><input type='date' name='dataEsame' value='" . $row[8] . "'></td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td colspan='9' style='text-align: center;'>";
                        echo "<input type='submit' name='toupdate2' value='Invia'>";
                    echo "</td>";
                echo "</tr>";
            echo "</form>";
        echo "</table>";
        ?>

        <div class='footer'><a href='homepage.php'>indietro</a></div>
        </div>
        </div>
        
    </body>
</html>