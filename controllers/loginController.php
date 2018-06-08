<?php

class loginController extends controller 
{
    public function __construct() 
    {
        parent::__construct();
    }

    public function index() 
    {
        if(!isset($_SESSION['user'])){
            $this->loadView('login');
        } else {
            echo $_SESSION['user'];
            header("Location: ".BASE_URL);
            exit;
        }
    }

    public function signIn()
    {
        $dados = [];

        $email = $_POST['email'];
        $password = $_POST['password'];

        $users = new users();

        $user = $users->login($email);

        if(!empty($user)){
            $_SESSION['user'] = $user['id'];
            header("Location: ".BASE_URL);
            exit;
        } else {
            header("Location: ".BASE_URL."?error");
        }
    }
        

    public function register()
    {
        $nome = addslashes($_POST['nome']);
        $cpf = addslashes($_POST['cpf']);
        $email = addslashes($_POST['email']);
        $password = addslashes($_POST['password']);
        $password = md5($password);
        $cep = addslashes($_POST['cep']);
        $cidade = addslashes($_POST['cidade']);
        $bairro = addslashes($_POST['bairro']);
        $rua = addslashes($_POST['rua']);
        $numero = addslashes($_POST['numero']);
        $complemento = addslashes($_POST['complemento']);
        $estado = addslashes($_POST['estado']);
      
        $users = new Users();

        $up = $users->save($nome, $cpf, $email, $password, $cep, $cidade, $estado, $bairro, $rua, $numero, $complemento);

        if($up){
            header("Location: ".BASE_URL);
        } else {
            echo "<script>alert('E-mail já cadastrado.');</script>";//
        }  
    }
}
