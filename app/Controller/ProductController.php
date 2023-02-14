<?php

class ProductController
{
	public function index($params)
	{
		try {
			$product = Products::GetProductsById($params);

			$loader = new \Twig\Loader\FilesystemLoader('app/View');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('single.html');

			$parameters = array();
			$parameters['id_product'] = $product->id_product;
			$parameters['name'] = $product->name;
			$parameters['describe'] = $product->describe;
			$parameters['price'] = $product->price;
			$parameters['amount'] = $product->price;
			$parameters['active'] = $product->active;
			//var_dump($colecPostagens);

			$conteudo = $template->render($parameters);
			echo $conteudo;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}
