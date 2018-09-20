<?php

class Reading extends Table {

	protected $id,
			  $id_user,
			  $id_story;

	public function id() { return $this->id; }
	public function id_user() { return $this->id_user; }
	public function id_story() { return $this->id_story; }

	public function setId($id) {
		$this->id = $id;
	}
	public function setId_user($id_user) {
		$this->id_user = $id_user;
	}
	public function setId_story($id_story) {
		$this->id_story = $id_story;
	}

}