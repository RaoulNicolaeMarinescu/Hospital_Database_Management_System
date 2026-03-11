<!DOCTYPE html>
<html>
    <head>
        <title>Update esami</title>
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


                if ($codiceMedico != "---") {
                    if (empty($avvertenze)) {
                        $error_message = $error_message . "\nErrore: Un esame specialistico DEVE avere le avvertenze.";
                    }

                    $query = "UPDATE esame 
                                SET CodiceMedico='$codiceMedico', Descrizione='$descrizione', CostoAssistenzaSanitaria='$costoAssistenzaSanitaria', CostoPrivato='$costoPrivato', Avvertenze='$avvertenze' 
                                WHERE CodiceEsame='$codiceEsame'";
                }

                if ($codiceMedico == "---") {
                    $query = "UPDATE esame 
                                SET Descrizione='$descrizione', CostoAssistenzaSanitaria='$costoAssistenzaSanitaria', CostoPrivato='$costoPrivato' 
                                WHERE CodiceEsame='$codiceEsame'";
                    $codiceMedico="";
                    $avvertenze="";
                }
                
                // Controllo descrizione
                if (strlen($descrizione) > 50 && strlen($descrizione) < 1) {
                    $error_message = $error_message . "\nErrore: La descrizione deve essere lunga minimo 1 carattere e massimo 50 caratteri.";
                } else if (empty($descrizione)) {
                    $error_message = $error_message . "\nErrore: La descrizione deve esistere.";
                } else if (empty($error_message)) {
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
        ?>

        <div class='container'>
        <div class='box'>

        <?php 
        if (!empty($error_message)) {
            echo "<p class='error'>$error_message</p>";
        }

        $query = "SELECT * FROM esame WHERE CodiceEsame='". $_SESSION['toupdate'] . "'";
        $result = pg_query($conn, $query);

        if (!$result) {
            die('Errore nella query: ' . pg_last_error($conn));
        }

        $row = pg_fetch_row($result);

        echo "<table>";
            echo "<form action='' method='POST'>";
                echo "<tr>";
                    echo "<th>Codice Esame</th>";
                    echo "<td><input type='text' name='codiceEsame' value='" . $row[0] . "' placeholder='Inserisci codice ospedale' required readonly></td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>Codice Medico</th>";
                    echo "<td>";
                    echo "<select name='codiceMedico'>";
                    echo "<optgroup label='Esame Normale'>";
                    echo "<option value='---'>---</option>";
                    echo "<optgroup label='Esame Specialistico quindi chi lo ha prescritto'>";
                    $query2 = "SELECT CF, Nome, Cognome FROM personalemedico";
                    $result2 = pg_query($conn, $query2);
                    while ($row2 = pg_fetch_row($result2)) {
                        echo "<option value='" . $row2[0] . "'>(" . $row2[0] . ") - " . $row2[1] . " " . $row2[2] . "</option>";
                    }
                    echo "</select>";
                    echo "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>Descrizione</th>";
                    echo "<td><input type='text' name='descrizione' value='" . $row[2] . "' placeholder='Inserisci costo privato' required></td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>Costo Assistenza Sanitaria</th>";
                    echo "<td><input type='text' name='costoAssistenzaSanitaria' value='" . $row[3] . "' placeholder='Inserisci costo assistenza sanitaria' required></td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>Costo Privato</th>";
                    echo "<td><input type='text' name='costoPrivato' value='" . $row[4] . "' placeholder='Inserisci costo privato' required></td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>Avvertenze</th>";
                    echo "<td><input type='text' name='avvertenze' value='" . $row[5] . "' placeholder='Inserisci costo privato'></td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td colspan='6' style='text-align: center;'>";
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