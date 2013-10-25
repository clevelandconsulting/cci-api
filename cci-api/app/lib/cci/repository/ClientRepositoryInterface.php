<?php

namespace cci\repository;

interface ClientRepositoryInterface {
	
	public function all();
	public function find($id);
}