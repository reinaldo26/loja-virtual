<?php
class homeController extends controller 
{
    public function __construct() 
    {
        parent::__construct();
    }

    public function index() 
    {
        $store = new Store();
        $products = new Products();
        $categories = new Categories();
        $users = new Users();
        $f = new Filters();
        
        $dados = $store->getTemplateData();
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
        
        $dados['filters_selected'] = $filters;
        $dados['sidebar'] = true;

        $this->loadTemplate('home', $dados);
    }
}
