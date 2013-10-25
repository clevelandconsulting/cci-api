<?php

use cci\http\LaravelResponse as Response;

class ResponseTest extends ResponseTestCase {
	
	protected $content;
	protected $location;
	
	public function setup() {
		parent::setup();
		
		//always pass in fake content
		$this->content = 'foo';
		$this->location = 'foo.foo';
		
		//always get the built response
		$this->response = Response::json($this->content, $this->location);
		
	}
	
	public function test_json_whenCalled_returnsCorrectContentLength() {
		$this->assertEquals(strlen($this->content), $this->getResponseHeader('content-length'));
	}
	
	public function test_json_whenCalled_returnsCorrectContentType() {
		$this->assertEquals('application/json', $this->getResponseHeader('content-type'));
	}
	
	public function test_json_whenCalled_returnsCorrectLocation() {
		$this->assertEquals($this->location,$this->getResponseHeader('location'));
		
	}
}