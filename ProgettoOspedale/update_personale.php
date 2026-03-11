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
                $tipo = $_SESSION['tipo'];
                $cf = $_POST['cf'];
                $reparto = $_POST['reparto'];
                $nome = $_POST['nome'];
                $cognome = $_POST['cognome'];
                $dataNascita = $_POST['dataNascita'];
                $nomeVecchio = $nome;
                $cognomeVecchio = $cognome;
                $nascitaVecchia = $dataNascita;

                $unique_check_query = "SELECT Nome, Cognome, DataNascita FROM Infermiere WHERE CF = '$cf'
                                        UNION
                                        SELECT Nome, Cognome, DataNascita FROM PersonaleMedico WHERE CF = '$cf'
                                        UNION
                                        SELECT Nome, Cognome, DataNascita FROM PersonaleAmministrativo WHERE CF = '$cf'";
                $unique_check_result = pg_query($conn, $unique_check_query);
                    
                while($rows = pg_fetch_row($unique_check_result)) {
                    $nomeVecchio = $rows[0];
                    $cognomeVecchio = $rows[1];
                    $nascitaVecchia = $rows[2];
                }

                if ($nomeVecchio != $nome || $cognomeVecchio != $cognome || $nascitaVecchia != $dataNascita) {
                    // Controllo se esiste già lo stesso nome, cognome, dataNascita
                    $uniquee_check_query = "SELECT CF FROM Infermiere WHERE Nome = '$nome' AND Cognome = '$cognome' AND DataNascita = '$dataNascita'
                                            UNION
                                            SELECT CF FROM PersonaleMedico WHERE Nome = '$nome' AND Cognome = '$cognome' AND DataNascita = '$dataNascita'
                                            UNION
                                            SELECT CF FROM PersonaleAmministrativo WHERE Nome = '$nome' AND Cognome = '$cognome' AND DataNascita = '$dataNascita'";
                    $uniquee_check_result = pg_query($conn, $uniquee_check_query);
                    
                    if (pg_num_rows($uniquee_check_result) > 0) {
                        $error_message = "Errore: la tripla di valori Nome, Cognome, DataNascita esiste già. Riprova.";
                    }
                }

                if (empty($error_message)) {
                    switch ($tipo) {
                        case 'Infermiere':
                            $query = "UPDATE Infermiere SET Reparto='$reparto', Nome='$nome', Cognome='$cognome', DataNascita='$dataNascita'
                                WHERE CF='$cf'";
                            break;
                        case 'Personale Medico':
                            $anzianitaServizio = $_POST['anzianitaServizio'];
                            $cf_check_query = "SELECT * FROM primario WHERE CF = '$cf'";
                            $cf_check_result = pg_query($conn, $cf_check_query);
                            $rows = pg_fetch_row($cf_check_result);
    
                            if (pg_num_rows($cf_check_result) > 0 && $reparto != $rows[1]) {
                                $error_message = "Errore: Il medico scelto è un primario, quindi non puoi cambiargli reparto. Riprova.";
                            }
    
                            $cf_check_query = "SELECT * FROM viceprimario WHERE CF = '$cf'";
                            $cf_check_result = pg_query($conn, $cf_check_query);
                            $rows = pg_fetch_row($cf_check_result);
    
                            if (pg_num_rows($cf_check_result) > 0 && $reparto != $rows[1]) {
                                $error_message = "Errore: Il medico scelto è un viceprimario, quindi non puoi cambiargli reparto. Riprova.";
                            }
    
                            $query = "UPDATE personalemedico SET Reparto='$reparto', Nome='$nome', Cognome='$cognome', DataNascita='$dataNascita', AnzianitaServizio='$anzianitaServizio'
                                WHERE CF='$cf'";
                            break;
                        case 'Personale Amministrativo':
                            $query = "UPDATE personaleamministrativo SET Reparto='$reparto', Nome='$nome', Cognome='$cognome', DataNascita='$dataNascita'
                                WHERE CF='$cf'";
                            break;
                    }

                    if (pg_query($conn, $query) && empty($error_message)) {
                        echo "<div class='container'>";
                        echo "<div class='box'>";
                        echo "<p class='success'>Record aggiornato con successo</p>";
                        echo "<div class='footer'>Se vuoi puoi <a href='homepage.php'> tornare indietro</a> </div>";
                        echo "</div>";
                        echo "</div>";
                        exit();
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

        $query = "SELECT * FROM personalemedico WHERE CF='". $_SESSION['toupdate'] . "' UNION SELECT *, -1 FROM infermiere WHERE CF='". $_SESSION['toupdate'] . "' UNION SELECT *, -2 FROM personaleamministrativo 
        WHERE CF='". $_SESSION['toupdate'] . "'";
        $result = pg_query($conn, $query);

        if (!$result) {
            die('Errore nella query: ' . pg_last_error($conn));
        }

        $row = pg_fetch_row($result);

        echo "<table>";
            echo "<form action='' method='POST'>";
                echo "<tr>";
                    echo "<th>Codice Fiscale</th>";
                    echo "<td><input type='text' name='cf' value='" . $row[0] . "' required readonly></td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>Reparto</th>";
                    echo "<td>";
                    echo "<select name='reparto'>";

                    $query2 = "SELECT CodiceReparto FROM reparto ORDER BY CodiceReparto";
                    $result2 = pg_query($conn, $query2);

                    if (!$result2) {
                        die('Errore nella query: ' . pg_last_error($conn));
                    }

                    while ($row2 = pg_fetch_row($result2)) {
                        echo "<option value='" . $row2[0] . "'>" . $row2[0] . " </option>";
                    }
                    echo "</select>";
                    echo "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>Nome</th>";
                    echo "<td><input type='text' name='nome' value='" . $row[2] . "' placeholder='Inserisci il nome' required></td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>Cognome</th>";
                    echo "<td><input type='text' name='cognome' value='" . $row[3] . "' placeholder='Inserisci il cognome' required></td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>Data di nascita</th>";
                    echo "<td><input type='date' name='dataNascita' value='" . $row[4] . "' required></td>";
                echo "</tr>";

                $num = 5;

                if ($row[5] == -1) {
                    $_SESSION['tipo'] = "Infermiere";
                } else if ($row[5] == -2) {
                    $_SESSION['tipo'] = "Personale Amministrativo";
                } else {
                    $_SESSION['tipo'] = "Personale Medico";
                    echo "<tr>";
                        echo "<th>Anzianita di servizio</th>";
                        echo "<td><input type='number' name='anzianitaServizio' value='" . $row[5] . "' min = 0 placeholder='Inserisci anzianità' required></td>";
                    echo "</tr>";
                    $num = 6;
                }

                echo "<tr>";
                    echo "<td colspan='$num' style='text-align: center;'>";
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