<?php

class Products extends model
{
	public function getTotal()
	{
		$stmt = $this->conn->query("SELECT COUNT(*) as total FROM products");
		$total = $stmt->fetch();
		return $total['total'];
	}

	public function getList($offset = 0, $limit = 3)
	{
		$array = [];
		$stmt = $this->conn->query("SELECT *, 
		(select brands.name from brands where brands.id = products.id_brand) 
		as brand_name, 
		(select categories.name from categories where categories.id = products.id_category) 
		as category_name FROM products LIMIT $offset, $limit"); 

		if($stmt->rowCount() > 0){
			$array = $stmt->fetchAll();
			foreach ($array as $key => $item) {
				$array[$key]['images'] = $this->getImagesByProductId($item['id']);
			}
		}
		return $array;
	}

	public function getImagesByProductId($id)
	{
		$array = [];
		$stmt = $this->conn->prepare("SELECT url FROM products_images WHERE id_product = :ID");
		$stmt->bindParam(":ID", $id);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$array = $stmt->fetchAll();
		}
		return $array;
	}
}