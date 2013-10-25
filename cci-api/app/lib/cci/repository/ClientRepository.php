<?php

namespace cci\repository;

use Client;

class ClientRepository implements ClientRepositoryInterface {
	
	public function all() {
		return Client::all();
	}
	
	public function find($id) {
		return Client::find($id);
	}
}