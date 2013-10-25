<?php

require_once("ResponseTestCase.php");

class ResponseTestCase extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	 
	protected $response;
	
	  /**************************************************************
	  *
	  *  Setup Function that get's called when class is constructed and run by PHPUNIT
	  *
	  **************************************************************/
	
	public function setup() {
		parent::setup();
		$this->setUpDb();
		$this->response = null;
	}
		
	  /**************************************************************
	  *
	  *  Protected helper functions
	  *
	  **************************************************************/
	
	
	protected function getResponseContent() {
		if ( $this->response != null ) return $this->response->getContent();
	}
	
	protected function getResponseHeader($header) {
		$hVal = null;
		foreach($this->response->headers as $key => $value) {
			if ( strtolower($key) === strtolower($header)) {
				$hVal = $value[0];
			}
		}
		
		return $hVal;
	}
	
	public function tearDown() {
		parent::tearDown();
		$this->tearDownDb();
	}
	
	protected function setUpDb() {
		Artisan::call('migrate');
		Artisan::call('db:seed');
	}
	
	protected function tearDownDb() {
		Artisan::call('migrate:reset');
	}
}