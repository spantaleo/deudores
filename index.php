<?php

require_once(__DIR__.'/Deudores.php');
require_once(__DIR__.'/Entidades.php');
require_once(__DIR__.'/Conexion.php');


$fileHandle = fopen("./deudores.txt", "r");

$deudores = array();
$entidades = array();	

//Loop through the CSV rows.
while (($row = fgetcsv($fileHandle, 0, "	")) !== FALSE) {
	
	$codigoEntidad = substr($row[0], 0, 5); 
	$fechaInformacion = substr($row[0], 5, 6);
	$tipoDeIdentificacion  = substr($row[0], 11, 2);
	$nroIdentificacion = substr($row[0], 13, 11); 
	$actividad = substr($row[0], 24, 3);
	$situacion = substr($row[0], 27, 2); 
	$prestamos = substr($row[0], 29, 12); 
	$participaciones = substr($row[0], 41, 12);
	$garantiasOtorgadas = substr($row[0], 53, 12);
	$otrosConceptos = substr($row[0], 65, 12);
	$garantiasPreferidasA = substr($row[0], 77, 12);
	$garantiasPreferidasB = substr($row[0], 89, 12);
	$sinGarantiasPreferidas = substr($row[0], 101, 12);
	$contragarantiasPreferidasA = substr($row[0], 113, 12);
	$contragarantiasPreferidasB  = substr($row[0], 125, 12);
	$sinContragarantiasPreferidas = substr($row[0], 137, 12);
	$previsiones = substr($row[0], 149, 12);
	$deudaCubierta = substr($row[0], 161, 1);
	$procesoJudicialRevision = substr($row[0], 162, 1);
	$refinanciaciones  = substr($row[0], 163, 1);
	$recategorizacionObligatoria = substr($row[0], 164, 1);
	$situacionJuridica = substr($row[0], 165, 1);
	$irrecuperablesPorDisposicionTecnica = substr($row[0], 166, 1);
	$diasDeAtraso = substr($row[0], 167, 4);

	$deudoresObj = new Deudores();
	$deudores = $deudoresObj->agregaDeudor($nroIdentificacion, $situacion, $prestamos, $deudores );

	$entidadesObj = new Entidades();
	$entidades = $entidadesObj->agregaEntidad($codigoEntidad, $prestamos, $entidades );

	
}
fclose($fileHandle);

$conexionObj = new Conexion();
$conexionObj->guardaDeudores( $deudores );
$conexionObj->guardaEntidades( $entidades );




?>