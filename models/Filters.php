<?php 
	class Filters extends model{

		public function getFilters(){

			$brands = new Brands();
			$products = new Products();

			$array = array(
				'brands' => array(),
				'maxslider' => 1000,
				'stars' => array(),
				'sale' => false,
				'option' => array()
			);	

			$array['brands'] = $brands->getList();
			$brand_products = $products->getListOfBrands();

			foreach ($array['brands'] as $bkey => $bitem) {
				$array['brands'][$bkey]['count'] = '0';

				foreach($brand_products as $bproduct){
					if($bproduct['id_brand'] == $bitem['id']){
						$array['brands'][$bkey]['count'] = $bproduct['c'];
					}
				}

				if($array['brands']['$bkey']['count'] == '0'){
					unset($array['brands'][$bkey]);
				}
			}

			return $array;
		}
	}
?>