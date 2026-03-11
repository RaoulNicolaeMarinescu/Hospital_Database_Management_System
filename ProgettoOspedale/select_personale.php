<!DOCTYPE html>
<html>
    <head>
        <title>Visualizzazione ospedale</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    <?php include 'config.php'; ?>

        <div class='container'>
        <div class='box'>

        <?php
        
        if (isset($_POST['ospedale'])) {
        $codiceospedale = $_POST['ospedale'];
        }

        $queryReparto = "SELECT CodiceReparto FROM reparto WHERE Ospedale = '$codiceospedale'";
        $resultReparto = pg_query($conn, $queryReparto);

        if (!$resultReparto) {
            die ("Errore nell'esecuzione della query reparto");
        }

        $numReparti = pg_num_rows($resultReparto);

        if ($numReparti == 0) {     // Se l'ospedale scelto non ha dipendenti verrà visualizzato un messaggio rosso
            echo "<p class='error'>Questo ospedale non ha dipendenti</p>";
        } else {
            while ($rowReparto = pg_fetch_row($resultReparto)) {
                echo "<h1>Personale reparto: " . $rowReparto[0] . "</h1>";
    
                echo "<table>";
                    echo "<tr>";    
                        // Qua creo lo schema della tabella
                        $querySchema = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='personalemedico' ORDER BY CASE WHEN column_name = 'cf' THEN 1 WHEN column_name = 'reparto' THEN 2 WHEN column_name = 'nome' THEN 3 WHEN column_name = 'cognome' THEN 4 WHEN column_name = 'datanascita' THEN 5 END;";
                        $resultSchema = pg_query($conn, $querySchema);
    
                        if (!$resultSchema) {
                            die ("Errore nell'esecuzione della query schema");
                        }
    
                        while ($rowSchema = pg_fetch_row($resultSchema)) {
                            echo "<th>". $rowSchema[0] . "</th>";
                        }
    
                        echo "<th>Tipo</th>";
    
                    echo "</tr>";
    
                    $queryPersonale = "SELECT *, -1, 'Infermiere' AS Tipo FROM Infermiere WHERE Reparto = '" . $rowReparto[0] . "'
                                       UNION
                                       SELECT *, 'Personale Medico' AS Tipo FROM PersonaleMedico WHERE Reparto = '" . $rowReparto[0] . "'
                                       UNION
                                       SELECT *, -2, 'Personale Amministrativo' AS Tipo FROM PersonaleAmministrativo WHERE Reparto = '" . $rowReparto[0] . "'";
                    
                    $resultPersonale = pg_query($conn, $queryPersonale);
    
                    if (!$resultPersonale) {
                        die ("Errore nell'esecuzione della query personale");
                    }
    
                    while ($rowPersonale = pg_fetch_assoc($resultPersonale)) {
                        echo "<tr>";    // Qua aggiungo i dati del personale
    
                        foreach ($rowPersonale as $colPersonale) {
                            if ($colPersonale != -1 && $colPersonale != -2) {
                                echo "<td>" .$colPersonale . "</td>";
                            } else {
                                echo "<td></td>";
                            }
                        }
    
                        echo "</tr>";
                    }
    
    
                echo "</table>";
    
                $numReparti--;
    
                if ($numReparti != 0) {
                    echo "<br><br><br><br><br>";
                }
            }
        }
        ?>

        <div class='footer'><a href='homepage.php'>indietro</a></div>
        </div>
        </div>
    </body>
</html>