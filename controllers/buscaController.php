<?php 
	class buscaController extends controller {

		private $user;

	    public function __construct() {
	        parent::__construct();
	    }

	    public function index() {
	        $dados = array();

	        $products = new Products();
	        $categories = new categories();
	        $filters = new Filters();

	        if(!empty($_GET['s'])){
	        	$searchTerm = $_GET['s'];
	        	$category = $_GET['category'];

		        $filter = array();
		        if(!empty($_GET['filter']) && is_array($_GET['filter'])){
		            $filter = $_GET['filter'];
		        }

		        $filter['searchTerm'] = $searchTerm;
		        $filter['category'] = $category;

		        $currentPage = 1;
		        $offset = 0;
		        $limit = 3;

		        if(!empty($_GET['p'])){
		            $currentPage = $_GET['p'];
		        }

		        $offset = ($currentPage * $limit) - $limit;

		        $dados['list'] = $products->getList($offset, $limit, $filter);
		        $dados['totalItems'] = $products->getTotal($filter);
		        $dados['numberOfPages'] = ceil($dados['totalItems'] / $limit);
		        $dados['currentPage'] = $currentPage;

		        $dados['categories'] = $categories->getList();
		        $dados['filters'] = $filters->getFilters($filter);
		        $dados['filters_selected'] = $filter;

		        $dados['searchTerm'] = $searchTerm;
		        $dados['category'] = $category;

		        $this->loadTemplate('busca', $dados);
		    }else{
		    	header("Location: ".BASE_URL);
		    }
	    }
	}
?>