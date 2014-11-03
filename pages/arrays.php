<?php include("includes/source.php"); ?>
<?php

    // Ejercicio 4
    $alumnos = array (
        array (
            "Nombre" => "Christopher",
            "Apellido1" => "Muñoz",
            "Apellido2" => "Godenir",
            "Ciclo" => "DAW",
            "Anio" => 2014
        ),
        array (
            "Nombre" => "Luis",
            "Apellido1" => "Guirao",
            "Apellido2" => "Carmona",
            "Ciclo" => "DAW",
            "Anio" => 2014
        ),
        array (
            "Nombre" => "Antonio",
            "Apellido1" => "León",
            "Apellido2" => "Alcaide",
            "Ciclo" => "DAW",
            "Anio" => 2014
        ),
        array (
            "Nombre" => "Daniel",
            "Apellido1" => "Cabrera",
            "Apellido2" => "Cebrero",
            "Ciclo" => "DAW",
            "Anio" => 2014
        ),
        array (
            "Nombre" => "Daniel",
            "Apellido1" => "Gutiérrez",
            "Apellido2" => "Lozano",
            "Ciclo" => "DAW",
            "Anio" => 2014
        ),
        array (
            "Nombre" => "Alejandro",
            "Apellido1" => "Gutiérrez",
            "Apellido2" => "Lozano",
            "Ciclo" => "DAW",
            "Anio" => 2014
        )
    );
    
    $alumnosConFormato = array ();
    
    foreach ($alumnos as $alumno) {
        $usuario = "";
        $usuario .= substr($alumno['Ciclo'], 0, 1);
        $usuario .= substr($alumno['Anio'], 2, 3);
        $usuario .= substr($alumno['Apellido1'], 0, 2);
        $usuario .= substr($alumno['Apellido2'], 0, 2);
        $usuario .= substr($alumno['Nombre'], 0, 1);
        
        $alumnosConFormato[] =  strtolower($usuario);        
    }
    
    echo ("Usuarios de alumnos en el formato caappssn");
    
    for ($i = 0; $i < count($alumnosConFormato) - 1; $i += 1) {
        echo ("<br />" . $alumnosConFormato[$i]);
    }
    
    // Ejercicio 5
    $informesInfraccion = array (
        array (
            "Matricula" => "7451CCB",
            "FechaHoraDenuncia" => "10/08/2013",
            "Motivo" => "Falta recibo"
        ),
        array (
            "Matricula" => "4655AAP",
            "FechaHoraDenuncia" => "22/12/2013",
            "Motivo" => "Excede tiempo"
        ),
        array (
            "Matricula" => "9367FGC",
            "FechaHoraDenuncia" => "04/03/2014",
            "Motivo" => "Excede tiempo"
        ),
        array (
            "Matricula" => "1673TWD",
            "FechaHoraDenuncia" => "29/09/2015",
            "Motivo" => "Falta recibo"
        )
    );
        
    $multas = array ( 
        "Falta recibo" => 100,
        "Excede tiempo" => 30
    );
    
    echo ("<br /><br /><table>");
    
    foreach ($informesInfraccion[0] as $metadato => $dato) {
        echo("<th>$metadato</th>");
    }
    
    echo ("<th>Multa</th>");
    
    foreach ($informesInfraccion as $informe => $datos) {
        echo ("<tr>");
        foreach ($datos as $dato) {
            echo ("<td>$dato</td>");
        }
        echo ("<td>" . $multas[$datos['Motivo']] . "€ </td>");
        echo ("</tr>");
    }
    
    echo ("</table>");
    
