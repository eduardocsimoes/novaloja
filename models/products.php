<?php 
	class Products extends model{

		public function getList($offset = 0, $limit = 3, $filters = array()){

			$array = array();

			$where = array(
				'1=1'
			);

			if(!empty($filters['category'])){
				$where[] = "id_category = :id_category";
			}

			$sql = "SELECT 
							* 
					FROM 
							products 
					WHERE	
							".implode(' AND ', $where)." 
					LIMIT 
							$offset, $limit";
			$sql = $this->db->prepare($sql);

			if(!empty($filters['category'])){
				$sql->bindValue("id_category", $filters['category']);
			}
			
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

		public function getListOfBrands(){

			$array = array();

			$sql = "SELECT id_brand, count(*) as c FROM products GROUP BY id_brand";
			$sql = $this->db->prepare($sql);
			$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetchAll();
			}

			return $array;			
		}

		public function getImagesByProductId($id_produto){

			$array = array();

			$sql = "SELECT url FROM products_images WHERE id_product = :id_produto";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_produto", $id_produto);
			$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetchAll();
			}

			return $array;
		}

		public function getTotal($filters = array()){

			$where = array(
				'1=1'
			);

			if(!empty($filters['category'])){
				$where[] = "id_category = :id_category";
			}

			$sql = "SELECT 
							COUNT(*) as quantidade 
					FROM 
							products
					WHERE 
							".implode(' AND ', $where);
			$sql = $this->db->prepare($sql);

			if(!empty($filters['category'])){
				$sql->bindValue("id_category", $filters['category']);
			}

			$sql->execute();
			$sql = $sql->fetch();

			return $sql['quantidade'];
		}
	}
 ?>