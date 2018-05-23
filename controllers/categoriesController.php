<?php
class categoriesController extends controller 
{
    public function __construct() 
    {
        parent::__construct();
    }

    public function index() 
    {
       header("Location: ".BASE_URL);
    }

    public function enter($id)
    {
        $store = new Store();
        $categories = new Categories();
        $products = new Products();
        $f = new Filters();

        $dados = $store->getTemplateData();
        $dados['category_name'] = $categories->getCategoryName($id);

        if(!empty($dados['category_name'])){
            $currentPage = 1;
            $offset = 0;
            $limit = 3;
            
            if(!empty($_GET['page'])){
                $currentPage = $_GET['page'];
            }
            $offset = ($currentPage * $limit) - $limit;
            $filters = ['category' => $id];
            $dados['category_filter'] = $categories->getCategoryTree($id);
            $dados['list'] = $products->getList($offset, $limit, $filters);
            $dados['totalItens'] = $products->getTotal($filters);
            $dados['numberPages'] = ceil(($dados['totalItens'] / $limit));
            $dados['currentPage'] = $currentPage;
            $dados['id_category'] = $id;

            $dados['filters'] = $f->getFilters();
            //$dados['filters_selected'] = $filters;
            $dados['sidebar'] = true;
            $this->loadTemplate('categories', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }
}
