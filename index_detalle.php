<?php

header("content-type: text/javascript");


$str_datos = file_get_contents("datos.json");
$datos = json_decode($str_datos,true);

$count_i = count($datos["clientes"]); 
for($i = 1;  $i<=$count_i; $i++){
  //$datos["clientes"][$i]['salt'] = mt_rand(000000, 999999);
  $json = $datos["clientes"][$i]["nombre"]." ". $datos["clientes"][$i]["servicio"]["concepto"];
  
  $count_j=count($datos["clientes"][$i]["servicio"]["pagos"]);   
  for($j = 0; $j<$count_j; ++$j){
   $json  = $json." ".$datos["clientes"][$i]["servicio"]["pagos"][$j]["abono"];
  }
  //echo $i." - ".$j." - ".$json."<br/>";

echo json_encode($json);
}



 


?>

