<!DOCTYPE html>
<html>
    <head>
        <title>Visualizzazione paziente</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php 
            include 'config.php'; 

            if (isset($_POST['paziente']) && isset($_POST['codice'])) {
                $paziente = $_POST['paziente'];
                $codice = $_POST['codice'];
            }
            ?>

            <div class='container'>
            <div class='box'>

            <?php
            $queryRicoveri = "  SELECT 
                                    pr.CodiceRicovero, 
                                    p.Nome, 
                                    p.Cognome, 
                                    p.DataNascita, 
                                    pr.DataRicovero, 
                                    pr.Patologie, 
                                    pd.DataDimissione,
                                    r.Nome AS Reparto,
                                    o.Nome AS Ospedale
                                FROM 
                                    PazienteRicoverato pr
                                JOIN 
                                    Paziente p ON pr.TesseraSanitaria = p.TesseraSanitaria
                                LEFT JOIN 
                                    PazienteDimesso pd ON pr.CodiceRicovero = pd.CodiceRicovero
                                JOIN 
                                    Stanza s ON pr.Stanza = s.CodiceStanza
                                JOIN 
                                    Reparto r ON s.Reparto = r.CodiceReparto
                                JOIN 
                                    Ospedale o ON r.Ospedale = o.CodiceOspedale
                                WHERE 
                                    p.TesseraSanitaria = '$paziente'
                                    AND o.CodiceOspedale = '$codice'
                                ORDER BY 
                                    pr.DataRicovero DESC";

            $resultRicoveri = pg_query($conn, $queryRicoveri);

            if (!$resultRicoveri) {
                die ("Errore nell'esecuzione della query ricoveri");
            }

            $numRicoveri = pg_num_rows($resultRicoveri);

            if ($numRicoveri == 0) {
            // Nessun ricovero trovato
            echo "<p class='error'>Il paziente con tessera sanitaria " . $paziente . " non ha ricoveri presso l'ospedale con codice " . $codice . ".</p>";
            } else {
            // Visualizza i risultati in una tabella
            echo "<table>";
                echo "<tr>";
                    echo "<th>Codice Ricovero</th>";
                    echo "<th>Nome</th>";
                    echo "<th>Cognome</th>";
                    echo "<th>Data Nascita</th>";
                    echo "<th>Data Ricovero</th>";
                    echo "<th>Patologie</th>";
                    echo "<th>Data Dimissione</th>";
                    echo "<th>Reparto</th>";
                    echo "<th>Ospedale</th>";
                echo "</tr>";

                // Cicla sui risultati e popola la tabella
                while ($rowRicoveri = pg_fetch_assoc($resultRicoveri)) {
                    echo "<tr>";
                        echo "<td>" . $rowRicoveri['codicericovero'] . "</td>";
                        echo "<td>" . $rowRicoveri['nome'] . "</td>";
                        echo "<td>" . $rowRicoveri['cognome'] . "</td>";
                        echo "<td>" . $rowRicoveri['datanascita'] . "</td>";
                        echo "<td>" . $rowRicoveri['dataricovero'] . "</td>";
                        echo "<td>" . $rowRicoveri['patologie'] . "</td>";
                        echo "<td>" . $rowRicoveri['datadimissione'] . "</td>";
                        echo "<td>" . $rowRicoveri['reparto'] . "</td>";
                        echo "<td>" . $rowRicoveri['ospedale'] . "</td>";
                    echo "</tr>";
                }
            echo "</table>";
        }
        ?>

        <div class='footer'><a href='homepage.php'>indietro</a></div>
        </div>
        </div>
    </body>
</html>
