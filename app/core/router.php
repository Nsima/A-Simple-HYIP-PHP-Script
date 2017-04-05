<?php 


defined("BASEURL") OR die("Direct access denied");

/**
* 
*/
class bootstrap 
{
	private $controller = "home";
	private $method 	= "index";
	private $params 	= array();


	public function __construct() {
		
		$url = $this->url_parse();

		if (file_exists("app/controller/" . $url[0] . ".php")) {
			$this->controller = $url[0];
			unset($url[0]);
		}

		require "app/controller/" . $this->controller . ".php"; // controller file

		$this->controller = new $this->controller;

		if (isset($url[1])) {

			if (method_exists($this->controller, $url[1])) {
				$this->method = $url[1];
				unset($url[1]);
			}
		}

		$this->params = $url ? array_values($url) : array();
		call_user_func_array([$this->controller, $this->method], $this->params);


	}
	
	private function url_parse() {
		
		if (isset($_GET["url"])) {
			$url = explode("/", filter_var(rtrim($_GET["url"], "/"), FILTER_SANITIZE_URL));
			return $url;
		} 
	}
}
?>