<!DOCTYPE html>
<html>
    <head>
        <title>Inserimento personale</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        
        <?php 
            include 'config.php'; 

            $error_message = "";

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $tipo = $_POST['tipo'];
                $cf = $_POST['cf'];
                $reparto = $_POST['reparto'];
                $nome = $_POST['nome'];
                $cognome = $_POST['cognome'];
                $dataNascita = $_POST['dataNascita'];
                $anzianita = $_POST['anzianita'];

                // Controllo lunghezza codice fiscale
                if (strlen($cf) != 16) {
                    $error_message = "Errore: Il codice fiscale deve essere lungo esattamente 16 caratteri.";
                } else if ($tipo == "Personale Medico" && empty($anzianita)) {
                    $error_message = "Errore: Dato che hai scelto un medico DEVI inserire anche gli anni di anzianità.";
                } else {
                    // Controllo se il codice fiscale esiste già
                    $cf_check_query = "SELECT CF FROM Infermiere WHERE CF = '$cf'
                                    UNION
                                    SELECT CF FROM PersonaleMedico WHERE CF = '$cf'
                                    UNION
                                    SELECT CF FROM PersonaleAmministrativo WHERE CF = '$cf'";
                    $cf_check_result = pg_query($conn, $cf_check_query);

                    // Controllo se esiste già lo stesso nome, cognome, dataNascita
                    $unique_check_query = "SELECT CF FROM Infermiere WHERE Nome = '$nome' AND Cognome = '$cognome' AND DataNascita = '$dataNascita'
                                    UNION
                                    SELECT CF FROM PersonaleMedico WHERE Nome = '$nome' AND Cognome = '$cognome' AND DataNascita = '$dataNascita'
                                    UNION
                                    SELECT CF FROM PersonaleAmministrativo WHERE Nome = '$nome' AND Cognome = '$cognome' AND DataNascita = '$dataNascita'";
                    $unique_check_result = pg_query($conn, $unique_check_query);

                    if (pg_num_rows($cf_check_result) > 0) {
                        $error_message = "Errore: Il codice fiscale esiste già. Riprova.";
                    } else if (pg_num_rows($unique_check_result) > 0) {
                        $error_message = "Errore: la tripla di valori Nome, Cognome, DataNascita esiste già. Riprova.";
                    } else {
                        // Inserimento dei dati
                        switch ($tipo) {
                            case 'Infermiere':
                                $query = "INSERT INTO Infermiere (CF, Reparto, Nome, Cognome, DataNascita) VALUES ('$cf', '$reparto', '$nome', '$cognome', '$dataNascita')";
                                break;
                            case 'Personale Medico':
                                $query = "INSERT INTO PersonaleMedico (CF, Reparto, Nome, Cognome, DataNascita, AnzianitaServizio) VALUES ('$cf', '$reparto', '$nome', '$cognome', '$dataNascita', '$anzianita')";
                                break;
                            case 'Personale Amministrativo':
                                $query = "INSERT INTO PersonaleAmministrativo (CF, Reparto, Nome, Cognome, DataNascita) VALUES ('$cf', '$reparto', '$nome', '$cognome', '$dataNascita')";
                                break;
                        }

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
                    <th>Tipo</th>
                    <td>
                        <select name='tipo'>
                            <option value='Infermiere'>Infermiere</option>
                            <option value='Personale Medico'>Personale Medico</option>
                            <option value='Personale Amministrativo'>Personale Amministrativo</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <th>CF</th>
                    <td><input type='text' name='cf' placeholder='Inserisci codice fiscale' required></td>
                </tr>

                <tr>
                    <th>Reparto</th>
                    <td>
                        <?php    
                            echo "<select name='reparto'>";
                        
                            $query = "SELECT CodiceReparto FROM reparto";
                            $result = pg_query($conn, $query);
                            while ($row = pg_fetch_row($result)) {
                                echo "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
                            }
                            echo "</select>";
                        ?>
                    </td>
                </tr>

                <tr>
                    <th>Nome</th>
                    <td><input type='text' name='nome' placeholder='Inserisci nome' required></td>
                </tr>

                <tr>
                    <th>Cognome</th>
                    <td><input type='text' name='cognome' placeholder='Inserisci cognome' required></td>
                </tr>

                <tr>
                    <th>Data di nascita</th>
                    <td><input type='date' name='dataNascita' required></td>
                </tr>

                <tr>
                    <th>Anzianità di servizio</th>
                    <td><input type='number' name='anzianita' placeholder='Anni di servizio, per medici' min='0' step='1'></td>
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
