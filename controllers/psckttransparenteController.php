<?php
    class pscktTransparenteController extends controller {

        public function __construct() {
            parent::__construct();
        }

       public function index() {

            $store = new Store();

            $products = new Products();

            $dados = $store->getTemplateData();

            try{
                $sessionCode = \PagSeguro\Services\Session::create(
                    \PagSeguro\Configuration\Configure::getAccountCredentials()
                );

                $dados['sessionCode'] = $sessionCode->getResult();
            }catch(Exception $e){
                echo "ERRO: ".$e->getMessage();
                exit;
            }

            $this->loadTemplate('cart_psckttransparente', $dados);
        }        
    }
?>