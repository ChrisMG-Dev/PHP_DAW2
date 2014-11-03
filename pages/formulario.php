<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Creación de un formulario</title>
        <style>
            #lblContainer {
                display: inline-block;
                float: left;
            }
            
            #lblContainer label {
                display: block;
                font-size: 21px;
            }
            
            #inputContainer {
                display: inline-block;
                float: left;
            }
            
            #inputContainer input, #inputContainer select {
                margin-left: 15px;
                display: block;
            }
            
            #inputContainer input[type=radio] {
                display: inline;
            }
            
            fieldset {
                display: inline-block;
            }
            
            tr, th, td {
                border-collapse: collapse;
                border: 1px solid black;
            }
            
            th, td {
                text-align: center;
            }
            
            td {
                padding-left: 20px;
                padding-right: 20px;
            }
        </style>
    </head>
    <body>
        <?php include("includes/source.php"); ?>
        <br /><br />
        <form name="form1" action="formulario.php" method="post">
            <fieldset>
                <div id="lblContainer">
                    <label>Nombre </label>
                    <label>Apellidos </label>
                    <label>Dirección </label>
                    <label>Sexo </label>
                    <label>Fecha nacimiento </label>
                    <label>Email </label>
                    <label>Blog </label>
                    <label>Curso </label>
                </div>
                
                <div id="inputContainer">
                    <input type="text" name="nombre" size="20"/>
                    <input type="text" name="apellidos" size="20"/>
                    <input type="text" name="direccion" size="35" />
                    <input type="radio" name="sexo" value="Hombre" checked/>Hombre
                    <input type="radio" name="sexo" value="Mujer" />Mujer
                    <input type="date" name="fechaNac" size="10"/>
                    <input type="email" name="email" size="25">
                    <input type="text" name="blog" size="30">
                    
                     <select name="curso">
                        <option value="1º Desarrollo de aplicaciones web">1º Desarrollo de aplicaciones web</option>
                        <option value="2º Desarrollo de aplicaciones web">2º Desarrollo de aplicaciones web</option>
                        <option value="1º Administración de sistemas informáticos y redes">1º Administración de sistemas informáticos y redes</option>
                        <option value="2º Administración de sistemas informáticos y redes">2º Administración de sistemas informáticos y redes</option>
                    </select> 
                </div>
            </fieldset>
            <br /><br />
            <input type="submit" 
                   value="Enviar" name="enviar"/>
        </form>
        
        <?php 
            /**
             * Programa sencillo que crea una tabla html con los datos 
             * insertados previamente en los campos del formulario.
             * 
             * @author Christopher Muñoz Godenir
             * @version 1.0
             * @license http://opensource.org/licenses/GPL-3.0 GNU GPL 3.0
             */
        
            if (isset($_POST['enviar'])) {
                echo ("<table>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Dirección</th>
                <th>Sexo</th>
                <th>Fecha de nacimiento</th>
                <th>Email</th>
                <th>Blog</th>
                <th>Curso</th>
                <tr>
               <td>" . $_POST["nombre"] . "</td>
               <td>" . $_POST["apellidos"] . "</td>
               <td>" . $_POST["direccion"] . "</td>
               <td>" . $_POST["sexo"] . "</td>
               <td>" . $_POST["fechaNac"] . "</td>
               <td>" . $_POST["email"] . "</td>
               <td>" . $_POST["blog"] . "</td>
               <td>" . $_POST["curso"] . "</td>
               </tr>
               </table>");
            }
        ?>
    </body>
</html>


