<?php
class Control {

	public function ErrorObject( $message ) {
		$oResponse 			= new StdClass();
		$oResponse->error 	= TRUE;
		$oResponse->message = $message;

		return $oResponse;
	}

	public function OutputJSON( $object ) {
		echo json_encode( $object );
		exit;
	}

	public function ConvertXmlToArray( $xmlstring ) {
		$xml 	= simplexml_load_string( $xmlstring );
		$json 	= json_encode( $xml );
		$array 	= json_decode( $json, TRUE );

		return $array;
	}
}
