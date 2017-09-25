<?php 
	class Cart extends model{

		public function getList(){

			$products = new Products();

			$array = array();
			$cart = $_SESSION['cart'];

			foreach($cart as $id => $qt){

				$info = $products->getInfo($id);

				$array[] = array(
					'id' => $id,
					'name' => $info['name'],
					'qt' => $qt,
					'price' => $info['price'],
					'image' => $info['image']
				);
			}

			return $array;
		}

		public function getSubtotal(){

			$list = $this->getList();

			$subtotal = 0;

			foreach($list as $item){
				$subtotal += (floatval($item['price']) * intval($item['qt']));
			}

			return $subtotal;
		}
	}
 ?>