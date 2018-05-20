<?php

class Categories extends model
{
	public function getList()
	{
		$array = []; // &
		$stmt = $this->conn->query("SELECT * FROM categories ORDER BY sub DESC");
		
		if($stmt->rowCount() > 0){
			foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $item) {
				$item['subs'] = [];
				$array[$item['id']] = $item;
			}
	
			while($this->stillNeed($array)){
				$this->organizeCategory($array);
			}
		}
		return $array;
	}

	public function getCategoryTree($id)
	{
		$array = [];
		$haveChild = true;
		while($haveChild){
			$stmt = $this->conn->prepare("SELECT * FROM categories WHERE id = :ID");
			$stmt->bindParam(":ID", $id);
			$stmt->execute();
			if($stmt->rowCount() > 0){
				$stmt = $stmt->fetch();
				$array[] = $stmt;
				if(!empty($stmt['sub'])){
					$id = $stmt['sub'];
				} else {
					$haveChild = false;
				}
			}
		}
		$array = array_reverse($array);
		return $array;
	}

	public function getCategoryName($id)
	{
		$stmt = $this->conn->prepare("SELECT name FROM categories WHERE id = :ID");
		$stmt->bindParam(":ID", $id);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$stmt = $stmt->fetch();
			return $stmt['name'];
		}
	}

	private function organizeCategory(&$array)
	{
		foreach ($array as $id => $value) {
			if(isset($array[$value['sub']])){
				$array[$value['sub']]['subs'][$value['id']] = $value;
				unset($array[$id]); // remove do array principal
				break;
			}
		}
	}

	private function stillNeed($array)
	{
		foreach ($array as $item) {
			if(!empty($item['sub'])){
				return true; // end function
			} 
		}
		return false;
	}
}