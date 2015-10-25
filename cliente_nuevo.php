<?php
// Lee el fichero en una variable,
// y convierte su contenido a una estructura de datos
$str_datos = file_get_contents("datos.json");
$datos = json_decode($str_datos,true);

//echo $datos["clientes"][0]["servicio"]["concepto"]."<br/>";

$cant = count($datos["clientes"]);
 
//echo "Cliente: ".$datos["clientes"]["nombre"][0]."n";
 //echo ("Listado de Clientes".$datos["clientes"][0]["nombre"]."<br/>");
// Modifica el valor, y escribe el fichero json de salida

$arr = array('nombre' => "Cristian", "apellidos"
 => "Contreras", "servicio" => array("concepto" =>"arreglo ext telefonica","v_pago" => 30000, "pagos"=> array(array("fecha"=>"31/07/2015","abono"=>15000))));

//echo json_encode($arr);
//
$datos["clientes"][$cant + 1] = $arr;
		//$datos["clientes"][$cant + 1]["apellidos"] = "Nel Suarez";


 
$fh = fopen("datos_out.json", 'w')
      or die("Error al abrir fichero de salida");
fwrite($fh, json_encode($datos,JSON_UNESCAPED_UNICODE));
fclose($fh);




?>
