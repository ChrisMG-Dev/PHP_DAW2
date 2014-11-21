<!DOCTYPE html>
<html>
    <head>
        <title>Formularios</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <style>
            #lblContainer {
                float: left;
                display: inline-block;
            }
            
            #lblContainer label {
                display: block;
                margin-top: 10px;
                margin-bottom: 5px;
            }
            
            #inputContainer {
                float: left;
                display: inline-block;
            }
            
            #inputContainer input, #inputContainer select {
                display: block;
                margin-left: 15px;
                margin-top: 5px;
                margin-bottom: 5px;
            }
        </style>
        <style>
            
            th, td, tr {
                font-family: Arial;
                font-size: larger;
            }
            
            th, td {
                padding-right: 15px;
                padding-left: 15px;
            }
            
            td {
                text-align: center;
                padding-top: 10px;
                padding-bottom: 10px;
            }
            
            h2 {
                margin-left: 340px;
            }
            
            .actual {
                color: green;
                font-weight: bold;
            }
            
            .domingo {
                color: red;
            }
        </style>
    </head>
    <body>
     <?php include("includes/independent_source.php"); ?>
        <form action="?page=formulario_mesanio" method="post">
            <fieldset>
                <div id="lblContainer">
                    <label>Año</label>
                    <label>Mes</label>
                </div>
                <div id="inputContainer">
                    <input type="number" pattern="[0-9]{4}" title=
                           "Año en formato de 4 cifras" size="4" maxlength="4"
                           name="anio" required/>
                    <select name="mes" required>
                        <option value="01">Enero</option>
                        <option value="02">Febrero</option>
                        <option value="03">Marzo</option>
                        <option value="04">Abril</option>
                        <option value="05">Mayo</option>
                        <option value="06">Junio</option>
                        <option value="07">Julio</option>
                        <option value="08">Agosto</option>
                        <option value="09">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                </div>
            </fieldset>
            <input type="submit" name="enviar" />
        </form>
        
        <?php 

        
            if (isset($_POST['enviar'])) {
                
                $diasSemana = array (
                    1 => "Lunes",
                    2 => "Martes",
                    3 => "Miércoles",
                    4 => "Jueves",
                    5 => "Viernes",
                    6 => "Sábado",
                    7 => "Domingo"
                );
    
                define('FECHA', $_POST['anio'] . '-' . $_POST['mes'] . '-01');
                define('PRIMER_DIA', substr_replace(FECHA, '01', 8));
    
                $dia = date("d", strtotime(FECHA));
                $diaSemana = date("N", strtotime(FECHA));
                $primerDiaMes = date("N", strtotime(PRIMER_DIA));
                $diasDelMes = date("t", strtotime(FECHA));
                
                //Número máximo de columnas del calendario
                define('MAX_COL', 7);
                
                //El número de celdas de una fila en todo momento
                $bloque = 0; 
                
                /* Indica si ya se ha alcanzado el primer día del mes, 
                * es necesario para crear celdas vacías si el primer día del
                * mes no empieza un lunes. */
                $flag = 0;
                
                echo ("<h2>". FECHA . "</h2>");
                echo ("<table>");
                
                for ($dias = 1;$dias < 8;$dias += 1) {
                    echo("<th>$diasSemana[$dias]</th>");
                }
                
                echo ("<tr>");
                
                for ($dias = 1; $dias <= $diasDelMes; $dias += 1) {
                    
                    if ($bloque == MAX_COL) {
                        echo ("</tr><tr>");
                        $bloque = 0;
                    }
                   
                    if ($dias == $primerDiaMes && $flag == 0) {
                        $dias = 1;
                        $flag = 1;
                    }
                    
                    /*
                     * Se cumple una vez se hayan rellenado las posibles celdas
                     * vacías
                     */
                    
                    if ($flag == 1) {
                        
                        if ($dia == $dias) {
                            echo ("<td class='actual'>$dias</td>");
                        }
                        
                        else if ($bloque == (MAX_COL - 1)) {
                            $domingo = strtolower($diasSemana['7']);
                            echo ("<td class=\"$domingo\">$dias</td>");
                        }
                        
                        else {
                            echo ("<td>$dias</td>");
                        }
                        
                    }
                    
                    else {
                        echo ("<td>&nbsp;</td>");
                    }
                    
                    $bloque += 1;
                    
                }
                
                echo ("</tr>");
                echo ("<table>");
            }
        ?>
    </body>
    
</html>
