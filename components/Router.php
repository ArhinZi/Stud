<?php

class Router
{

	private $routes;

	public function __construct()
	{
		$routesPath = ROOT.'/config/routes.php';
		$this->routes = include($routesPath);
	}

	private function getURI()
	{
		if (!empty($_SERVER['REQUEST_URI'])) {
		return trim($_SERVER['REQUEST_URI'], '/');
		}
	}

	public function run()
	{
		$uri = $this->getURI();
		foreach ($this->routes as $uriPattern => $path) {
			if ($path == '404') 
			{
				require_once(ROOT . '/404.html');
				break;
			}
			if(preg_match("~$uriPattern~", $uri)) {

				//echo "<br>Где ищем (запрос, который набрал пользователь): ".$uri;
				//echo "<br>Что ищем (совпадение из правила): ".$uriPattern;
				//echo "<br>Кто обрабатывает: ".$path; 

				// Получаем внутренний путь из внешнего согласно правилу.

				$internalRoute = preg_replace("~$uriPattern~", $path, $uri); //Выполняет поиск и замену по регулярному выражению

				//echo '<br>Нужно сформулировать: '.$internalRoute.'<br>'; 

				$segments = explode('/', $internalRoute); //Разбивает строку с помощью разделителя
				$controllerName = array_shift($segments).'Controller'; //извлекает первый элемент массива
				$controllerName = ucfirst($controllerName); 
				
				

				$actionName = 'action'.ucfirst(array_shift($segments));
				
				
				
				$parameters = $segments;
				
				$controllerFile = ROOT . '/controllers/' .$controllerName. '.php';
				if (file_exists($controllerFile)) { //проверяем наличие файла
					include_once($controllerFile);
				}
				$controllerObject = new $controllerName;
				$result = $controllerObject->$actionName($parameters);
				if ($result != null) {
					break;
				}
				
			}

		}
	}
}