<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Curriculum Vitae</title>
        <meta charset="utf-8" />
        <style>
            
            #contenedor {
                margin: 0 auto;
                width: 55%;
            }
            
            h1 {
                text-align: center;
            }
            input, textarea, select {
                margin-top: 5px;
                margin-bottom: 5px;
                display:inline-block;              
                vertical-align:middle;
                margin-left:20px
            }

            label {
                display:inline-block;
                float: left;
                padding-top: 5px;
                text-align: right;
                width: 220px;
            }
            
            fieldset {
                display: inline-block;
            }
           
            .botonesForm {
                clear: both;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <?php include("includes/independent_source.php"); ?>
        <div id="contenedor" />
            <h1>Curriculum vitae</h1>
            
            <?php 
                if (isset($_POST['enviar'])) {
                    
                    echo ("<table>");

                    echo ("<tr>");
                    echo ("<th>Nombre</th>");
                    echo ("<td>" . $_POST['nombre'] . "</td>");
                    echo ("</tr>");

                    echo ("<tr>");
                    echo ("<th>Apellidos</th>");
                    echo ("<td>" . $_POST['apellidos'] . "</td>");
                    echo ("</tr>");

                    echo ("<tr>");
                    echo ("<th>Sexo</th>");
                    echo ("<td>" . $_POST['sexo'] . "</td>");
                    echo ("</tr>");

                    echo ("<tr>");
                    echo ("<th>E-mail</th>");
                    echo ("<td>" . $_POST['email'] . "</td>");
                    echo ("</tr>");

                    echo ("<tr>");
                    echo ("<th>Teléfono</th>");
                    echo ("<td>" . $_POST['telefono'] . "</td>");
                    echo ("</tr>");

                    echo ("<tr>");
                    echo ("<th>Experiencia Laboral</th>");
                    echo ("<td>" . $_POST['laboral'] . "</td>");
                    echo ("</tr>");

                    echo ("<tr>");
                    echo ("<th>Estudios realizados</th>");
                    echo ("<td>" . $_POST['estudios'] . "</td>");
                    echo ("</tr>");

                    echo ("<tr>");
                    echo ("<th>Jornada preferente</th>");
                    echo ("<td>" . $_POST['jornada'] . "</td>");
                    echo ("</tr>");

                    echo ("<tr>");
                    echo ("<th>Incorporación inmediata</th>");
                    echo ("<td>" . $_POST['incorp'] . "</td>");
                    echo ("</tr>");

                    echo ("<tr>");
                    echo ("<th>idiomas</th>");
                    echo ("<td><ul>");

                    if (!empty($_POST['idiomas'])) {
                        foreach ($_POST['idiomas'] as $idioma) {
                          echo ("<li>$idioma</li>"); 
                        }
                    }

                    else {
                        echo ("Ningún idioma extranjero");
                    }

                    echo ("</ul></td>");
                    echo ("</tr>");

                    echo ("<tr>");
                    echo ("<th>Ofimática</th>");
                    echo ("<td><ul>");

                    if (!empty($_POST['ofimatica'])) {
                        foreach ($_POST['ofimatica'] as $programa) {
                          echo ("<li>$programa</li>"); 
                        }
                    }

                    else {
                        echo ("Ningún programa ofimático");
                    }

                    echo ("</ul></td>");
                    echo ("</tr>");
                    echo ("</table>");
                }
?>
            <form id="form1" action="?page=formulario_cv" method="post">
                <fieldset>
                    <p class="texto">
                        <label>Nombre</label>
                        <input type="text" name="nombre" required />
                    </p>
                    <p class="texto">
                        <label>Apellidos</label>
                        <input type="text" name="apellidos" required />
                    </p>
                    <p class="texto">
                        <label>Sexo</label>
                        <input type="radio" name="sexo" value="Hombre" checked />Hombre
                        <input type="radio" name="sexo" value="Mujer" />Mujer
                    </p>
                    <p class="texto">
                        <label>Correo electrónico</label>
                        <input type="email" name="email" required />
                    </p>
                    <p class="texto">
                        <label>Número de contacto</label>
                        <input type="text" name="telefono" required />
                    </p>
                    <p class="texto">
                        <label>Experiencia laboral</label>
                        <textarea rows="6" cols="30" name="laboral" ></textarea>
                    </p>
                    <p class="texto">
                        <label>Estudios</label>
                        <textarea rows="6" cols="30" name="estudios"></textarea>
                    </p>
                    <p class="texto">
                        <label>Jornada preferente</label>
                        <select name="jornada">
                            <option value="Indiferente" selected >Indiferente</option>
                            <option value="Mañana">Por la mañana</option>
                            <option value="Por la tarde">Por la tarde</option>
                        </select>
                    </p>
                    <p class="texto">
                        <label>Incorporación inmediata</label>
                        <input type="radio" name="incorp" value="Si" checked />Si
                        <input type="radio" name="incorp" value="No" />No
                    </p>

                    <p class="texto">
                        <label>Idiomas</label>
                        <input type="checkbox" name="idiomas[]" value="Inglés" />Inglés
                        <input type="checkbox" name="idiomas[]" value="Francés" />Francés
                        <input type="checkbox" name="idiomas[]" value="Alemán" />Alemán
                        <input type="checkbox" name="idiomas[]" value="Chino" />Chino
                        <input type="checkbox" name="idiomas[]" value="Otros" />Otros
                    </p>

                    <p class="text">
                        <label>Ofimática</label>
                        <select title="Deje pulsado la tecla CTRL para seleccionar 
                                más de una opción" name="ofimatica[]" multiple>
                            <option>Procesador de textos</option>
                            <option>Hoja de cálculo</option>
                            <option>Base de datos Access</option>
                            <option>Presentaciones</option>
                        </select>
                    </p>

                </fieldset>
                <div class="botonesForm">
                    <input type="submit" name="enviar" value="Enviar"/>
                    <input type="reset" name="reset" value="Limpiar"/>
                </div>
            </form>
        </div>
    </body>
</html>