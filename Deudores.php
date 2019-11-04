<?php

class Deudores {

	public function agregaDeudor($nroIdentificacion, $situacion, $prestamos, $deudores ){
		
		$insertarDeudor = true;
		foreach($deudores as $key => $deudor){
			if($nroIdentificacion == $key ){
				$insertarDeudor = false;	
				
				//Existe deudor sumo el prestamo 
				$deudores[$key]['prestamos'] = (float)str_replace(',','.',$deudor['prestamos']) + (float)str_replace(',','.',$prestamos);
				
				//Tomo la situacion más desfavorable
				if($situacion > $deudor['situacion']){
					$deudores[$key]['situacion'] = $situacion;
				}		
				break;	
			}
		}
		
		//Agrego deudor si no existe
		if($insertarDeudor){
			$deudores[$nroIdentificacion] = array('nroIdentificacion'=> $nroIdentificacion, 'situacion' => $situacion, 'prestamos' => (float)str_replace(',','.',$prestamos) ) ;
		}
	
		return $deudores;
	
	}
}
?>