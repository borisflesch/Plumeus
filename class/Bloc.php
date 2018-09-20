<?php

class Bloc extends Table {

	protected $id,
			  $id_story,
			  $title,
			  $bloc_number,
			  $number_child_1,
			  $number_child_2,
			  $text_child_1,
			  $text_child_2,
			  $end_bloc,
			  $content;

	public function id() { return $this->id; }
	public function id_story() { return $this->id_story; }
	public function title() {
		return ($this->title) ? $this->title : 'Sans titre';
	}
	public function bloc_number() { return $this->bloc_number; }
	public function number_child_1() { return $this->number_child_1; }
	public function number_child_2() { return $this->number_child_2; }
	public function text_child_1() { return $this->text_child_1; }
	public function text_child_2() { return $this->text_child_2; }
	public function end_bloc() { return $this->end_bloc; }
	public function content() { return $this->content; }

	public function getParsedContent() {
		return System::parseBBContent($this->content());
	}

	public function setId($id) {
		$this->id = $id;
	}
	public function setId_story($id_story) {
		$this->id_story = $id_story;
	}
	public function setTitle($title) {
		$this->title = $title;
	}
	public function setBloc_number($bloc_number) {
		$this->bloc_number = $bloc_number;
	}
	public function setNumber_child_1($number_child_1) {
		$this->number_child_1 = $number_child_1;
	}
	public function setNumber_child_2($number_child_2) {
		$this->number_child_2 = $number_child_2;
	}
	public function setText_child_1($text_child_1) {
		$this->text_child_1 = $text_child_1;
	}
	public function setText_child_2($text_child_2) {
		$this->text_child_2 = $text_child_2;
	}
	public function setEnd_bloc($end_bloc) {
		$this->end_bloc = $end_bloc;
	}
	public function setContent($content) {
		$this->content = $content;
	}

}