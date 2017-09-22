<?php 
	class productController extends controller {

		private $user;

	    public function __construct() {
	        parent::__construct();
	    }

	    public function index() {
	        
	        header("Location: ".BASE_URL);
	    }

	    public function open($id){

	        $dados = array();

	        $products = new Products();
	        $categories = new categories();
	        $filters = new Filters();

	        $filter = array();

	        $info = $products->getProductInfo($id);

	        if(count($info) > 0){
	        	$dados['product_info'] = $info;
	        	$dados['product_images'] = $products->getImagesByProductId($id);

		        $dados['categories'] = $categories->getList();
		        $dados['filters'] = $filters->getFilters($filter);
		        $dados['filters_selected'] = $filter;

	            $dados['widget_featured1'] = $products->getList(0, 5, array('featured' => '1'), true);
	            $dados['widget_featured2'] = $products->getList(0, 3, array('featured' => '1'), true);
	            $dados['widget_sale'] = $products->getList(0, 3, array('sale' => '1'), true);
	            $dados['widget_toprated'] = $products->getList(0, 3, array('toprated' => '1'));

		        $this->loadTemplate('product', $dados);
		    }else{
		    	header("Location: ".BASE_URL);
		    }
	    }
	}
?>