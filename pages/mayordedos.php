<html>
    <head>
        <meta charset="UTF-8">
        <title>Mayor de dos números</title>
    </head>
    <body>
        <?php 
            $numero1 = 12;
            $numero2 = 99;
            
            if ($numero1 > $numero2) {
                echo("$numero1 es mayor que $numero2");
            }
            
            else if ($numero1 < $numero2) {
                echo("$numero2 es mayor que $numero1");
            }
            
            else {
                echo("Ambos números son iguales");
            }
        ?>
        <br /><br />
        <?php include("includes/independent_source.php"); ?>
    </body>
</html>

