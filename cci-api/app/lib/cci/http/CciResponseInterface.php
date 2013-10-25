<?php

namespace cci\http;

interface CciResponseInterface {
	
	public static function json($content = '', $resourceLocation = '', $status = 200, array $headers = array(), $json_options = 0);
}