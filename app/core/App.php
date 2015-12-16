<?php

class App {
	protected $controller = 'home';
	protected $method = 'index';
	protected $params = [];
	//adres strony:
	//sample.pl/controller/method/arguments[]
	public function __construct(){
		$url = $this->parseUrl();
		//sprawdzenie czy plik kontrolera istnieje
		if (file_exists('../app/controllers/'.$url[0].'.php')) {
			$this->controller =$url[0];
			unset($url[0]);
		}
		//dolaczenie pliku kontrolera url[0]
		//domyslnie home
		require_once '../app/controllers/'. $this->controller .'.php';


		// tworzy obiekt klasy o nazwie "$this->controller",
		// domyslne home
		$this->controller = new $this->controller;

		//drugi element geta
		//sprawdzenie czy metoda istnieje
		if (isset($url[1])) {
			if(method_exists($this->controller, $url[1])){
				$this->method = $url[1];
				unset($url[1]);
			}
		}

		$this->params = $url ? array_values($url) : [];

		//wywolanie metody (domyslnie index)
		//z parametrami
		call_user_func_array([$this->controller, $this->method], $this->params);

	}

	public function parseUrl(){
		if (isset($_GET['url'])) {
			return $url = explode('/',filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}
}
