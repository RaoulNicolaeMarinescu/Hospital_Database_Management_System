<!DOCTYPE html>
<html>
    <head>
        <title>Inserimento pazienti</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php 
            include 'config.php'; 

            $error_message = "";

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $tesserasanitaria = $_POST['tesseraSanitaria'];
                $nome = $_POST['nome'];
                $cognome = $_POST['cognome'];
                $dataNascita = $_POST['dataNascita'];

                // Controllo lunghezza tessera sanitaria
                if (strlen($tesserasanitaria) != 20) {
                    $error_message = "Errore: La tessera sanitaria deve essere lunga esattamente 20 caratteri.";
                } else {
                    // Controllo se tessera sanitaria esiste già
                    $ts_check_query = "SELECT TesseraSanitaria FROM paziente WHERE TesseraSanitaria = '$tesserasanitaria'";
                    $ts_check_result = pg_query($conn, $ts_check_query);

                    // Controllo se esiste già lo stesso nome, cognome, dataNascita
                    $unique_check_query = "SELECT TesseraSanitaria FROM paziente WHERE Nome = '$nome' AND Cognome = '$cognome' AND DataNascita = '$dataNascita'";
                    $unique_check_result = pg_query($conn, $unique_check_query);

                    if (pg_num_rows($ts_check_result) > 0) {
                        $error_message = "Errore: La tessera sanitaria esiste già. Riprova.";
                    } else if (pg_num_rows($unique_check_result) > 0) {
                        $error_message = "Errore: la tripla di valori Nome, Cognome, DataNascita esiste già. Riprova.";
                    } else {
                        // Inserimento dei dati
                        $query = "INSERT INTO paziente (TesseraSanitaria, Nome, Cognome, DataNascita) VALUES ('$tesserasanitaria', '$nome', '$cognome', '$dataNascita')";

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
                    <th>Tessera Sanitaria</th>
                    <td><input type='text' name='tesseraSanitaria' placeholder='Inserisci tessera sanitaria' required></td>
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
                    <td colspan='2' style='text-align: center;'>
                        <input type='submit' name='inserisci' value='Inserisci'>
                    </td>
                </tr>
            </form>
        </table>

        <div class="footer">
            <a href="homepage.php">indietro</a>
        </div>
        </div>
        </div>
    </body>
</html>