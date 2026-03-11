<!DOCTYPE html>
<html>
    <head>
        <title>Update ospedale</title>
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
            
                $query = "UPDATE ospedale SET Nome='$nome', Indirizzo='$indirizzo' WHERE CodiceOspedale='$codice'";
            
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
        ?>
    
        <div class='container'>
        <div class='box'>

        <?php 
        if (!empty($error_message)) {
            echo "<p class='error'>$error_message</p>";
        }

        $query = "SELECT * FROM ospedale WHERE CodiceOspedale='". $_SESSION['toupdate'] . "'";
        $result = pg_query($conn, $query);

        if (!$result) {
            die('Errore nella query: ' . pg_last_error($conn));
        }

        $row = pg_fetch_row($result);

        echo "<table>";
            echo "<form action='' method='POST'>";
                echo "<tr>";
                    echo "<th>Codice</th>";
                    echo "<td><input type='text' name='codice' value='" . $row[0] . "' placeholder='Inserisci codice ospedale' required readonly></td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>Nome</th>";
                    echo "<td><input type='text' name='nome' value='" . $row[1] . "' placeholder='Inserisci nome ospedale' required></td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>Indirizzo</th>";
                    echo "<td><input type='text' name='indirizzo' value='" . $row[2] . "' placeholder='Inserisci indirizzo ospedale' required></td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td colspan='2' style='text-align: center;'>";
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
