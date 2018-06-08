<?php

class Users extends model
{
	public function login($email)
	{ 
		$data = [];
		$stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :EMAIL");
		$stmt->bindParam(":EMAIL", $email);
		//$stmt->bindParam(":PASSWORD", $password);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$data = $stmt->fetchAll();
			foreach ($data as $key => $item) {
				$data = $item;
			}
		}

		return $data;
	}

	public function save($nome, $cpf, $email, $password, $cep, $cidade, $estado, $bairro, $rua, $numero, $complemento = '-')
	{
		$stmt = $this->conn->prepare("INSERT INTO users(name, cpf, cep, email, password, cidade, estado, bairro, rua, numero, complemento) VALUES(:NOME, :CPF, :CEP, :EMAIL, :PASSWORD, :CIDADE, :ESTADO, :BAIRRO, :RUA, :NUMERO, :COMPLEMENTO)");
		$stmt->bindParam(":NOME", $nome);
		$stmt->bindParam(":CPF", $cpf);
		$stmt->bindParam(":CEP", $cep);
		$stmt->bindParam(":EMAIL", $email);
		$stmt->bindParam(":PASSWORD", $password);
		$stmt->bindParam(":CIDADE", $cidade);
		$stmt->bindParam(":ESTADO", $estado);
		$stmt->bindParam(":BAIRRO", $bairro);
		$stmt->bindParam(":RUA", $rua);
		$stmt->bindParam(":NUMERO", $numero);
		$stmt->bindParam(":COMPLEMENTO", $complemento);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			return true;
		} else {
			return false;
		}
	}

	public function dataUserById($id)
	{
		$data = [];
		$stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :ID");
		$stmt->bindParam(":ID", $id);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$data = $stmt->fetch();
		}

		return $data;		
	}
}