<?php
// Lee el fichero en una variable,
// y convierte su contenido a una estructura de datos
$str_datos = file_get_contents("datos.json");
$datos = json_decode($str_datos,true);

$cant_clientes = count($datos["clientes"]);
//echo $cant_clientes;
for ($i = 1; $i <= $cant_clientes; $i++){
  $resultado=($datos["clientes"][$i]["id"]);
  if ($datos["clientes"][$i]["id"]== 2){
    $cant_pagos = count($datos["clientes"][$i]["servicio"]["pagos"]);
    echo $datos["clientes"][$i]["id"]." ".$cant_pagos;
    $arr=array(
          "fecha"=>"10/08/2015",
          "abono"=>3000
          );
    
				
					$datos["clientes"][$i]["servicio"]["pagos"][$cant_pagos]=$arr;
    
    
     //echo ($datos["clientes"][$i]["servicio"]["pagos"][$j]["abono"]."<br/>"); 
    
    $fh = fopen("datos.json", 'w')or die("Error al abrir fichero de salida");
    fwrite($fh, json_encode($datos,JSON_UNESCAPED_UNICODE));
    fclose($fh);
  }

  
  //echo $resultado = $resultado."<br/>";
}





// Modifica el valor, y escribe el fichero json de salida
//$datos["clientes"][0]["nombre"] = "Julian";
 


?>