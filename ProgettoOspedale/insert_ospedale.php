<!DOCTYPE html>
<html>
    <head>
        <title>Inserimento ospedale</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>

        <?php 
        include 'config.php'; 

        $error_message = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $codice = $_POST['codice'];
            $nome = $_POST['nome'];
            $indirizzo = $_POST['indirizzo'];

            // Controllo lunghezza codice ospedale
            if (strlen($codice) != 6) {
                $error_message = $error_message . "Errore: Il codice ospedale deve essere lungo esattamente 6 caratteri.";
            } else {
                // Controllo se il codice ospedale esiste già
                $co_check_query = "SELECT CodiceOspedale FROM ospedale WHERE CodiceOspedale = '$codice'";
                $co_check_result = pg_query($conn, $co_check_query);

                if (pg_num_rows($co_check_result) > 0) {
                    $error_message = $error_message . "\nErrore: Il codice ospedale esiste già. Riprova.";
                } else {
                    $query = "INSERT INTO Ospedale (CodiceOspedale, Nome, Indirizzo) VALUES ('$codice', '$nome', '$indirizzo')";

                    if (pg_query($conn, $query)) {
                        echo "<div class='container'>";
                        echo "<div class='box'>";
                        echo "<p class='success'>Nuovo record inserito con successo</p>";
                        echo "<div class='footer'><a href='homepage.php'>indietro</a></div>";
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
                    <th>Codice</th>
                    <td><input type='text' name='codice' placeholder='Inserisci codice ospedale' required></td>
                </tr>

                <tr>
                    <th>Nome</th>
                    <td><input type='text' name='nome' placeholder='Inserisci nome ospedale' required></td>
                </tr>

                <tr>
                    <th>Indirizzo</th>
                    <td><input type='text' name='indirizzo' placeholder='Inserisci indirizzo ospedale' required></td>
                </tr>

                <tr>
                    <td colspan="2" style='text-align: center;'>
                        <input type="submit" name="inserisci" value="Inserisci">
                    </td>
                </tr>
            </form>
        </table>

        <div class='footer'><a href='homepage.php'>indietro</a></div>
        </div>
        </div>
    </body>
</html>
