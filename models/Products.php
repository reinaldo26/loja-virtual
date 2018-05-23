<?php

class Products extends model
{
	public function getTotal($filters = [])
	{
		$where = $this->buildWhere($filters);
		$stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM products WHERE ".implode(' AND ', $where));
		$this->bindWhere($filters, $stmt);

		$stmt->execute();
		$total = $stmt->fetch();
		return $total['total'];
	}

	public function getList($offset = 0, $limit = 3, $filters = [], $random = false)
	{
		$array = [];
		$orderBySQL = '';
		if($random == true){
			$orderBySQL = "ORDER BY RAND()";
		}
		if(!empty($filters['toprated'])){
			$orderBySQL = "ORDER BY rating DESC";
		}
		$where = $this->buildWhere($filters);

		$stmt = $this->conn->prepare("SELECT *, 
		(select brands.name from brands where brands.id = products.id_brand) 
		as brand_name, 
		(select categories.name from categories where categories.id = products.id_category) 
		as category_name FROM products WHERE ".implode(' AND ', $where)." ".$orderBySQL." LIMIT $offset, $limit"); 
		
		$this->bindWhere($filters, $stmt);

		$stmt->execute();

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

	public function getListOfBrands($filters = [])
	{
		$array = [];
		$where = $this->buildWhere($filters);
		$stmt = $this->conn->prepare("SELECT id_brand, COUNT(id) as c FROM products WHERE ".implode(' AND ', $where)." GROUP BY id_brand");

		$this->bindWhere($filters, $stmt);

		$stmt->execute();
		if($stmt->rowCount() > 0){
			$array = $stmt->fetchAll();
		}

		return $array;
	}

	public function getListOfStars($filters = [])
	{
		$array = [];
		$where = $this->buildWhere($filters);
		$stmt = $this->conn->prepare("SELECT rating, COUNT(id) as c FROM products WHERE ".implode(' AND ', $where)." GROUP BY rating");

		$this->bindWhere($filters, $stmt);

		$stmt->execute();
		if($stmt->rowCount() > 0){
			$array = $stmt->fetchAll();
		}

		return $array;
	}

	private function buildWhere($filters)
	{
		$where = ['1=1'];
		if(!empty($filters['category'])){
			$where[] = "id_category = :ID_CATEGORY";
		}
		if(!empty($filters['brand'])){
			$where[] = "id_brand IN ('".implode("','", $filters['brand'])."')";
		}
		if(!empty($filters['star'])){
			$where[] = "rating IN ('".implode("','", $filters['star'])."')";
		}
		if(!empty($filters['sale'])){
			$where[] = "sale = '1'";
		}
		if(!empty($filters['featured'])){
			$where[] = "featured = '1'";
		}

		if(!empty($filters['options'])){
			$where[] = "id IN (select id_product from products_options where products_options.p_value IN ('".implode("','", $filters['options'])."'))";
		}

		if(!empty($filters['slider0'])){
			$where[] = "price >= :SLIDER0";
		}
		if(!empty($filters['slider1'])){
			$where[] = "price <= :SLIDER1";
		}
		if(!empty($filters['searchTerm'])){
			$where[] = "name LIKE :SEARCHTERM";
		}

		return $where;
	}

	private function bindWhere($filters, &$stmt)
	{
		if(!empty($filters['category'])){
			$stmt->bindParam(":ID_CATEGORY", $filters['category']);
		}

		if(!empty($filters['slider0'])){
			$stmt->bindParam(":SLIDER0", $filters['slider0']);
		}
		if(!empty($filters['slider1'])){
			$stmt->bindParam(":SLIDER1", $filters['slider1']);
		}
		if(!empty($filters['searchTerm'])){
			$stmt->bindValue(":SEARCHTERM", '%'.$filters['searchTerm'].'%');
		}
	}

	public function getMaxtPrice($filters = [])
	{
		$stmt = $this->conn->prepare("SELECT price FROM products ORDER BY price DESC LIMIT 1");
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$stmt = $stmt->fetch();
			return $stmt['price'];
		} else {
			return '0';
		}
	}

	public function getSaleCount($filters)
	{
		$where = $this->buildWhere($filters);
		$where[] = 'sale = "1"';

		$stmt = $this->conn->prepare("SELECT COUNT(*) as c FROM products WHERE ".implode(' AND ', $where));

		$this->bindWhere($filters, $stmt);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$stmt = $stmt->fetch();
			return $stmt['c'];
		} else {
			return '0';
		}
	}

	public function getAvailableOptions($filters = [])
	{
		$groups = [];
		$ids = [];
		$where = $this->buildWhere($filters);
		$stmt = $this->conn->prepare("SELECT id, options FROM products WHERE ".implode(' AND ', $where));
		$this->bindWhere($filters, $stmt);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			foreach ($stmt->fetchAll() as $product) {
				$ops = explode(",", $product['options']);
				$ids[] = $product['id'];
				foreach ($ops as $op) {
					if(!in_array($op, $groups)){
						$groups[] = $op;
					}
				}
			}
		}
		$options = $this->getAvailableValuesFromOptions($groups, $ids);
		return $options;
	}

	public function getAvailableValuesFromOptions($groups, $ids)
	{
		$array = [];
		$options = new Options();

		foreach ($groups as $op) {
			$array[$op] = [
				'name' => $options->getName($op),
				'options' => []
			];
		}
		$stmt =  $this->conn->prepare("SELECT p_value, id_option, COUNT(id_option) as c FROM products_options WHERE id_option IN ('".implode(',', $groups)."') AND id_product IN ('".implode(',', $ids)."') GROUP BY p_value ORDER BY id_option");
		$stmt->execute();
		if($stmt->rowCount() > 0){
			foreach($stmt->fetchAll() as $ops) {
			 $array[$ops['id_option']]['options'][] = ['id' => $ops['id_option'], 'value' => $ops['p_value'], 'count' => $ops['c']];
			}
		}
		return $array;
	}

	public function getProductInfo($id)
	{
		$array = [];

		if(!empty($id)){
			$stmt = $this->conn->prepare("SELECT *, (select brands.name from brands where brands.id = 
				products.id_brand) as brand_name FROM products WHERE id = :ID");
			$stmt->bindParam(":ID", $id);
			$stmt->execute();
			if($stmt->rowCount() > 0){
				$array = $stmt->fetch();
			}
		}

		return $array;
	}

	public function getOptionsByProductId($id)
	{
		$options = [];
		// pegando os nomes das opções
		$stmt = $this->conn->prepare("SELECT options FROM products WHERE id = :ID");
		$stmt->bindParam(":ID", $id);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$options = $stmt->fetch();
			$options = $options['options'];

			if(!empty($options)){
				$stmt = $this->conn->prepare("SELECT * FROM options WHERE id IN ($options)");
				$stmt->execute();
				$options = $stmt->fetchAll();
			}	

			// pegando os valores das opções
			$stmt = $this->conn->prepare("SELECT * FROM products_options WHERE id_product = :ID");
			$stmt->bindParam(":ID", $id);
			$stmt->execute();
			
			$options_values = [];
			if($stmt->rowCount() > 0){
				foreach($stmt->fetchAll() as $op) {
					$options_values[$op['id_option']] = $op['p_value'];
				}
			}

			// Juntar os nomes das opções com os valores no array
			if(!empty($options)){
				foreach ($options as $ok => $op) {
				if(isset($options_values[$op['id']])){
					$options[$ok]['value'] = $options_values[$op['id']];
				} else {
					$options[$ok]['value'] = '';
				}	
			  }
			}	
		}

		return $options;
	}

	public function getRates($id, $qt)
	{
		$array = [];
		$rates = new Rates();
		$array = $rates->getRates($id, $qt);
		return $array;
	}
}