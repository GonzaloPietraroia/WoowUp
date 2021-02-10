<?php

#EJERCICIO 1

#PRECONDICION: El numeor de escalones debe ser mayor o igual a 1

function formasDeSubir($numeroDeEscalones){
	
	$x = 1;
	$n = 0;
	$formas = 0;

	while ($numeroDeEscalones!=0){

		$formas = $n + $x;
		$n = $x;
		$x = $formas;
		$numeroDeEscalones--;

	}

	return $formas;

}

echo formasDeSubir(4);

?>

<?php

#EJERCICIO 2

#PRECONDICION: El producto debe haber sido comprado dos o mas veces

$datos_compras = file_get_contents("purchases.json");
$json_compras = json_decode($datos_compras, true);


function fechasDeCompra($arrayDeBusqueda){
 
    $nuevaArray=array();

    foreach ($arrayDeBusqueda["customer"]["purchases"] as $purchases) {

        foreach ($purchases as $key=>$value) {
          
            if ($key == "products"){ 
                
                foreach ($purchases["products"] as $product){
                  
                    $nuevaArray[$product["sku"]][]=$purchases["date"];
                	
                }

            }   
        }        
    }   
    return $nuevaArray; 
}

function diferenciaDeFechasEntreCompras($fechas){

		$date1 = date_create(reset($fechas));
		$date2 = date_create(next($fechas));
		$diff = $date1 ->diff($date2);

		$promedio= $diff->days;

		return $promedio;
	
}



function fechaEstimadaDeRecompra($comprasConLaFecha){
	
	$arrayConProductoYFechaDeRecompra = array();

	foreach ($comprasConLaFecha as $k => $fechas) {

		if (count($fechas)>=2) {

			$arrayConProductoYFechaDeRecompra[$k][]= date("Y-m-d",strtotime(end($fechas)."+". diferenciaDeFechasEntreCompras($fechas)."days")); 
		}
	}
		
	return $arrayConProductoYFechaDeRecompra;

}

var_dump(fechaEstimadaDeRecompra(fechasDeCompra($json_compras)))


?>





