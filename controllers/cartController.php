<?php
class cartController extends controller 
{
    public function __construct() 
    {
        parent::__construct();
    }

    public function index()
    {
        $store = new Store();
        $products = new Products();
        $cart = new Cart();
        $cep = '';
        $shipping = [];

        if(!empty($_POST['cep'])){
            $cep_user = intval($_POST['cep']);
            $shipping = $cart->shippingCalculate($cep_user);
            $_SESSION['shipping'] = $shipping;
        }

        if(!empty($_SESSION['shipping'])){
            $shipping = $_SESSION['shipping'];
        }

        if(!isset($_SESSION['cart']) || (isset($_SESSION['cart']) && count($_SESSION['cart']) == 0)){
            header("Location: ".BASE_URL);
            exit;
        }

        $dados = $store->getTemplateData(); 
        $dados['list'] = $cart->getList();
        $dados['shipping'] = $shipping;

        $this->loadTemplate('cart', $dados);
    }

    public function add()
    {
        if(!empty($_POST['id_product'])){
            $id = intval($_POST['id_product']);
            $qt = intval($_POST['qt_product']);
           
            if(!isset($_SESSION['cart'])){
                $_SESSION['cart'] = [];
            }
            if(isset($_SESSION['cart'][$id])){
                $_SESSION['cart'][$id] += $qt;
            } else {
                $_SESSION['cart'][$id] = $qt;
            }
        }

        header("Location: ".BASE_URL."cart");
        exit;
    }

    public function sub($id)
    {
        if(isset($_SESSION['cart'][$id]) && $_SESSION['cart'][$id] != 0){
            echo $_SESSION['cart'][$id]--;
            header("Location: ".BASE_URL."cart");
            exit;
        } else {
            header("Location: ".BASE_URL."cart");
        }
    }

    public function inc($id)
    {
        echo $_SESSION['cart'][$id]++;
        header("Location: ".BASE_URL."cart");
        exit;
    }

    public function del($id)
    {
        if(!empty($id)){
            unset($_SESSION['cart'][$id]);
        }
        header("Location: ".BASE_URL."cart");
    }

    public function payment_redirect()
    {
        if(!empty($_POST['payment_type'])){
            
            $payment_type = $_POST['payment_type'];
            switch ($payment_type) {
                case 'checkout_transparente':
                    header("Location: ".BASE_URL."psctransparente");
                    exit;
                    break;

                case 'boleto':
                    header("Location: ".BASE_URL."boleto");
                    exit;
                    break;

                case 'paypal':
                    header("Location: ".BASE_URL."paypal");
                    exit;
                    break;
            }
        } 
            
        header("Location: "."cart");
        exit;
    }
}
