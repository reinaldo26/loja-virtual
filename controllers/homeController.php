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
        $categories = new Categories();
        $f = new Filters();
        $filters = [];
        if(!empty($_GET['filter']) && is_array($_GET['filter'])){
            $filters = $_GET['filter'];
        }

        $currentPage = 1;
        $offset = 0;
        $limit = 3;

        if(!empty($_GET['page'])){
            $currentPage = $_GET['page'];
        }

        $offset = ($currentPage * $limit) - $limit;
        $dados['filters'] = $f->getFilters($filters);
        $dados['list'] = $products->getList($offset, $limit, $filters);
        $dados['totalItens'] = $products->getTotal($filters);
        $dados['numberPages'] = ceil(($dados['totalItens'] / $limit));
        $dados['currentPage'] = $currentPage;
        $dados['categories'] = $categories->getList();
        $dados['filters_selected'] = $filters;

        $this->loadTemplate('home', $dados);
    }
}
