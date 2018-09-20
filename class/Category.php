<?php

class Category extends Table {

	protected $id,
			  $name,
			  $slug,
			  $gradient;

	public function getUrl() {
		return System::slugify($this->name());
	}

	public function id() { return $this->id; }
	public function name() { return $this->name; }
	public function slug() { return $this->slug; }
	public function gradient() {
		if ($this->gradient) {
			return $this->gradient;
		} else {
			return '#03a9f4, #3f51b5';
		}
	}

	public function setId($id) {
		$this->id = (int) $id;
	}
	public function setName($name) {
		$this->name = htmlspecialchars($name);
	}
	public function setSlug($slug) {
		$this->slug = $slug;
	}
	public function setGradient($gradient) {
		$this->gradient = $gradient;
	}

}