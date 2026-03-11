<!DOCTYPE html>
<html>
    <head>
        <title>Inserimento esame</title>
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
            //$dataPrenotazione = $_POST['dataPrenotazione'];
            $regimeCosto = $_POST['regimeCosto'];
            $urgenza = $_POST['urgenza'];
            $dataEsame = $_POST['dataEsame'];
               

            // Controllo lunghezza codice prenotazione
            if (strlen($codicePrenotazione) != 6) {
                $error_message = $error_message . "Errore: Il codice prenotazione deve essere lungo esattamente 6 caratteri.";
            // Controllo lunghezza codice fiscale
            } else if (strlen($tesseraSanitaria) != 20) {
                $error_message = $error_message . "\nErrore: La tessera sanitaria deve essere lunga esattamente 20 caratteri.";
            } else {
                // Controllo che si possa fare fare una prenotazione di un specifico esame più di una volta al giorno
                $cf_check_query = "SELECT TesseraSanitaria, CodiceEsame, DataEsame
                                    FROM prenotazione
                                    WHERE TesseraSanitaria = '$tesseraSanitaria' 
                                        AND CodiceEsame = '$codiceEsame' 
                                        AND DataEsame = '$dataEsame'";
                $cf_check_result = pg_query($conn, $cf_check_query);

                // Controllo se il codice prenotazione esiste già
                $cp_check_query = "SELECT CodicePrenotazione FROM prenotazione WHERE CodicePrenotazione = '$codicePrenotazione'";
                $cp_check_result = pg_query($conn, $cp_check_query);

                if (pg_num_rows($cp_check_result) > 0) {
                    $error_message = $error_message . "\nErrore: Il codice prenotazione esiste già. Riprova.";
                } else if (pg_num_rows($cf_check_result) > 0) {
                    $error_message = $error_message . "Errore: Una persona non puo fare una prenotazione di un specifico esame più di una volta al giorno!";
                } else if (($dataEsame <= date('Y-m-d')) && ($oraEsame <= date('H:i'))) {
                    $error_message = $error_message . "Errore: La data dell'esame deve essere dopo o lo stesso giorno della data di prenotazione!";
                } else {
                    // Inserimento dei dati
                    $query = "INSERT INTO prenotazione (CodicePrenotazione, LaboratorioAmbulatorio, TesseraSanitaria, CodiceEsame, OraEsame, DataPrenotazione, RegimeCosto, Urgenza, DataEsame)
                    VALUES ('$codicePrenotazione', '$laboratorioAmbulatorio', '$tesseraSanitaria', '$codiceEsame', '$oraEsame', CURRENT_DATE, '$regimeCosto', '$urgenza', '$dataEsame')";
                    // se non funziona CURRENT_DATE si puo provare con CURDATE() o GETDATE() o date('now')

                    if (pg_query($conn, $query)) {
                        echo "<div class='container'>";
                        echo "<div class='box'>";
                        echo "<p class='success'>Record aggiornato con successo</p>";
                        echo "<div class='footer'><a href='homepage.php'>indietro</a> </div>";
                        echo "</div>";
                        echo "</div>";
                        exit();
                    }
                }
            }
        }
        ?>

        <div class='container'>
        <div class='box'>

        <?php 
        if (!empty($error_message)) {
            echo "<p class='error'>$error_message</p>";
        }
        ?>

        <table>
            <form action='' method='POST'>
                <tr>
                    <th>Codice Prenotazione</th>
                    <td><textarea name='codicePrenotazione' placeholder='Inserisci codice prenotazione' required></textarea></td>
                </tr>
            
                <tr>
                    <th>Laboratorio / Ambulatorio</th>
                    <td>
                        <?php
                            echo "<select name='laboratorioAmbulatorio'>";
                            $query = "SELECT CodiceLabAmb FROM laboratorioambulatorio";
                            $result = pg_query($conn, $query);
                            while ($row = pg_fetch_row($result)) {
                                echo "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
                            }
                            echo "</select>";
                        ?>
                    </td>
                </tr>

                <tr>
                    <th>Tessera Sanitaria</th>
                    <td>
                        <?php
                            echo "<select name='tesseraSanitaria'>";
                            $query = "SELECT TesseraSanitaria, Nome, Cognome  FROM paziente";
                            $result = pg_query($conn, $query);
                            while ($row = pg_fetch_row($result)) {
                                echo "<option value='" . $row[0] . "'>(" . $row[0] . ") - " . $row[1] . " " . $row[2] . "</option>";
                            }
                            echo "</select>";
                        ?>
                    </td>
                </tr>

                <tr>
                    <th>Codice Esame</th>
                    <td>
                        <?php
                            echo "<select name='codiceEsame'>";
                            $query = "SELECT CodiceEsame, Descrizione FROM esame";
                            $result = pg_query($conn, $query);
                            while ($row = pg_fetch_row($result)) {
                                echo "<option value='" . $row[0] . "'>" . $row[0] . " - " . $row[1] . "</option>";
                            }
                            echo "</select>";
                        ?>
                    </td>
                </tr>

                <tr>
                    <th>Ora esame</th>
                    <td><input type='time' name='oraEsame' placeholder="Inserisci l'ora dell'esame" required></td>
                </tr>

                <tr>
                    <th>Regime costo</th>
                    <td>
                        <select name="regimeCosto">
                            <option value="Privato">Privato</option>
                            <option value="Pubblico">Pubblico</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <th>Urgenza</th>
                    <td>
                        <select name="urgenza">
                            <option value="verde">Verde</option>
                            <option value="giallo">Giallo</option>
                            <option value="rosso">Rosso</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <th>Data Esame</th>
                    <td><input type='date' name='dataEsame' placeholder="Inserisci la data dell'esame" required></td>
                </tr>

                <tr>
                    <td colspan='2' style='text-align: center;'>
                        <input type='submit' name='inserisci' value='Inserisci'>
                    </td>
                </tr>
            </form>
        </table>

        <div class='footer'><a href='homepage.php'>indietro</a></div>
        </div>
        </div>
    </body>
</html>