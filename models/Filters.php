<?php

class Filters extends model
{
	public function getFilters($filters)
	{
		$products = new Products();
		$brands = new Brands();

		$array = [
			'brands' => [],
			'slider0' => 0,
			'slider1' => 0,
		 	'maxValue' => 1000,
		 	'stars' => [
		 			'0' => 0,
		 			'1' => 0,
		 			'2' => 0,
		 			'3' => 0,
		 			'4' => 0,
		 			'5' => 0
		 		],
		 	'sale' => 0, 
		 	'options' => []];

		$array['brands'] = $brands->getList();
		$brand_products = $products->getListOfBrands($filters);

		// Criando filtro de marcas
		foreach($array['brands'] as $bkey => $bitem) {
			$array['brands'][$bkey]['count'] = '0';
			foreach($brand_products as $bproduct) {
				if($bproduct['id_brand'] == $bitem['id']) {
					$array['brands'][$bkey]['count'] = $bproduct['c'];
				}
			}
			if($array['brands'][$bkey]['count'] == '0'){
				unset($array['brands'][$bkey]);
			}
		}

		// Estabelecendo o maior preço
		if(isset($filters['slider0'])){
			$array['slider0'] = $filters['slider0'];
		}
		if(isset($filters['slider1'])){
			$array['slider1'] = $filters['slider1'];
		}

		$array['maxValue'] = $products->getMaxtPrice($filters);
		if($array['slider1'] == 0){
			$array['slider1'] = $array['maxValue'];
		}

		// Criando filtro das estrelas
		$star_products = $products->getListOfStars($filters); 
		foreach($array['stars'] as $skey => $sitem) {
			foreach ($star_products as $sproduct) {
				if($sproduct['rating'] == $skey){
					$array['stars'][$skey] = $sproduct['c'];
				}
			}
		}

		// Criando filtro das promoções
		$array['sale'] = $products->getSaleCount($filters);

		// Criando filtros das opções
		$array['options'] = $products->getAvailableOptions($filters);

		return $array;
	}
}