<html>
  <head>
    <title>Homepage</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="container">
      <div class="box">
        <?php include 'config.php'; ?>

        <h1>Gestione Database Servizio Ospedaliero</h1>

        Scegli l'operazione da effettuare<br><br>

        <form action='opt_basic.php' method='POST'>

        <select name='tabella'>
          <optgroup label='INSERIMENTO'>
          <option value='Iospedale'>Di una struttura</option>
          <option value='Ipersonale'>Del personale</option>
          <option value='Ipaziente'>Dei pazienti</option>
          <option value='Iesame'>Degli esami</option>
          <option value='Iprenotazione'>Delle prenotazioni</option>
          <optgroup label='MODIFICA'>
          <option value='Mospedale'>Di una struttura</option>
          <option value='Mpersonalemedico'>Del personale</option>
          <option value='Mpaziente'>Dei pazienti</option>
          <option value='Mesame'>Degli esami</option>
          <option value='Mprenotazione'>Delle prenotazioni</option>
          <optgroup label='VISUALIZZAZIONE'>
          <option value='Vpersonale'>Del personale in organico nei reparti della struttura</option>
          <option value='Vpazientericoverato'>Dello storico dei ricoveri di un paziente in una struttura</option>
        </select>

        <input type='submit'>
        </form>
      </div>
    </div>
  </body>
</html>