<?php

class Rates extends model
{
	public function getRates($id, $qt)
	{
		$array = [];
		$stmt = $this->conn->prepare("SELECT *, (select users.name from users where users.id = rates.id_user) as user_name FROM rates WHERE id_product = :ID ORDER BY date_rated DESC LIMIT $qt");
		$stmt->bindParam(":ID", $id);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$array = $stmt->fetchAll();
		}
		return $array;
	}
}