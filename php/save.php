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
    var_dump($player, $points);

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
