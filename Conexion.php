<?php

require 'vendor/autoload.php'; 


class Conexion {
	
	private $cliente;
	
	function __construct() {
		$this->cliente =  new MongoDB\Client("mongodb+srv://sebastian:jmqe6IjUfKZYxBSf@cluster0-w8wwi.gcp.mongodb.net/test?retryWrites=true&w=majority");;
	}
	
	
	function guardaDeudores($deudores){

		try {
			
			$coleccion = $this->cliente->waynimovil->deudores;

			$response = $coleccion->drop();
			
			foreach($deudores as $deudor){
				$resultado = $coleccion->insertOne( [ 'nroIdentificacion' => $deudor['nroIdentificacion'], 'situacion' => $deudor['situacion'],  'prestamos' => $deudor['prestamos'] ] );
				echo "Insertado con Object ID '{$resultado->getInsertedId()}'";
			}
		} catch (Exception $e) {
			echo 'Ha habido una excepción: ' . $e->getMessage() . "<br>";
		}
	}
	
	function guardaEntidades($entidades){
	
		try {
			
			$coleccion_entidades = $this->cliente->waynimovil->entidades;
	
			$response = $coleccion_entidades->drop();
			
			foreach($entidades as $entidad){
				$resultado = $coleccion_entidades->insertOne( [ 'codigoEntidad' => $entidad['codigoEntidad'], 'prestamos' => $entidad['prestamos'] ] );
				echo "Insertado con Object ID '{$resultado->getInsertedId()}'";
			}
		} catch (Exception $e) {
			echo 'Ha habido una excepción: ' . $e->getMessage() . "<br>";
		}
	}

}
?>