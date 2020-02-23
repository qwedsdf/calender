<?php
class UserData
{
	private $userId = 0;

	public function SetUserId($id){
		$this->userId = $id;
	}

	public function GetUserId(){
		return $this->userId;
	}
}

$userData = new UserData();

?>