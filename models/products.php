<?php 
	class Products extends model{

		public function getList($offset = 0, $limit = 3, $filters = array()){

			$array = array();

			$where = $this->buildWhere($filters);

			$sql = "SELECT 
							* 
					FROM 
							products 
					WHERE	
							".implode(' AND ', $where)." 
					LIMIT 
							$offset, $limit";
			$sql = $this->db->prepare($sql);

			$this->bindWhere($filters, $sql);
			
			$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetchAll();

				$brands = new Brands();
				$categories = new Categories();

				foreach($array as $key => $item){
					$array[$key]['brand_name'] = $brands->getNameById($item['id_brand']);
					$array[$key]['category_name'] = $categories->getNameById($item['id_category']);
					$array[$key]['images'] = $this->getImagesByProductId($item['id']);
				}
			}

			return $array;
		}

		public function getMaxPrice($filters = array()){

			$array = array();

			$sql = "SELECT 
							price 
					FROM 
							products 
					ORDER BY 
							price DESC
					LIMIT	
							1";
			$sql = $this->db->prepare($sql);

			$sql->execute();

			if($sql->rowCount() > 0){
				$sql = $sql->fetch();

				return $sql['price'];
			}else{
				return '0';
			}
		}

		public function getSaleCount($filters = array()){

			$array = array();

			$where = $this->buildWhere($filters);
			$where[] = "sale = 1";

			$sql = "SELECT 
							COUNT(*) as c
					FROM 
							products 
					WHERE 
							".implode(' AND ', $where);
			$sql = $this->db->prepare($sql);

			$this->bindWhere($filters, $sql);

			$sql->execute();

			if($sql->rowCount() > 0){
				$sql = $sql->fetch();

				return $sql['c'];
			}else{
				return '0';
			}			
		}

		public function getListOfBrands($filters = array()){

			$array = array();

			$where = $this->buildWhere($filters);

			$sql = "SELECT 
							id_brand, 
							count(*) as c 
					FROM 
							products 
					WHERE 
							".implode(' AND ', $where)."
					GROUP BY id_brand";
			$sql = $this->db->prepare($sql);

			$this->bindWhere($filters, $sql);

			$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetchAll();
			}

			return $array;			
		}

		public function getListOfStars($filters = array()){

			$array = array();

			$where = $this->buildWhere($filters);

			$sql = "SELECT 
							rating, 
							count(*) as c 
					FROM 
							products 
					WHERE 
							".implode(' AND ', $where)."
					GROUP BY rating";
			$sql = $this->db->prepare($sql);

			$this->bindWhere($filters, $sql);

			$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetchAll();
			}

			return $array;					
		}

		public function getAvailableOptions($filters = array()){

			$groups = array();
			$ids = array();

			$where = $this->buildWhere($filters);

			$sql = "SELECT 
							id,
							options 
					FROM 
							products 
					WHERE 
							".implode(' AND ', $where);

			$sql = $this->db->prepare($sql);

			$this->bindWhere($filters, $sql);

			$sql->execute();

			if($sql->rowCount() > 0){
				foreach($sql->fetchAll() as $product){
					$ids[] = $product['id'];
					$ops = explode(",", $product['options']);

					foreach($ops as $op){
						if(!in_array($op, $groups)){
							$groups[] = $op;
						}
					}
				}
			}

			$options = $this->getAvaliableValuesFromOptions($groups, $ids);

			return $options;
		}

		public function getAvaliableValuesFromOptions($groups, $ids){

			$array = array();
			$options = new Options();

			foreach($groups as $op){
				$array[$op] = array(
					'name' => $options->getName($op),
					'options' => array()
				);
			}

			$sql = "SELECT 
							p_value,
							id_option,
							COUNT(id_option) as c
					FROM 
							products_options
					WHERE 
							id_option IN ('".implode("','", $groups)."') AND 
							id_product IN ('".implode("','", $groups)."') 
					GROUP BY 
							p_value 
					ORDER BY 
							id_option";

			$sql = $this->db->query($sql);
			if($sql->rowCount() > 0){
				foreach($sql->fetchAll() as $ops){
					$array[$ops['id_option']]['options'][] = array('id' => $ops['id_option'], 'value' => $ops['p_value'], 'count' => $ops['c']);
				}
			}

			return $array;
		}

		public function getImagesByProductId($id_product){

			$array = array();

			$sql = "SELECT url FROM products_images WHERE id_product = :id_product";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_product", $id_product);
			$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetchAll();
			}

			return $array;
		}

		public function getTotal($filters = array()){

			$where = $this->buildWhere($filters);

			$sql = "SELECT 
							COUNT(*) as quantidade 
					FROM 
							products
					WHERE 
							".implode(' AND ', $where);
			$sql = $this->db->prepare($sql);

			$this->bindWhere($filters,$sql);

			$sql->execute();
			$sql = $sql->fetch();

			return $sql['quantidade'];
		}

		private function bindWhere($filters, &$sql){

			if(!empty($filters['category'])){
				$sql->bindValue(":id_category", $filters['category']);
			}

			if(!empty($filters['slider0'])){
				$sql->bindValue(":slider0", $filters['slider0']);
			}

			if(!empty($filters['slider1'])){
				$sql->bindValue(":slider1", $filters['slider1']);
			}
		}

		private function buildWhere($filters){

			$where = array(
				'1=1'
			);

			if(!empty($filters['category'])){
				$where[] = "id_category = :id_category";
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

			if(!empty($filters['options'])){
				$where[] = "id IN (SELECT id_product FROM products_options WHERE products_options.p_value IN ('".implode("','", $filters['options'])."'))";
			}

			if(!empty($filters['slider0'])){
				$where[] = "price >= :slider0";
			}

			if(!empty($filters['slider1'])){
				$where[] = "price <= :slider1";
			}

			return $where;
		}
	}
 ?>