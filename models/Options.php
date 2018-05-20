<?php

class Options extends model
{
	public function getName($id)
	{
		$stmt = $this->conn->prepare("SELECT name FROM options WHERE id = :ID");
		$stmt->bindParam(":ID", $id);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$stmt = $stmt->fetch();
			return $stmt['name'];
		}
	}
}