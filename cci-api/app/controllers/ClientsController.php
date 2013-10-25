<?php

use cci\http\LaravelResponse as Response;
use cci\repository\ClientRepositoryInterface;

class ClientsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	protected $baseApiPath;
	protected $repository;
	 
	public function __construct(ClientRepositoryInterface $repository) {
		$this->baseApiPath = 'http://'.preg_replace('/[^a-zA-Z0-9]/i','',$_SERVER['HTTP_HOST']).'/clients';
		$this->repository = $repository;
	} 
	
	public function getRepository() {
		return $this->repository;
	}
	 
	public function index()
	{
		$content = $this->repository->all();
       
        $response = Response::json($content,$this->baseApiPath,200);
        
        return $response;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $content = $this->repository->find($id);
        $location = $this->baseApiPath . '/' . $id;
        
        return Response::json($content,$location,200);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('clients.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
