<?php 
	class Products extends model{

		public function getList($offset = 0, $limit = 3){

			$array = array();

			$sql = "SELECT * FROM products LIMIT $offset, $limit";
			$sql = $this->db->prepare($sql);
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

		public function getTotal(){

			$sql = "SELECT COUNT(*) as quantidade FROM products";
			$sql = $this->db->prepare($sql);
			$sql->execute();
			$sql = $sql->fetch();

			return $sql['quantidade'];
		}
	}
 ?>