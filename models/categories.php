<?php 
	class Categories extends model{

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
	}
 ?>