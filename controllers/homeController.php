<?php
    class homeController extends controller {

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

            $filter = array();
            if(!empty($_GET['filter']) && is_array($_GET['filter'])){
                $filter = $_GET['filter'];
            }

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

            $dados['searchTerm'] = '';
            $dados['category'] = '';      

            $dados['sidebar'] = true;

            $this->loadTemplate('home', $dados);
        }
    }