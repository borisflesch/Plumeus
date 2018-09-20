<?php
class User extends Table {
	protected $id,
			  $username,
			  $email,
			  $password,
			  $language,
			  $biography,
			  $confirmed,
			  $signupdate,
			  $admin,
			  $image_format;

	public function getAvatar() {
		if (empty($this->image_format())) {
			$path = 'img/avatars/default.jpg';
		} else {
			$path = 'img/avatars/'.$this->id().'.'.System::getExtensionFormat($this->image_format());
			if (!file_exists($path)) {
				$path = 'img/avatars/default.jpg';
			}
		}
		return $path;
	}

	public function getProfileLink() {
		return 'profile-'.$this->id();
	}

	public function id() { return $this->id; }
	public function username() { return $this->username; }
	public function email() { return $this->email; }
	public function password() { return $this->password; }
	public function language() { return $this->language; }
	public function biography() { return $this->biography; }
	public function confirmed() { return $this->confirmed; }
	public function signupdate() { return $this->signupdate; }
	public function admin() { return $this->admin; }
	public function image_format() { return $this->image_format; }

	public function setId($id) {
		$this->id = $id;
	}
	public function setUsername($username) {
		$this->username = $username;
	}
	public function setEmail($email) {
		$this->email = $email;
	}
	public function setPassword($password) {
		$this->password = $password;
	}
	public function setLanguage($language) {
		$this->language = $language;
	}
	public function setBiography($biography) {
		$this->biography = $biography;
	}
	public function setConfirmed($confirmed) {
		$this->confirmed = $confirmed;
	}
	public function setSignupdate($signupdate) {
		$this->signupdate = $signupdate;
	}
	public function setAdmin($admin) {
		$this->admin = $admin;
	}
	public function setImage_format($image_format) {
		$this->image_format = $image_format;
	}
}