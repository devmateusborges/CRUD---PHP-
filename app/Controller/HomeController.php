<?php

class HomeController
{
	public function index()
	{
		try {
			$colecProducts = Products::getAllProductsFilter($_POST);



			$loader = new \Twig\Loader\FilesystemLoader('app/View');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('home.html');

			$parametros = array();
			$parametros['products'] = $colecProducts;
			//var_dump($colecProducts);

			$conteudo = $template->render($parametros);
			echo $conteudo;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}
