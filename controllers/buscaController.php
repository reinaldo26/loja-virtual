<?php
class buscaController extends controller 
{
  private $user;

    public function __construct() 
    {
        parent::__construct();
    }

    public function index() 
    {
        $store = new Store();
        $products = new Products();
        $categories = new Categories();

        $dados = $store->getTemlateData();
        
        if (!empty($_GET['s'])) {
            $searchTerm = $_GET['s']; 
            //$category = $_GET['category'];
        
            $f = new Filters();
            $filters = [];

            if(!empty($_GET['filter']) && is_array($_GET['filter'])){
                $filters = $_GET['filter'];
            }

            $filters['searchTerm'] = $searchTerm;
            //$filters['category'] = $category;

            $currentPage = 1;
            $offset = 0;
            $limit = 3;

            if(!empty($_GET['page'])){
                $currentPage = $_GET['page'];
            }

            $offset = ($currentPage * $limit) - $limit;
            $dados['filters'] = $f->getFilters($filters);
            $dados['sidebar'] = true;
            $dados['list'] = $products->getList($offset, $limit, $filters);
            $dados['totalItens'] = $products->getTotal($filters);
            $dados['numberPages'] = ceil(($dados['totalItens'] / $limit));
            $dados['currentPage'] = $currentPage;

            $dados['filters_selected'] = $filters;
            $dados['searchTerm'] = $searchTerm;
            //$dados['category'] = $category;

            $this->loadTemplate('busca', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }
}
