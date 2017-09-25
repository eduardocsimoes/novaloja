<?php 
	class buscaController extends controller {

		private $user;

	    public function __construct() {
	        parent::__construct();
	    }

	    public function index() {

	    	$store = new Store();

	        $products = new Products();
	        $categories = new categories();
	        $filters = new Filters();

	        $dados = $store->getTemplateData();

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

		        $dados['filters'] = $filters->getFilters($filter);
		        $dados['filters_selected'] = $filter;

		        $dados['searchTerm'] = $searchTerm;
		        $dados['category'] = $category;

		        $dados['sidebar'] = true;

		        $this->loadTemplate('busca', $dados);
		    }else{
		    	header("Location: ".BASE_URL);
		    }
	    }
	}
?>