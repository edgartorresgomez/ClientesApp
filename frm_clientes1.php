<?php

header("content-type: text/javascript");

    
$json = array(
        "resultado" => false,
        "cadena"    => "Rellena todos los campos del formulario"
      );  


// Si los datos son recibidos vía POST
//$nombre = ($_POST['nombre']);
$nombre = ("Edgar");
//$apellido = ($_POST['apellido']);
$apellido = ("torres");
//$mail = ($_POST['email']);
//telf = ($_POST['telf']);
//$servicio = ($_POST['servicio']);
//_pago = ($_POST['v_pago']);

// Obtiene los datos en variables
  
//if ($_POST){
$cantidad=0; 
  if (!empty($nombre) && !empty($apellido)){
      $json["resultado"]  = true;
      $json["cadena"]     = 'Cliente ' .$nombre. ' '. $apellido.' Ingresado';

      /*****************************************************************************************/

      // Lee el fichero en una variable,
      // y convierte su contenido a una estructura de datos
      $str_datos = file_get_contents("datos.json");
      $datos = json_decode($str_datos,true);

      //echo $datos["clientes"][0]["servicio"]["concepto"]."<br/>";

      $cant = count($datos["clientes"]);
      //$cantidad = count($datos["clientes"]["servicio"]); 

      echo $cantidad+1;
      //echo "Cliente: ".$datos["clientes"]["nombre"][0]."n";
       //echo ("Listado de Clientes".$datos["clientes"][0]["nombre"]."<br/>");
      // Modifica el valor, y escribe el fichero json de salida

      $arr = array(
              "id"        =>  $cant +1,
              "nombre"    =>  "edgar",
              "apellidos" =>  "apellido",
              "mail"      =>  "mail",
              "telf"      =>  0,
              "est_cliente"    =>  "A",
              "obs_cliente"=> "",
              "servicio"  => array(
                              array(
                            "id_servicio"  => $cantidad+1, 
                            "est_servicio" => "A",       
                            "concepto"  => "colera",
                            "v_pago"    => 30000,
                            "v_debe"    => 15000,
                            "obs_servicio"  => "",
                            "pagos"     => array(
                                            array(
                                              "fecha"=>"31/07/2015",
                                              "abono"=>15000,
                                              "obs_pago"=> ""
                                              )
                                            )
                           ) 
                          )
              );

      //echo json_encode($arr);
      //
      $datos["clientes"][$cant + 1] = $arr;
          //$datos["clientes"][$cant + 1]["apellidos"] = "Nel Suarez";


       
      $fh = fopen("datos.json", 'w')or die("Error al abrir fichero de salida");
      fwrite($fh, json_encode($datos,JSON_UNESCAPED_UNICODE));
      fclose($fh); 

      /*****************************************************************************************/



    }
//}

 
  echo json_encode($json);

?>