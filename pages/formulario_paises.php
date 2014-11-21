<?php
/**
 * Este formulario muestra la capital y bandera de los países definidos
 * 
 * @author Muñoz Godenir Christopher - chrismgdaw@gmail.com
 * @version 1.1
 * @license @license http://opensource.org/licenses/GPL-3.0 GNU GPL 3.0
 */
    $paises = array (
        array 
        (
            "País" => "Canadá",
            "Capital" => "Ottawa",
            "Bandera" => "pages/img/banderas/canada.png"
        ),
        array 
        (
            "País" => "Japón",
            "Capital" => "Tokyo",
            "Bandera" => "pages/img/banderas/japon.png"
        ),
        array 
        (
            "País" => "Francia",
            "Capital" => "París",
            "Bandera" => "pages/img/banderas/francia.png"
        ),
        array 
        (
            "País" => "Reino Unido",
            "Capital" => "Londres",
            "Bandera" => "pages/img/banderas/reinounido.png"
        ),
        array 
        (
            "País" => "Estados Unidos",
            "Capital" => "Washington D.C",
            "Bandera" => "pages/img/banderas/usa.png"
        ),
        array 
        (
            "País" => "Alemania",
            "Capital" => "Berlín",
            "Bandera" => "pages/img/banderas/alemania.png"
        ),
        
        array 
        (
            "País" => "Brasil",
            "Capital" => "Brasilia",
            "Bandera" => "pages/img/banderas/brasil.png"
        ),
        
        array 
        (
            "País" => "Italia",
            "Capital" => "Roma",
            "Bandera" => "pages/img/banderas/italia.png"
        ),

        array 
        (
            "País" => "China",
            "Capital" => "Pekín",
            "Bandera" => "pages/img/banderas/china.png"
        )
    );
?>

<!DOCTYPE html>
    <head lang="es">
        <meta charset="utf-8" />
        <title>Banderas y capitales</title>
    </head>
    <body>
        <?php include("includes/independent_source.php"); ?>
        <form action="?page=formulario_paises" method="post">
            <fieldset>
                <label>País</label>
                <select name="paises">
                    <?php
                        
                        $selected = "";
          
                        sort ($paises);
                        
                        //Imprime todos los países
                        foreach ($paises as $pais=> $dato) {
                            
                            //Pone como seleccionado el país que se ha 
                            //consultado
                            if (isset($_POST['enviar'])) {
                                if (strcmp($dato['País'], $_POST['paises']) 
                                        == 0) {
                                    $selected = "selected";
                                }
                            }
                            
                            echo ('<option value="' . $dato['País'] . '" ' .
                                $selected . '>' . $dato['País'] . '</option>');
                            
                            //Una vez seleccionado se vacía
                            $selected = "";
                        }
                    ?>
                </select>
            </fieldset>
            <input type="submit" name="enviar" value="Enviar" />
        </form>
        
        <?php 
            if (isset ($_POST['enviar'])) {
                foreach ($paises as $pais => $dato) {    
                    if (strcmp ($dato['País'],$_POST['paises']) == 0) {
                        echo ("<p>País: " . $dato['País'] . "</p>");
                        echo ("<p>Capital: " . $dato['Capital'] . "</p>");
                        echo ('<img src="' . $dato['Bandera'] . '" />');
                        break;
                    }
                }
            }
        ?>
        
    </body>
</html>
