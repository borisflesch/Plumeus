<?php
class UsersManager extends Manager {

	public function getUser($id) {
		$q = $this->db->prepare('SELECT * FROM users WHERE id = :id');
		$q->bindValue(':id', $id);
		$q->execute();

		if ($q->rowCount()) {
			return new User($q->fetch(PDO::FETCH_ASSOC));
		}
		return false;
	}

	public function isUsernameAvailable($username) {
		$q = $this->db->prepare('SELECT 1 FROM users WHERE username = :username');
		$q->bindValue(':username', $username);
		$q->execute();
		return !$q->fetch(PDO::FETCH_ASSOC);
	}

	public function isEmailAvailable($email) {
		$q = $this->db->prepare('SELECT 1 FROM users WHERE email = :email');
		$q->bindValue(':email', $email);
		$q->execute();
		return !$q->fetch(PDO::FETCH_ASSOC);
	}

	public function logUser($username, $pwd) {
		$q = $this->db->prepare('SELECT * FROM users WHERE username = :username AND password = :pwd');
		$q->bindValue(':username', $username);
		$q->bindValue(':pwd', $pwd);
		$q->execute();
		if($q->rowCount()) {
			return new User($q->fetch(PDO::FETCH_ASSOC));
		}
		return false;
	}

	public function logOut() {
		if(isset($_SESSION['loggedUser'])) {
			unset($_SESSION['loggedUser']);
		}
		session_destroy();
	}

	public function getTopWriters() {
		$q = $this->db->query('SELECT users.*, count(stories.id) nbr_stories FROM users
								RIGHT JOIN stories ON users.id = stories.id_author
								GROUP BY users.id
								HAVING nbr_stories > 0');
		if($q->rowCount()) {
			$users = [];
			$nbrStories = [];
			while ($user = $q->fetch(PDO::FETCH_ASSOC)){
				$users[] = new User($user);
				$nbrStories[] = $user['nbr_stories'];
			}
			return ['users' => $users, 'nbrStories' => $nbrStories];
		}
		return false;
	}

	public function addUser(User $user) {
		$q = $this->db->prepare('INSERT INTO users (username, email, password, confirmed, signupdate, image_format) VALUES (:username, :email, :pwd, 0, NOW(), 0)');
		$q->bindValue(':username', $user->username());
		$q->bindValue(':email', $user->email());
		$q->bindValue(':pwd', $user->password());
		if($q->execute()) {
			return true;
		}
		return false;
	}

	public function update(User $user) {
		$q = $this->db->prepare('UPDATE users SET username = :username, email = :email, password = :password, confirmed = :confirmed, signupdate = :signupdate, image_format = :image_format WHERE id = :id');
		$q->bindValue(':username', $user->username());
		$q->bindValue(':email', $user->email());
		$q->bindValue(':password', $user->password());
		$q->bindValue(':confirmed', $user->confirmed());
		$q->bindValue(':signupdate', $user->signupdate());
		$q->bindValue(':image_format', $user->image_format());
		$q->bindValue(':id', $user->id());
		$res = $q->execute();

		return $res;
	}
}