<?php

class Products
{

	public static function getAllProductsFilter($Search)
	{
		$con = Connection::getConn();
		if (!$Search) {
			$Search['search'] = "";
		}

		$sql = "SELECT * FROM product where `name` Like '%" . $Search['search'] . "%'";
		$sql = $con->prepare($sql);
		$sql->execute();

		$result = array();

		while ($row = $sql->fetchObject('products')) {
			$result[] = $row;
		}


		if (!$result) {
			throw new Exception("Não foi encontrado nenhum registro no banco");
		}

		return $result;
	}

	public static function GetProductsById($idProduct)
	{
		$con = Connection::getConn();

		$sql = "SELECT * FROM product WHERE id_product = :id";
		$sql = $con->prepare($sql);
		$sql->bindValue(':id', $idProduct, PDO::PARAM_INT);
		$sql->execute();

		$result = $sql->fetchObject('products');


		if (!$result) {
			throw new Exception("Não foi encontrado nenhum registro no banco");
		}

		return $result;
	}

	public static function AddProduct($dataProduct)
	{
		if (empty($dataProduct['name']) or empty($dataProduct['describe'])) {
			throw new Exception("Preencha todos os campos");

			return false;
		}

		$con = Connection::getConn();

		$sql = $con->prepare('INSERT INTO `product`( `name`, `describe`, `price`, `amount`, `active`) VALUES (:name , :describe ,:price,:active, :active)');
		$sql->bindValue(':name', $dataProduct['name']);
		$sql->bindValue(':describe', $dataProduct['describe']);
		$sql->bindValue(':price',  $dataProduct['price']);
		$sql->bindValue(':amount', $dataProduct['amount']);
		$sql->bindValue(':active', $dataProduct['active']);
		$res = $sql->execute();

		if ($res == 0) {
			throw new Exception("Falha ao inserir Produto");

			return false;
		}

		return true;
	}

	public static function update($params)
	{
		$con = Connection::getConn();

		$sql = $con->prepare('UPDATE `product` SET `name`= :name,`describe`= :describe,`price`= :price,`amount`=:amount,`active`= :active WHERE id_product = :id');
		$sql->bindValue(':id', $params['id_product']);
		$sql->bindValue(':name', $params['name']);
		$sql->bindValue(':describe', $params['describe']);
		$sql->bindValue(':price',  $params['price']);
		$sql->bindValue(':amount', $params['amount']);
		$sql->bindValue(':active', $params['active']);

		$result = $sql->execute();

		if ($result == 0) {
			throw new Exception("Falha ao alterar publicação");

			return false;
		}

		return true;
	}

	public static function delete($id)
	{
		$con = Connection::getConn();

		$sql = $con->prepare("DELETE from product WHERE id_product = :id");
		$sql->bindValue(':id', $id);
		$result = $sql->execute();

		if ($result == 0) {
			throw new Exception("Falha ao deletar publicação");

			return false;
		}

		return true;
	}
}
