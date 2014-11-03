<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Suma</title>
        <style>
            fieldset p label {
                width: 220px;
                display: inline-block;
                float: left;
            }
            
            fieldset p input {
                display: inline-block;
                margin-left: 20px;
            }
            
            #numeros {
                width: 600px;
                text-align: justify;
            }
        </style>
    </head>
    <body>
        <?php include("includes/source.php"); ?>
        <form action="?page=formulario_suma" method="post">
            <fieldset
                <p>
                    <label>Números aleatorios a sumar</label>
                    <input type="text" name="numSuma" pattern="[0-9]+" 
                       title="Introduzca el número de números a sumar" required
                       size="5"/>
                </p>
                <p>
                    <label>Número mínimo</label>
                    <input type="text" name="minimo" pattern="[0-9]+" required 
                        size="5"   />
                </p>
                <p>
                    <label>Número máximo</label>
                    <input type="text" name="maximo" pattern="[0-9]+" required 
                        size="5"   />
                </p>
            </fieldset>
            <input type="submit" name="enviar" />
        </form>
        <?php
        
            define ("MAX_NUMBERS", 1000);
            
            if (isset ($_POST['enviar'])) {
                if (intval($_POST['numSuma']) > MAX_NUMBERS) {
                    echo ("Ha introducido un valor demasiado alto, introduzca "
                            . "menos de ". MAX_NUMBERS);
                    exit (0);
                }
                if (($_POST['minimo'] < $_POST['maximo'])
                        || !$_POST['minimo'] == $_POST['maximo']) {
                    $numSuma = $_POST['numSuma'];
                
                    $numeros = array();

                    for ($i = 0; $i < $numSuma; $i += 1) {
                        $numeros[] = rand($_POST['minimo'], $_POST['maximo']);
                    }

                    echo ("Total:" . array_sum($numeros));
                    echo ("<br /><br />Números utilizados: <br />");
                    echo ("<div id='numeros'>");
                    
                    foreach ($numeros as $indice => $num) {
                        
                        if ($indice == 0) {
                            echo ($num);
                        }
                        
                        else {
                            echo (" " . $num);
                        }
                        
                    }
                    echo ("</div>");
                }
                
                else {
                    echo ("El mínimo no puede ser superior ni igual al máximo");
                }
            }
        ?>
    </body>
</html>


