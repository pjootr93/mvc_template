<?php

class Home extends Controller {
	public function index($name =''){
		$user = $this->model('User');
		$user->name = $name;

		//sciezka do pliku view
		$this->view('home/index', ['name' => $user->name]);
	}

}
