<?php 
	class Brands extends model{

		public function getNameById($id_brand){

			$data['name'] = '';

			$sql = "SELECT name FROM brands WHERE id = :id_brand";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_brand", $id_brand);
			$sql->execute();

			if($sql->rowCount() > 0){
				$data = $sql->fetch();
			}

			return $data['name'];
		}
	}
 ?>