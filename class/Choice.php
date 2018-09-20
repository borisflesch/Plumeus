<?php

class Choice extends Table {

	protected $id,
			  $id_user,
			  $id_story,
			  $bloc_nbr,
			  $next_bloc_nbr;

	public function id() { return $this->id; }
	public function id_user() { return $this->id_user; }
	public function id_story() { return $this->id_story; }
	public function bloc_nbr() { return $this->bloc_nbr; }
	public function next_bloc_nbr() { return $this->next_bloc_nbr; }

	public function setId($id) {
		$this->id = $id;
	}
	public function setId_user($id_user) {
		$this->id_user = $id_user;
	}
	public function setId_story($id_story) {
		$this->id_story = $id_story;
	}
	public function setBloc_nbr($bloc_nbr) {
		$this->bloc_nbr = $bloc_nbr;
	}
	public function setNext_bloc_nbr($next_bloc_nbr) {
		$this->next_bloc_nbr = $next_bloc_nbr;
	}

}