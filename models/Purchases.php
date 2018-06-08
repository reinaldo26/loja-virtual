<?php

class Purchases extends model
{
	public function createPurchase($id, $total, $payment_type)
	{
		$stmt = $this->conn->prepare("INSERT INTO purchases(id_user, total_amount, payment_type, payment_status) VALUES(:ID, :TOTAL, :PAYMENT_TYPE, 1)");
		$stmt->bindParam(":ID", $id);
		$stmt->bindParam(":TOTAL", $total);
		$stmt->bindParam(":PAYMENT_TYPE", $payment_type);
		$stmt->execute();

		return $this->conn->lastInsertId();
	}

	public function addItem($id, $id_product, $qt, $price)
	{
		$stmt = $this->conn->prepare("INSERT INTO purchases_products(id_purchase, id_product, quantity, product_price) VALUES(:ID, :ID_PRODUCT, :QT, :PRICE)");
		$stmt->bindParam(":ID", $id);
		$stmt->bindParam(":ID_PRODUCT", $id_product);
		$stmt->bindParam(":QT", $qt);
		$stmt->bindParam(":PRICE", $price);
		$stmt->execute();
	}

	public function updateBilletUrl($id, $link)
	{
		$stmt = $this->conn->prepare("UPDATE purchases SET billet_link = :LINK WHERE id = :ID");
		$stmt->bindParam(":LINK", $link);
		$stmt->bindParam(":ID", $id);
		$stmt->execute();
	}

	public function setPaid($id) 
	{
		$stmt = $this->conn->prepare("UPDATE purchases SET payment_status = :STATUS WHERE id = :ID");
		$stmt->bindValue(":STATUS", '2');
		$stmt->bindValue(":ID", $id);
		$stmt->execute();
	}
}