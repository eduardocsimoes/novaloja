<?php 
	class Categories extends model{

		public function getList(){

			$array = array();

			$sql = "SELECT * FROM categories ORDER BY sub DESC";
			$sql = $this->db->prepare($sql);
			$sql->execute();

			if($sql->rowCount() > 0){
				foreach($sql->fetchAll() as $item){
					$item['subs'] = array();
					$array[$item['id']] = $item;
				}

				while($this->stillNeed($array)){
					$this->organizeCategory($array);
				}
			}

			return $array;
		}

		private function organizeCategory(&$array){
			foreach($array as $id => $item){
				if(isset($array[$item['sub']])){
					$array[$item['sub']]['subs'][$item['id']] = $item;
					unset($array[$id]);
					break;
				}
			}
		}

		private function stillNeed($array){

			foreach($array as $item){
				if(!empty($item['sub'])){
					return true;
				}
			}

			return false;
		}

		public function getNameById($id_category){

			$data['name'] = '';

			$sql = "SELECT name FROM categories WHERE id = :id_category";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_category", $id_category);
			$sql->execute();

			if($sql->rowCount() > 0){
				$data = $sql->fetch();
			}

			return $data['name'];
		}

		public function getCategoryTree($id_category){

			$array = array();

			$haveChild = true;

			while($haveChild){
				$sql = "SELECT * FROM categories WHERE id = :id";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(":id", $id_category);
				$sql->execute();

				if($sql->rowCount() > 0){
					$sql = $sql->fetch();
					$array[] = $sql;

					if(!empty($sql['sub'])){
						$id_category = $sql['sub'];
					}else{
						$haveChild = false;
					}
				}
			}

			$array = array_reverse($array);

			return $array;
		}

		public function getCategoryName($id_category){

			$sql = "SELECT name FROM categories WHERE id = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id", $id_category);
			$sql->execute();

			if($sql->rowCount() > 0){
				$sql = $sql->fetch();
				
				return $sql['name'];
			}			
		}
	}
 ?>