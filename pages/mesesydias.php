<?php include("includes/independent_source.php"); ?>
<?php
    /*
     * Meses y días en un array asociativo
     */

     $datosMeses = array();
     $anio;
     
     for($mes = 1;$mes < 13;$mes += 1){
         $datosMeses[] = cal_days_in_month (CAL_GREGORIAN, $mes , $anio);
     }
     
     foreach ($datosMeses as $key => $value) {
         echo("<br />Key:" . $key . ", Value: " . $value);
      }

?>

