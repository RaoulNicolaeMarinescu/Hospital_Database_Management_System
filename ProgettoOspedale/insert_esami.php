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
                $codiceEsame = $_POST['codiceEsame'];
                $codiceMedico = $_POST['codiceMedico'];
                $descrizione = $_POST['descrizione'];
                $costoAssistenzaSanitaria = $_POST['costoAssistenzaSanitaria'];
                $costoPrivato = $_POST['costoPrivato'];
                $avvertenze = $_POST['avvertenze'];


                // Controllo lunghezza codice esame
                if (strlen($codiceEsame) != 6) {
                    $error_message = $error_message . "Errore: Il codice esame deve essere lungo esattamente 6 caratteri.";
                } else {
                    // Controllo se il codice esame esiste già
                    $ce_check_query = "SELECT CodiceEsame FROM esame WHERE CodiceEsame = '$codiceEsame'";
                    $ce_check_result = pg_query($conn, $ce_check_query);

                    if (pg_num_rows($ce_check_result) > 0) {
                        $error_message = $error_message . "\nErrore: Il codice esame esiste già. Riprova.";
                    } else {

                        if ($codiceMedico == '---') {   // Se non è un esame specialistico
                            $query = "INSERT INTO esame (CodiceEsame, Descrizione, CostoAssistenzaSanitaria, CostoPrivato)
                                    VALUES ('$codiceEsame', '$descrizione', '$costoAssistenzaSanitaria', '$costoPrivato')";
                        } else {
                            $query = "INSERT INTO esame (CodiceEsame, CodiceMedico, Descrizione, CostoAssistenzaSanitaria, CostoPrivato, Avvertenze)
                                    VALUES ('$codiceEsame', '$codiceMedico', '$descrizione', '$costoAssistenzaSanitaria', '$costoPrivato', '$avvertenze')";
                        }

                        // Controllo descrizione
                        if (strlen($descrizione) > 50 && strlen($descrizione) < 1) {
                            $error_message = $error_message . "\nErrore: La descrizione deve essere lunga minimo 1 carattere e massimo 50 caratteri.";
                        } else if ($codiceMedico != '---' && $avvertenze == '') { // Se è un esame specialistico ci deve essere una descrizione
                            $error_message = $error_message . "\nErrore: Dato che hai scelto un medico che prescrive il tuo esame, ci devono essere delle avvertenze.";
                        } else {
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
                    <th>Codice Esame</th>
                    <td><textarea name='codiceEsame' placeholder='Inserisci codice esame' required></textarea></td>
                </tr>
            
            
                <tr>
                    <th>Codice Medico</th>
                    <td>
                        <?php
                            echo "<select name='codiceMedico'>";
                            echo "<optgroup label='Esame Normale'>";
                            echo "<option value='---'>---</option>";
                            echo "<optgroup label='Esame Specialistico quindi chi lo ha prescritto'>";
                            $query = "SELECT CF, Nome, Cognome FROM personalemedico";
                            $result = pg_query($conn, $query);
                            while ($row = pg_fetch_row($result)) {
                                echo "<option value='" . $row[0] . "'>(" . $row[0] . ") - " . $row[1] . " " . $row[2] . "</option>";
                            }
                            echo "</select>";
                        ?>
                    </td>
                </tr>

                <tr>
                    <th>Descrizione</th>
                    <td><textarea name='descrizione' placeholder='Inserisci descrizione esame' rows='4' cols='50' required></textarea></td>
                </tr>

                <tr>
                    <th>Costo Assistenza Sanitaria</th>
                    <td><input type='number' name='costoAssistenzaSanitaria' placeholder='Inserisci il costo assistenza sanitaria' min="0" required></td>
                </tr>

                <tr>
                    <th>Costo Privato</th>
                    <td><input type='number' name='costoPrivato' placeholder='Inserisci il costo assistenza privato' min="0" required></td>
                </tr>

                <tr>
                    <th>Avvertenze</th>
                    <td><textarea name='avvertenze' placeholder='Inserisci avvertenze solo se è un esame specialistico' rows='4' cols='50'></textarea></td>
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