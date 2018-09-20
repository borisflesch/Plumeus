<?php

class Story extends Table {

	protected $id,
			  $id_author,
			  $title,
			  $description,
			  $category,
			  $layout,
			  $status,
			  $datetimepost,
			  $datetimeedit,
			  $image_format;

	public function getUrl() {
		return 'story-'.$this->id();
	}

	public function getPlayUrl() {
		return 'story-'.$this->id().'/play';
	}

	public function getThumbPath() {
		return 'img/stories/'.$this->id().'.'.System::getExtensionFormat($this->image_format());
	}

	public function id() { return $this->id; }
	public function id_author() { return $this->id_author; }
	public function title() { return $this->title; }
	public function description() { return $this->description; }
	public function category() { return $this->category; }
	public function layout() { return $this->layout; }
	public function status() { return $this->status; }
	public function datetimepost() { return $this->datetimepost; }
	public function datetimeedit() { return $this->datetimeedit; }
	public function image_format() { return $this->image_format; }

	public function setId($id) {
		$this->id = $id;
	}
	public function setId_author($id) {
		$this->id_author = $id;
	}
	public function setTitle($title) {
		$this->title = $title;
	}
	public function setDescription($desc) {
		$this->description = $desc;
	}
	public function setCategory($category) {
		$this->category = $category;
	}
	public function setLayout($layout) {
		$this->layout = $layout;
	}
	public function setStatus($status) {
		$this->status = $status;
	}
	public function setDatetimepost($dt) {
		$this->datetimepost = $dt;
	}
	public function setDatetimeedit($dt) {
		$this->datetimeedit = $dt;
	}
	public function setImage_format($image_format) {
		$this->image_format = $image_format;
	}

}