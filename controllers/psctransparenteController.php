<?php

class psctransparenteController extends controller 
{
    public function __construct() 
    {
        parent::__construct();
    }

    public function index()
    { 
        if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
            $store = new Store();
            $products = new Products();
            $dados = $store->getTemplateData();

            try{
                $sessionCode = \PagSeguro\Services\Session::create(\PagSeguro\Configuration\Configure::getAccountCredentials());

                $dados['sessionCode'] = $sessionCode->getResult();

            }catch(Exception $e){
                echo "ERRO: ".$e->getMessage();
                exit;
            }

            $this->loadTemplate('cart_psctransparente', $dados);

        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function checkout()
    {   
        if(!empty($_SESSION['user'])){
            $id_usuario = $_SESSION['user'];
        } else {
            header("Location: ".BASE_URL);
        }

     
        
     
        /*
        $cartao_token = addslashes($_POST['cartao_token']);
        $id_compra = addslashes($_POST['id_compra']); // hash
        $nome = addslashes($_POST['nome']);
        $cpf = addslashes($_POST['cpf']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['pass']);
        $cep = addslashes($_POST['cep']);
        $rua = addslashes($_POST['rua']);
        $numero = addslashes($_POST['numero']);
        $complemento = addslashes($_POST['complemento']);
        $bairro = addslashes($_POST['bairro']);
        $cidade = addslashes($_POST['cidade']);
        $estado = addslashes($_POST['estado']);
        $cartao_numero = addslashes($_POST['cartao_numero']);
        $titular = addslashes($_POST['titular']);
        $cartao_cpf = addslashes($_POST['cartao_cpf']);
        $cvv = addslashes($_POST['cvv']);
        $v_mes = addslashes($_POST['v_mes']);
        $v_ano = addslashes($_POST['v_ano']);
        $parcelas = explode(';', $_POST['parc']);*/

        $cartao_token = addslashes($_GET['1']);
        $id_compra = addslashes($_GET['2']);
        $nome = addslashes($_GET['3']);
        $cpf = addslashes($_GET['4']);
        $telefone = addslashes($_GET['5']);
        $email = addslashes($_GET['6']);
        $senha = addslashes($_GET['7']);
        $cep = addslashes($_GET['8']);
        $rua = addslashes($_GET['9']);
        $numero = addslashes($_GET['10']);
        $complemento = addslashes($_GET['11']);
        $bairro = addslashes($_GET['12']);
        $cidade = addslashes($_GET['13']);
        $estado = addslashes($_GET['14']);
        $cartao_numero = addslashes($_GET['15']);
        $titular = addslashes($_GET['16']);
        $cartao_cpf = addslashes($_GET['17']);
        $cvv = addslashes($_GET['18']);
        $v_mes = addslashes($_GET['19']);
        $v_ano = addslashes($_GET['20']);
        $parcelas = addslashes($_GET['21']);


        $cart = new Cart();
        $purchase = new Purchases();
        $list = $cart->getList();
        $total = 0;

        foreach($list as $item){
            $total += (floatval($item['price']) * intval($item['qt']));
        }

        if(!empty($_SESSION['shipping'])){
            $shipping = $_SESSION['shipping'];
            if(isset($shipping['price'])){
                $frete = floatval(str_replace(',', '.', $shipping['price']));
            } else {
                $frete = 0;
            }

            $total += $frete;
        }

        $id_compra = $purchase->createPurchases($id_usuario, $total, 'psctransparente');
        foreach($list as $item){
            $purchase->addItem($id_compra, $item['id'], $item['qt'], $item['price']);
        }

        global $config;
        //$creditCard = new \PagSeguro\Domains\Request\DirectPayment\bilhet;
        $creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();
        $creditCard->setReceiverEmail($config['PagSeguro']);
        $creditCard->setReference($id_compra);
        $creditCard->setCurrency("BRL");

        foreach($list as $item){
            $creditCard->addItems()->withParameters($item['id'], $item['name'], intval($item['qt']), floatval($item['price']));
        }

        $creditCard->setSender()->setName($nome);
        $creditCard->setSender()->setEmail($email);
        $creditCard->setSender()->setDocument()->withParameters('CPF', $cpf);
        $ddd = substr($telefone, 0, 2);
        $telefone = substr($telefone, 2);
        $creditCard->setSender()->setPhone()->withParameters($ddd, $telefone);
        $creditCard->setSender()->setHash($id_compra);
        $ip = $_SERVER['REMOTE_ADDR'];
        if(strlen($ip) < 9){
            $ip = '127.0.0.1';
        }
        $creditCard->setSender()->setIp($ip);
        $creditCard->setShipping()->setAddress()->withParameters($rua, $numero, $bairro, $cep, $cidade, $estado, 'BRA', $complemento);
        $creditCard->setBilling()->setAddress()->withParameters($rua, $numero, $bairro, $cep, $cidade, $estado, 'BRA', $complemento);

        $creditCard->setToken($cartao_token);
        $creditCard->setInstallment()->withParameters($parcelas[0], $parcelas[1]/*, $parcelas[2]*/);
        $creditCard->setHolder()->setName($titular);
        $creditCard->setHolder()->setDocument()->withParameters('CPF', $cpf);

        $creditCard->setMode('DEFAULT');

        try{
            $result = $creditCard->register(\PagSeguro\Configuration\Configure::getAccountCredentials());
            echo json_encode($result);
            exit;
        }catch(Exception $e){
            echo json_encode(['error' => true, 'msg' => $e->getMessage()]);
            //echo "ERROR:  ".$e->getMessage();
            exit;
        }
    }

    public function cheked()
    {
        $store = new Store();
        $dados = $store->getTemplateData();
        $this->loadTemplate("", $dados);
    }
}
