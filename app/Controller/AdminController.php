<?php

class AdminController
{
	public function index()
	{
		$loader = new \Twig\Loader\FilesystemLoader('app/View');
		$twig = new \Twig\Environment($loader);
		$template = $twig->load('admin.html');

		$objPostagens = Products::getAllProductsFilter($_POST);

		$parametros = array();
		$parametros['products'] = $objPostagens;

		$conteudo = $template->render($parametros);
		echo $conteudo;
	}

	public function create()
	{
		$loader = new \Twig\Loader\FilesystemLoader('app/View');
		$twig = new \Twig\Environment($loader);
		$template = $twig->load('create.html');

		$parametros = array();

		$conteudo = $template->render($parametros);
		echo $conteudo;
	}

	public function insert()
	{
		try {
			Products::AddProduct($_POST);

			echo '<script>alert("Publicação inserida com sucesso!");</script>';
			echo '<script>location.href="http://localhost/crud/?page=admin&method=index"</script>';
		} catch (Exception $e) {
			echo '<script>alert("' . $e->getMessage() . '");</script>';
			echo '<script>location.href="http://localhost/crud/?page=admin&method=create"</script>';
		}
	}

	public function change($paramId)
	{
		$loader = new \Twig\Loader\FilesystemLoader('app/View');
		$twig = new \Twig\Environment($loader);
		$template = $twig->load('update.html');

		$product = Products::GetProductsById($paramId);

		$parameters = array();
		$parameters['id_product'] = $product->id_product;
		$parameters['name'] = $product->name;
		$parameters['describe'] = $product->describe;
		$parameters['price'] = $product->price;
		$parameters['amount'] = $product->price;
		$parameters['active'] = $product->active;

		$conteudo = $template->render($parameters);
		echo $conteudo;
	}

	public function update()
	{
		try {
			Products::update($_POST);

			echo '<script>alert("Publicação alterada com sucesso!");</script>';
			echo '<script>location.href="http://localhost/crud/?page=admin&method=index"</script>';
		} catch (Exception $e) {
			echo '<script>alert("' . $e->getMessage() . '");</script>';
			echo '<script>location.href="http://localhost/crud/?page=admin&method=change&id=' . $_POST['id'] . '"</script>';
		}
	}

	public function delete($paramId)
	{
		try {
			Products::delete($paramId);

			echo '<script>alert("Publicação deletada com sucesso!");</script>';
			echo '<script>location.href="http://localhost/crud/?page=admin&method=index"</script>';
		} catch (Exception $e) {
			echo '<script>alert("' . $e->getMessage() . '");</script>';
			echo '<script>location.href="http://localhost/crud/?page=admin&method=index"</script>';
		}
	}
}
