<?php
class homeController extends controller 
{
	private $user;

    public function __construct() 
    {
        parent::__construct();
    }

    public function index() 
    {
        $dados = array();
        
        $products = new Products();

        $currentPage = 1;
        $offset = 0;
        $limit = 3;

        if(!empty($_GET['page'])){
            $currentPage = $_GET['page'];
        }

        $offset = ($currentPage * $limit) - $limit; // (2 * 3) - 3 = 3

        $dados['list'] = $products->getList($offset, $limit);
        $dados['totalItens'] = $products->getTotal();
        $dados['numberPages'] = ceil(($dados['totalItens'] / $limit));
        $dados['currentPage'] = $currentPage;

        $this->loadTemplate('home', $dados);
    }
}