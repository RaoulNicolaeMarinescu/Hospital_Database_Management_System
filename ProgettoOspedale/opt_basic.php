<!DOCTYPE html>
<html>
    <head>
        <title>Gestione Scelta</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class='container'>
            <div class='box'>
                <?php
                include 'config.php'; 


                if (isset($_POST['tabella'])) {
                    $operazione = substr($_POST['tabella'], 0, 1); //il primo carattere indica l'operazione
                    $tabella = substr($_POST['tabella'], 1); //il resto dei caratteri indicano l'operazione

                    $_SESSION['tabella'] = $tabella;
                    $_SESSION['operazione'] = $operazione;

                    switch ($operazione) {
                        case 'V':   // Caso di visualizzazione, faccio scegliere i parametri di visualizzazione
                            switch ($tabella) {
                                case "personale":
                                    $query = "SELECT CodiceOspedale, Nome FROM ospedale";
                                    $result = pg_query($conn, $query);

                                    if (!$result) {
                                        die('Errore nella query: ' . pg_last_error($conn));
                                    }
                                    
                                    echo "Seleziona di quale struttura vuoi vedere il personale<br><br>";
                                    echo "<form action='select_personale.php' method='POST'>";
                                        echo "<select name='ospedale'>";
                                            while ($row = pg_fetch_assoc($result)) {
                                                echo "<option value='" . $row['codiceospedale'] . "'>(" . $row['codiceospedale'] . ") - " . $row['nome'] . "</option>";
                                            }
                                        echo "</select>";
                                        echo "<input style='margin-left: 10px;' type='submit' value='Visualizza'>";
                                    echo "</form>";
                                    break; 


                                case 'pazientericoverato':
                                    echo "<div style='text-align: center;'>Seleziona il paziente e la struttura della<br>prenotazione che vuoi vedere</div><br><br>";
                                    echo "<form action='select_paziente.php' method='POST'>";

                                        $query = "SELECT TesseraSanitaria, Nome, Cognome FROM paziente";
                                        $result = pg_query($conn, $query);

                                        if (!$result) {
                                            die('Errore nella query: ' . pg_last_error($conn));
                                        }

                                        echo "<select name='paziente'>";
                                            echo "<optgroup label='TESSERA SANITARIA'>";
                                            while ($row = pg_fetch_array($result)) {
                                                echo "<option value='$row[0]'>(" . $row[0] . ") - " . $row[1] . " " . $row[2] . "</option>";
                                            }
                                        echo "</select>";

                                        $query = "SELECT CodiceOspedale, Nome FROM ospedale";
                                        $result = pg_query($conn, $query);

                                        echo "<select name='codice' style='margin-left: 10px;'>";
                                            echo "<optgroup label='CODICE OSPEDALE'>";
                                            while ($row = pg_fetch_array($result)) {
                                                echo "<option value='" . $row[0] . "'>(" . $row[0] . ") - " . $row[1] . "</option>";
                                            }
                                        echo "</select>";
                                        echo "<input style='margin-left: 10px;' type='submit' name='invia' value='Invia'>";
                                    echo "</form>";
                                    break;
                                }
                            break;


                        case 'I':   // Caso di inserimento
                            switch ($tabella) {
                                case "personale":
                                    header('Location: insert_personale.php');
                                    break;  
                                    
                                case "ospedale":
                                    header('Location: insert_ospedale.php');
                                    break; 

                                case "paziente":
                                    header('Location: insert_pazienti.php');
                                    break; 
                                case "esame":
                                    header('Location: insert_esami.php');
                                    break;  
                                    
                                case "prenotazione":
                                    header('Location: insert_prenotazioni.php');
                                    break; 
                            }
                            break;


                        case 'M':   // Caso di update, qua faccio scegliere quale tupla modificare
                                if (!empty($error_message)) {
                                    echo "<p class='error'>$error_message</p>";
                                }

                                $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='$tabella'";
                                $result = pg_query($conn, $query);
                                $numCol = pg_num_rows($result);

                                if (!$result) {
                                    die('Errore nella query: ' . pg_last_error($conn));
                                }
                            ?>
                                                
                            <table>
                                <form action='update.php' method='POST'>
                                    <tr>
                                    <th></th>   <!-- Serve per avere lo spazio vuoto che va al radio button -->

                                    <?php
                                        if ($tabella == "personalemedico") { // avevo gestito dinamicamente con la query che ce scritta sotto la visualizzazione di tutto, ma una volta spostatomi su postgre mi ha iniziato a dare i nomi delle colonne a caso, quindi ora ho dovuto ordinarle
                                            $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='personalemedico' ORDER BY CASE WHEN column_name = 'cf' THEN 1 WHEN column_name = 'reparto' THEN 2 WHEN column_name = 'nome' THEN 3 WHEN column_name = 'cognome' THEN 4 WHEN column_name = 'datanascita' THEN 5 END;";
                                            $result = pg_query($conn, $query);
                                            $numCol = pg_num_rows($result);

                                            if (!$result) {
                                                die('Errore nella query: ' . pg_last_error($conn));
                                            }
                                        } else if ($tabella == "paziente") {
                                            $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='paziente' ORDER BY CASE WHEN column_name = 'tesserasanitaria' THEN 1 WHEN column_name = 'nome' THEN 2 WHEN column_name = 'cognome' THEN 3 WHEN column_name = 'datanascita' THEN 4 END;";
                                            $result = pg_query($conn, $query);
                                            $numCol = pg_num_rows($result);

                                            if (!$result) {
                                                die('Errore nella query: ' . pg_last_error($conn));
                                            }
                                        } else if ($tabella == "esame") {
                                            $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='esame' ORDER BY CASE WHEN column_name = 'codiceesame' THEN 1 WHEN column_name = 'codicemedico' THEN 2 WHEN column_name = 'descrizione' THEN 3 WHEN column_name = 'costoassistenzasanitaria' THEN 4 WHEN column_name = 'costoprivato' THEN 5 WHEN column_name = 'avvertenze' THEN 6 END;";
                                            $result = pg_query($conn, $query);
                                            $numCol = pg_num_rows($result);

                                            if (!$result) {
                                                die('Errore nella query: ' . pg_last_error($conn));
                                            }
                                        } else if ($tabella == "prenotazione") {
                                            $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='prenotazione' ORDER BY CASE WHEN column_name = 'codiceprenotazione' THEN 1 WHEN column_name = 'laboratorioambulatorio' THEN 2 WHEN column_name = 'tesserasanitaria' THEN 3 WHEN column_name = 'codiceesame' THEN 4 WHEN column_name = 'oraesame' THEN 5 WHEN column_name = 'dataprenotazione' THEN 6 WHEN column_name = 'regimecosto' THEN 7 WHEN column_name = 'urgenza' THEN 8 WHEN column_name = 'dataesame' THEN 9 END;";
                                            $result = pg_query($conn, $query);
                                            $numCol = pg_num_rows($result);

                                            if (!$result) {
                                                die('Errore nella query: ' . pg_last_error($conn));
                                            }
                                        }

                                        while ($row = pg_fetch_row($result)) {
                                            echo "<th>" . $row[0] . "</th>";
                                        }
                                    ?>

                                    </tr>

                                    <?php
                                        if ($tabella == "personalemedico") {
                                            $query = "SELECT * FROM personalemedico UNION SELECT *, -1 FROM infermiere UNION SELECT *, -2 FROM personaleamministrativo ORDER BY CF";
                                        } else {
                                            $query = "SELECT * FROM " . $tabella;
                                        }
                                            
                                        $result = pg_query($conn, $query);

                                        if (!$result) {
                                            die('Errore nella query: ' . pg_last_error($conn));
                                        }

                                        while ($row = pg_fetch_row($result)) {
                                            echo "<tr>";

                                            echo "<td><input type='radio' name='toupdate' value='" . $row[0] . "' required></td>";

                                            foreach ($row as $colonna) {
                                                if ($colonna != -1 && $colonna != -2) {
                                                    echo "<td>" . $colonna . "</td>";
                                                }
                                            }
                                            echo "</tr>";
                                        }

                                        echo "<tr><td colspan='" . $numCol+1 . "' style='text-align: center;'><input type='submit' name='update' value='Update'></td></tr>";
                                    ?>

                                </form>
                            </table>
                            <?php
                            break;
                    } 
                } else {
                    echo "I dati non sono stati passati correttamente.";
                }
                ?>
            </div>
        </div>
    </body>
</html>
