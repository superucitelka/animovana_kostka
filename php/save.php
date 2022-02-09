<?php
    /* Kód v jazyce PHP má na straně serveru zajistit uložení aktuálně dosaženého
    výsledku do souboru vysledky.csv a poté zobrazit jeho obsah jako výsledkovou
    listinu v podobě těla tabulky */
    /* Jestliže došlo k odeslání formuláře metodou GET pomocí tlačítka 
    s name="submit" */
    if (isset($_GET["submit"])) {
        /* Když předaný parametr player není prázdný, ulož získanou hodnotu 
        do proměnné $player, jinak do ní ulož slovo "anonym" */
        $player = !empty($_GET["player"]) ? $_GET["player"] : "anonym";
        /* Do proměnné points ulož body předané z formuláře */
        $points = $_GET["points"];
    }    
    /* Jestliže došlo k odeslání formuláře metodou POST pomocí tlačítka 
    s name="submit" */
    if (isset($_POST["submit"])) {
        $player = !empty($_POST["player"]) ? $_POST["player"] : "anonym";
        $points = $_POST["points"];
    } 
    /* Výpis obsahu proměnných - pomocná funkce pro vývojáře */
    // var_dump($player, $points);

    /* Jestliže proměnné $player a $points obsahují nějaké hodnoty,
    dojde k jejich zápisu do souboru vysledky.csv */    
    if (!empty($player) && !empty($points)) {
        /* Otevření souboru umožňující připsání dat - modifikátor "a" */
        $file = fopen("vysledky.csv", "a") or die("Unable to open file!");
        /* Zjištění aktuálního data a času v určeném formátu */
        $datetime = date("Y-m-d H:i:s");
        /* Zápis nového řádku do datového souboru */
        fwrite($file, $datetime.";".$player.";".$points."\n");
        /* Uzavření souboru */
        fclose($file);
    }
?>

<!DOCTYPE html>
<html lang="cs">

<head>
    <title>Hra kostky - výsledky</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
</head>

<body>
    <header class="jumbotron bg-success">
        <h1 class="display-3 text-light text-center">Kostky - výsledková listina</h1>
    </header>
    <main class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Datum a čas</th>
                    <th>Jméno hráče</th>
                    <th>Počet bodů</th>
                </tr>
            </thead>
            <tbody>
<?php
        /* Otevření souboru vysledky.csv pro čtení */
        $file = fopen("vysledky.csv", "r") or die("Unable to open file!");
        /* Načtení obsahu souboru do proměnné $content */
        $content = fread($file, filesize("vysledky.csv"));
        /* Rozdělení textového souboru na jednotlivé řádky */
        $rows = explode("\n", $content);
        //var_dump($rows);
        fclose($file);
        /* Rozparsování pole řádků a výpis do struktury tabulky */  
        foreach ($rows as $row) {
            if ($row) {
                $player = explode(";", $row);
                echo "<tr><td>".$player[0]."</td><td>".$player[1]."</td><td>".$player[2]."</td></tr>";
            }
        }
?>
            </tbody>
        </table>
    </main>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>
