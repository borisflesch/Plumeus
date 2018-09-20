<?php

class DialoguesManager extends Manager {

	public function get($id) {
		$q = $this->db->prepare('SELECT * FROM dialogues WHERE id = :id');
		$q->bindValue(':id', $id);
		$q->execute();

		if ($q->rowCount()) {
			return new Dialogue($q->fetch(PDO::FETCH_ASSOC));
		}
		return false;
	}

	public function getAllFromBloc($idBloc) {
		$q = $this->db->prepare('SELECT * FROM dialogues WHERE id_bloc = :id_bloc ORDER BY id ASC');
		$q->bindValue(':id_bloc', $idBloc);
		$q->execute();

		if ($q->rowCount()) {
			$dialogues = [];
			while ($d = $q->fetch(PDO::FETCH_ASSOC)) {
				$dialogues[] = new Dialogue($d);
			}
			return $dialogues;
		}
		return false;
	}

	public function create(Dialogue $dialogue) {
		$q = $this->db->prepare('INSERT INTO dialogues (id_bloc, type, content) VALUES (:id_bloc, :type, :content)');
		$q->bindValue(':id_bloc', $dialogue->id_bloc());
		$q->bindValue(':type', $dialogue->type());
		$q->bindValue(':content', $dialogue->content());
		$res = $q->execute();

		return $res;
	}

	public function update(Dialogue $dialogue) {
		$q = $this->db->prepare('UPDATE dialogues SET id_bloc = :id_bloc, type = :type, content = :content WHERE id = :id');
		$q->bindValue(':id_bloc', $dialogue->id_bloc());
		$q->bindValue(':type', $dialogue->type());
		$q->bindValue(':content', $dialogue->content());
		$q->bindValue(':id', $dialogue->id());
		$res = $q->execute();

		return $res;
	}

	public function delete(Dialogue $dialogue) {
		$q = $this->db->prepare('DELETE FROM dialogues WHERE id = :id');
		$q->bindValue(':id', $dialogue->id());
		$res = $q->execute();
		return $res;
	}

}