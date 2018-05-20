<?php

class Brands extends model
{
	public function getList()
	{
		$array = [];
		$stmt = $this->conn->prepare("SELECT * FROM brands");
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$array = $stmt->fetchAll();
		}


		return $array;
	}

	public function getNameById(int $id)
	{
		$stmt = $this->conn->prepare("SELECT name FROM brands WHERE id = :ID");
		$stmt->bindParam(":ID", $id);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$data = $stmt->fetch();
			return $data['name'];
		} else {
			return '';
		}

	}
}