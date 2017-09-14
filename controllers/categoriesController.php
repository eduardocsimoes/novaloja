<?php
class categoriesController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();
    }

    public function index() {

    	header("Location: ".BASE_URL);
    }

    public function enter($id_category){

    	$dados = array();

    	$categories = new Categories();
    	$products = new Products();

    	$dados['categories'] = $categories->getList();
    	$dados['category_name'] = $categories->getCategoryName($id_category);

    	if(!empty($dados['category_name'])){
	        $currentPage = 1;
	        $offset = 0;
	        $limit = 3;

	        if(!empty($_GET['p'])){
	            $currentPage = $_GET['p'];
	        }

	        $offset = ($currentPage * $limit) - $limit;

	        $filters = array('category'=>$id_category);

			$dados['list'] = $products->getList($offset, $limit, $filters);
	        $dados['totalItems'] = $products->getTotal($filters);
	        $dados['numberOfPages'] = ceil($dados['totalItems'] / $limit);
	        $dados['currentPage'] = $currentPage;

	        $dados['id_category'] = $id_category;        

			$dados['category_filter'] = $categories->getCategoryTree($id_category);

			$dados['categories'] = $categories->getList();

			$this->loadTemplate('categories', $dados);
		}else{
			header("Location: ".BASE_URL);
		}

    	$this->loadTemplate('categories', $dados);
    }

}