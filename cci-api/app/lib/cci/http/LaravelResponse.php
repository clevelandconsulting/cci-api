<?php

namespace cci\http;

class LaravelResponse implements CciResponseInterface {
	
	public static function json($content = '', $resourceLocation = '', $status = 200, array $headers = array(), $json_options = 0) {
		
		$headers['Content-Length'] = strlen($content);
		$headers['Location'] = $resourceLocation;
		
		$response = \Response::json($content,$status,$headers,$json_options);
		
		return $response;
	}
	
}

