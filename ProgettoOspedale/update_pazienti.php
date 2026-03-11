<!DOCTYPE html>
<html>
    <head>
        <title>Update pazienti</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php 
            include 'config.php';   

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $tesseraSanitaria = $_POST['tesseraSanitaria'];
                $nome = $_POST['nome'];
                $cognome = $_POST['cognome'];
                $dataNascita = $_POST['dataNascita'];
                $nomeVecchio = $nome;
                $cognomeVecchio = $cognome;
                $nascitaVecchia = $dataNascita;

                $unique_check_query = "SELECT Nome, Cognome, DataNascita FROM paziente WHERE TesseraSanitaria = '$tesseraSanitaria'";
                $unique_check_result = pg_query($conn, $unique_check_query);
                    
                while($rows = pg_fetch_row($unique_check_result)) {
                    $nomeVecchio = $rows[0];
                    $cognomeVecchio = $rows[1];
                    $nascitaVecchia = $rows[2];
                }

                if ($nomeVecchio != $nome || $cognomeVecchio != $cognome || $nascitaVecchia != $dataNascita) {
                    // Controllo se esiste già lo stesso nome, cognome, dataNascita
                    $uniquee_check_query = "SELECT TesseraSanitaria FROM paziente WHERE Nome = '$nome' AND Cognome = '$cognome' AND DataNascita = '$dataNascita'";
                    $uniquee_check_result = pg_query($conn, $uniquee_check_query);
                    
                    if (pg_num_rows($uniquee_check_result) > 0) {
                        $error_message = "Errore: la tripla di valori Nome, Cognome, DataNascita esiste già. Riprova.";
                    }
                }

                if (empty($error_message)) {
                    $query = "UPDATE paziente 
                                SET Nome='$nome', Cognome='$cognome', DataNascita='$dataNascita' 
                                WHERE TesseraSanitaria='$tesseraSanitaria'";
                
                    // Controllo descrizione
                    if (pg_query($conn, $query)) {
                        echo "<div class='container'>";
                        echo "<div class='box'>";
                        echo "<p class='success'>Record aggiornato con successo</p>";
                        echo "<div class='footer'><a href='homepage.php'>indietro</a> </div>";
                        echo "</div>";
                        echo "</div>";
                            exit();
                    } else {
                        echo "Errore: " . $query . "<br>" . pg_last_error($conn);
                    }
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
        
        $query = "SELECT * FROM paziente WHERE TesseraSanitaria='". $_SESSION['toupdate'] . "'";
        $result = pg_query($conn, $query);

        if (!$result) {
            die('Errore nella query: ' . pg_last_error($conn));
        }

        $row = pg_fetch_row($result);

        echo "<table>";
            echo "<form action='' method='POST'>";
                echo "<tr>";
                    echo "<th>Tessera Sanitaria</th>";
                    echo "<td><input type='text' name='tesseraSanitaria' value='" . $row[0] . "' required readonly></td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>Nome</th>";
                    echo "<td><input type='text' name='nome' value='" . $row[1] . "' placeholder='Inserisci il nome' required></td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>Cognome</th>";
                    echo "<td><input type='text' name='cognome' value='" . $row[2] . "' placeholder='Inserisci il cognome' required></td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>Data di nascita</th>";
                    echo "<td><input type='date' name='dataNascita' value='" . $row[3] . "' required></td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td colspan='4' style='text-align: center;'>";
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
