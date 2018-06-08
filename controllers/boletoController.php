<?php
class boletoController extends controller 
{
    public function __construct() 
    {
        parent::__construct();
    }

    public function index() 
    {
        $store = new Store();
        $users = new Users();
        $cart = new Cart();
        $purchases = new Purchases();

        $dados = $store->getTemplateData();
        $dados['error'] = '';
        
        if(!empty($_POST['name'])) {

           /* $name = addslashes($_POST['name']);
            $cpf = addslashes($_POST['cpf']);
            $telefone = addslashes($_POST['telefone']);
            $email = addslashes($_POST['email']);
            $pass = addslashes($_POST['pass']);
            $cep = addslashes($_POST['cep']);
            $rua = addslashes($_POST['rua']);
            $numero = addslashes($_POST['numero']);
            $complemento = addslashes($_POST['complemento']);
            $bairro = addslashes($_POST['bairro']);
            $cidade = addslashes($_POST['cidade']);
            $estado = addslashes($_POST['estado']); */

          
            //$config['clientId'] = 'Client_Id_f3b421924e11e05f0c730f92ee1d765cd02090e3';
            //$config['clientSecret'] = 'Client_Secret_a4cf0b1259b302cb4a103bc21fe4eb3b6ca97834';

            if(!empty($_SESSION['cart'])) {

                $list = $cart->getList();
                $frete = 0;
                $total = 0;

                foreach($list as $item) {
                    $total += (floatval($item['price']) * intval($item['qt']));
                }

                if(!empty($_SESSION['shipping'])) {
                    $shipping = $_SESSION['shipping'];

                    if(isset($shipping['price'])) {
                        $frete = floatval(str_replace(',', '.', $shipping['price']));
                    } else {
                        $frete = 0;
                    }

                    $total += $frete;
                }

                $id_purchase = $purchases->createPurchase($_SESSION['user'], $total, 'boleto');

                foreach($list as $item) {
                    $purchases->addItem($id_purchase, $item['id'], $item['qt'], $item['price']);
                }


                global $config;
                $options = [$config['clientId'], $config['clientSecret'], 'sandbox' => true];

                $metadata = [
                    'custom_id' => $id_purchase, 
                    'notification_url' => BASE_URL.'boleto/notification'
                ];

                $items = [];
                foreach($list as $item){
                    $item[] = [
                        'name' => $item['name'], 
                        'amount' => $item['qt'], 
                        'value' => ($item['price'] * 100)
                    ];
                }

                $shipping = [
                    'name' => 'FRETE',
                    'value' => ($frete * 100)
                ];

                $body = [
                    'metadata' => $metadata,
                    'items' => $items,
                    'shippings' => $shipping 
                ];

                try{
                    $api = new \Gerencianet\Gerencianet($options);
                    $charge = $api->createCharge([], $body);
                    if($charge['code'] == 200){
                        $charge_id = $charge['data']['charge_id'];
                        $params = ['id' => $charge_id];
                        $customer = [
                            'name' => $name,
                            'cpf' => $cpf,
                            'phone_number' => $telefone
                        ];

                        $bankingBillet = [
                            'expire_at' => date('Y-m-d', strtotime('+4 days')),
                            'customer' => $customer,
                            'message' => 'Pague seu boleto'
                        ];

                        $payment = ['banking_billet'=> $bankingBillet];

                        $body = ['payment' => $payment];

                        try {
                            $charge = $api->payCharge($params, $body);
                            if($charge['code'] == '200'){
                                $link = $charge['data']['link'];
                                $purchases->updateBilletUrl($id_purchase, $link);
                                unset($_SESSION['cart']);
                                header("Location: ".$link);
                                exit;
                            }
                        } catch (Exception $e) {
                            echo "ERRO: ".$e->getMessage();
                            exit;
                        }
                    }
                }catch(Exteption $e){
                    echo "ERRO: ".$e->getMessage();
                    exit;
                }
            }
        }

        $this->loadTemplate('cart_boleto', $dados);
    }

    public function notification()
    {

    }

}