<?php
/**
 * Descripción
 *
 * @author Christopher Muñoz Godenir
 * @version 1.0
 * @license GNU GPL http://www.gnu.org/copyleft/gpl.html
 */
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <style type="text/css">
            fieldset {
                display: inline-block;
                width: 50%;
                border: 1px solid black;
                border-radius: 12px 12px 0 0;
            }
            
            fieldset p:last-child {
                margin-bottom: 5px;
            }
            
            #entrar {
                font-size: 17px;
                -moz-border-radius: 9px;
                border-radius: 9px;
            }
            
            #entrar:hover {
                background-color: #eae1e1;
            }
        </style>
    </head>
    <body>
        <form action="?page=objetos/custom_menu" method="post">
            <fieldset>
                <h2>Entrar como</h1>
                <p>
                    <input type="radio" name="tipoPersona" value="persona"
                           checked />
                    Dueño
                </p>
                <p>
                    <input type="radio" name="tipoPersona" value="veterinario"/>
                Veterinario
                </p>
            </fieldset>
            <br/><br />
            <input type="submit" name="entrar" id="entrar" value="Entrar" />
        </form>
    </body>
</html>