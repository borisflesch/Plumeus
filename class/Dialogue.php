<?php

class Dialogue extends Table {

	protected $id,
			  $id_bloc,
			  $type, //1 = sender (right) ou 2 = receiver (left)
			  $content;


	public function id() { return $this->id; }
	public function id_bloc() { return $this->id_bloc; }
	public function type() { return $this->type; }
	public function content() { return $this->content; }

	public function getParsedContent() {
		return System::parseBBContent($this->content());
	}

	public function setId($id) {
		$this->id = $id;
	}
	public function setId_bloc($id_bloc) {
		$this->id_bloc = $id_bloc;
	}
	public function setType($type) {
		$this->type = $type;
	}
	public function setContent($content) {
		$this->content = $content;
	}

}