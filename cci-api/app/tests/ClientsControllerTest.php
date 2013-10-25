<?php

require_once("ResponseTestCase.php");

class ClientsControllerTest extends ResponseTestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	 
	protected $controller;
	protected $apiPath;
	protected $repositoryInterface;
	protected $repository;
	protected $id;
	
	  /**************************************************************
	  *
	  *  Setup Function that get's called when class is constructed and run by PHPUNIT
	  *
	  **************************************************************/
	
	public function setup() {
		parent::setup();
		
		$this->id = 1; //could be any number that's in the db
		
		$this->apiPath = 'http://'.preg_replace('/[^a-zA-Z0-9]/i','',$_SERVER['HTTP_HOST']).'/clients';
		$this->repositoryInterface = 'cci\repository\ClientRepositoryInterface';
		$this->repository = Mockery::mock($this->repositoryInterface);
		//$this->repository->shouldReceive('all')->andReturn(Client::all());
	}
	
	  /**************************************************************
	  *
	  *  These are the index tests
	  *
	  **************************************************************/
	  
	public function test_getRepository_whenCalled_returnsAnInstanceOfClientRepository() {
		$this->setUpController();
		$this->assertInstanceOf($this->repositoryInterface,$this->controller->getRepository());
	}

	public function test_index_whenCalled_returnsJson() {
		$this->setUpIndex();
	
		$this->assertEquals("application/json",$this->getResponseHeader('content-type'));
	}
	
	public function test_index_whenCalled_returnsCorrectLocation() {
		$this->setUpIndex();
		
		$this->assertEquals($this->apiPath,$this->getResponseHeader('location'));
	}
	
	public function test_index_whenCalled_returnsCorrectObject() {
		$this->setUpIndex();
		
		$content = json_decode($this->getResponseContent());
		
		$this->assertTrue(is_array($content));
	}
	
	  /**************************************************************
	  *
	  *  These are the show tests
	  *
	  **************************************************************/
	
	public function test_show_whenCalledWithCorrectId_returnJson() {
		$this->setUpShow($this->id);
		
		$this->assertEquals("application/json",$this->getResponseHeader('content-type'));
	}
	
	public function test_show_whenCalledWithCorrectId_returnCorrectLocation() {
		$this->setUpShow($this->id);
		
		$this->assertEquals($this->apiPath . '/'.$this->id,$this->getResponseHeader('location'));
	}
	
	public function test_show_whenCalledWithCorrectId_returnsCorrectObject() {
		$this->setUpShow($this->id);
		
		$content = json_decode($this->getResponseContent());
		
		$this->assertTrue(is_object($content));
	}
	
	  /**************************************************************
	  *
	  *  Protected Helper functions
	  *
	  **************************************************************/
	  
	protected function setUpController() {
		$this->controller = new ClientsController($this->repository);
	}
	
	protected function setUpIndex() {
		$this->repository->shouldReceive('all')->once()->andReturn(Client::all());
		$this->setUpController();
		
		$this->response = $this->controller->index();
	}
	
	protected function setUpShow($id) {
		$this->repository->shouldReceive('find')->once()->with($id)->andReturn(Client::find($id));
		$this->setUpController();
		
		$this->response = $this->controller->show($id);
	}
}