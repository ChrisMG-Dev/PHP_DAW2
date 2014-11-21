<?php include("includes/independent_source.php"); ?>
<?php
    $cursos = array (
      "1DAW" => array
        (
          'Pepe 1DAW',
          'Juan 1DAW',
          'Paco 1DAW'
        ),
      "2DAW" => array
        (
          'Christopher 2DAW',
          'Luis 2DAW',
          'Antonio 2DAW',
          'Dani C. 2DAW',
          'Dani G. 2DAW',
          'JuanPedro 2DAW',
          'Rubén 2DAW',
          'Paz 2DAW',
          'Alejandro 2DAW'
        ),
       "1ASIR" => array
        (
           'Maria 1ASIR',
           'Manuel 1ASIR',
           'Pedro 1ASIR'
        ),
       "2ASIR" => array
        (
           'Carlos 2ASIR',
           'Laura 2ASIR',
           'Alexander 2ASIR'
        )
    );
    
    foreach ($cursos as $key => $value) {
        echo ("<br/><br/><h2>$key</h2>");
        foreach ($value as $valor) {
            echo ("<br />$valor");
        }
           
    }

 

?>
