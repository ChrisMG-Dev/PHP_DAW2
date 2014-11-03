<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>title</title>
    </head>
    <body>
        <?php include("includes/source.php"); ?>
        <form action="form_suma_ejemplo.php" method="post">
            <fieldset style="display: inline-block;">
                <p>
                <label>Número 1</label>
                <input type="text" pattern="\d+\.*\d*" name="num1" 
                       title="Carácteres permitidos [0-9][.]" required/>
                </p>
                <p>
                <label>Número 2</label>
                <input type="text" pattern="\d+\.*\d*" name="num2" 
                       title="Carácteres permitidos [0-9][.]" required/>
                </p>
            </fieldset>
            <br /><br /><input type="submit" name="enviar" value="Enviar" />
            
        </form>
        <?php 
            function sumar ($num1, $num2) {
                if (intval ($num1) && intval ($num2)) {
                    return $num1 + $num2;
                }
                return null;
            }
            
            echo ("<br />");
            
            if (isset ($_POST['enviar'])) {
                $resultado = sumar($_POST['num1'], $_POST['num2']);
                if (is_null ($resultado)) {
                    echo ("Error, por favor introduzca solamente "
                            . "carácteres permitidos [0-9][.]");
                }
                else {
                    echo ("Resultado: " . $resultado);
                }
                
            }
        ?>
    </body>
</html>

