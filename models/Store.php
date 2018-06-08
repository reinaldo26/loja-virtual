<?php

class Store extends model
{
    public function getTemplateData()
	{      

	$dados = [];
    $users = new users();
	$products = new Products();
    $categories = new Categories();
    $cart = new Cart();

    if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
        $id = $_SESSION['user'];
        $dados['dataUser'] = $users->dataUserById($id);
    }

	$dados['categories'] = $categories->getList();
	$dados['widget_featured1'] = $products->getList(0, 5, ['featured' => '1'], true);
        $dados['widget_featured2'] = $products->getList(0, 3, ['featured' => '1'], true);
        $dados['widget_sale'] = $products->getList(0, 3, ['sale' => '1'], true);
        $dados['widget_toprated'] = $products->getList(0, 3, ['toprated' => '1']);
        
        if(isset($_SESSION['cart'])){
                $dados['cart_qt'] = count($_SESSION['cart']);
        } else {
        	$dados['cart_qt'] = 0;
        }

        $dados['cart_subtotal'] = $cart->getSubtotal();
        
        return $dados;
        }
}