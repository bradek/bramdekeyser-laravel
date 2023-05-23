<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>phpmyadmin-laravel-connectie</title>
</head>
<body>

     <!--Deze pagina was eigenlijk een test-pagina die naging of de connectie met de database correct verliep.
    Dit is al uitgebreid bevestigt geweest bij o.a. de administratie, registratie en inlog-systemen.
    Deze pagina wordt dus in de realiteit niet echt meer gebruikt, maar behoud ik toch om nog wat op te scheppen
    met hoeveel ik gedaan heb.-->
    <div>
        <?php
        /*In de onderstaande if statement ga ik na of de connectie met de database succesvol is gelukt.
        We checken de Pdo (PHP) data object.
        Als de connectie met de database correct is uitgevoerd, meld ik dat deze geslaagd is.
        Met .DB::connection()->getDatabaseName(); roep ik de naam van de database op.
        Deze blijkt ook correct te zijn in mijn browser, dus is de connectie alvast geslaagd.*/
        if (DB::connection()->getPdo()){
            echo "Database connectie verliep succesvol. <br><b>Databasenaam: </b>".DB::connection()->getDatabaseName();
        }
        /*Wanneer de connectie is gefaald, is de vorige if-statement niet van toepassingen en wordt dit gemeld.
        Mijn connectie zal natuurlijk niet falen, want dat zou best dom zijn.
        Echter vind ik dat een if-statement niet compleet is zonder een else.*/
        else{
            echo "Database connectie is gefaald.";
        }
        ?>
    </div>
</body>
</html>