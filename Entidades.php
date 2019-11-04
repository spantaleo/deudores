<?php

class Entidades {

	public function agregaEntidad($codigoEntidad, $prestamos, $entidades ){
		
		$insertarEntidad = true;
		foreach($entidades as $key => $entidad){
			if($codigoEntidad == $key ){
				$insertarEntidad = false;
				//Existe entidad sumo el prestamo 				
				$entidades[$key]['prestamos'] = (float)str_replace(',','.',$entidad['prestamos']) + (float)str_replace(',','.',$prestamos); 
				break;	
			}
		}
		
		//Agrego entidad si no existe
		if($insertarEntidad){
			$entidades[$codigoEntidad] = array('codigoEntidad'=> $codigoEntidad, 'prestamos' => (float)str_replace(',','.',$prestamos)) ;
		}
	
		return $entidades;
	
	}
}
?>