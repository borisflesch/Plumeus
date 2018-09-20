<?php

class BlocsManager extends Manager {


	public function getAll() {
		$q = $this->db->query('SELECT * FROM blocs ORDER BY id DESC');
		//$q->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Bloc');
		//var_dump($q);
		//var_dump(new Bloc($q->fetch(PDO::FETCH_ASSOC)));
		if ($q->rowCount()) {
			$blocs = [];
			while ($b = $q->fetch(PDO::FETCH_ASSOC)) {
				$blocs[] = new Bloc($b);
			}
			return $blocs;
		}
		return false;
	}

	public function get($id) {
		$q = $this->db->prepare('SELECT * FROM blocs WHERE id = :id');
		$q->bindValue(':id', $id);
		$q->execute();
		if ($q->rowCount()) {
			return new Bloc($q->fetch(PDO::FETCH_ASSOC));
		}
		return false;
	}

	public function getAllFromStory(Story $story) {
		$q = $this->db->prepare('SELECT * FROM blocs WHERE id_story = :id_story ORDER BY bloc_number ASC');
		$q->bindValue(':id_story', $story->id());
		$q->execute();
		if ($q->rowCount()) {
			$blocs = [];
			while ($b = $q->fetch(PDO::FETCH_ASSOC)) {
				$blocs[] = new Bloc($b);
			}
			return $blocs;
		}
		return false;
	}

	public function getNumFromStory(Story $story, $num) {
		$q = $this->db->prepare('SELECT * FROM blocs WHERE id_story = :id_story AND bloc_number = :bloc_number');
		$q->bindValue(':id_story', $story->id());
		$q->bindValue(':bloc_number', $num);
		$q->execute();
		if ($q->rowCount()) {
			return new Bloc($q->fetch(PDO::FETCH_ASSOC));
		}
		return false;
	}

	public function getFirstFromStory(Story $story) {
		$q = $this->db->prepare('SELECT * FROM blocs WHERE id_story = :id_story ORDER BY bloc_number ASC LIMIT 1');
		$q->bindValue(':id_story', $story->id());
		$q->execute();
		if ($q->rowCount()) {
			return new Bloc($q->fetch(PDO::FETCH_ASSOC));
		}
		return false;
	}

	public function getParentFromNumStory(Story $story, $num_child) {
		$q = $this->db->prepare('SELECT * FROM blocs WHERE id_story = :id_story AND (number_child_1 = :number_child_1 OR number_child_2 = :number_child_2)');
		$q->bindValue(':id_story', $story->id());
		$q->bindValue(':number_child_1', $num_child);
		$q->bindValue(':number_child_2', $num_child);
		$q->execute();
		if ($q->rowCount()) {
			$blocs = [];
			while ($b = $q->fetch(PDO::FETCH_ASSOC)) {
				$blocs[] = new Bloc($b);
			}
			return $blocs;
		}
		return false;
	}

	public function getMaxBlocNumberFromStory(Story $story) {

		$q = $this->db->prepare('SELECT MAX(bloc_number) FROM blocs WHERE id_story = :id_story');
		$q->bindValue(':id_story', $story->id());
		$q->execute();

		return $q->fetchColumn();

	}

	public function createDefaultBlocs(Story $story) {

		for ($i = 1; $i <= 3; $i++) {
			$bloc = new Bloc([
					'id_story' => $story->id(),
					'number_child_1' => ($i == 1) ? 2 : null,
					'number_child_2' => ($i == 1) ? 3 : null,
					'text_child_1' => '',
					'text_child_2' => '',
					'bloc_number' => $i,
					'content' => ''
				]);

			$this->create($bloc);
		}

	}

	public function create(Bloc $bloc) {

		$fields = ['id_story', 'title', 'number_child_1', 'number_child_2', 'text_child_1', 'text_child_2', 'bloc_number', 'content'];

		$sql = 'INSERT INTO blocs (';
		foreach ($fields as $f) {
			$sql .= $f.', ';
		}
		$sql = substr($sql, 0, -2);
		$sql .= ') VALUES (';
		foreach ($fields as $f) {
			$sql .= ':'.$f.', ';
		}
		$sql = substr($sql, 0, -2);
		$sql .= ')';

		$q = $this->db->prepare($sql);
		foreach ($fields as $f) {
			$q->bindValue(':'.$f, $bloc->$f());
		}

		$res = $q->execute();

		return $res;
	}

	public function update(Bloc $bloc) {

		$fields = ['id_story', 'title', 'number_child_1', 'number_child_2', 'text_child_1', 'text_child_2', 'bloc_number', 'content', 'end_bloc'];

		$sql = 'UPDATE blocs SET ';
		foreach ($fields as $f) {
			$sql .= $f.' = :'.$f.', ';
		}
		$sql = substr($sql, 0, -2);
		$sql .= ' WHERE id = :id';

		$q = $this->db->prepare($sql);
		foreach ($fields as $f) {
			$q->bindValue(':'.$f, $bloc->$f());
		}
		$q->bindValue(':id', $bloc->id());

		$res = $q->execute();

		return $res;

	}

	public function delete(Bloc $bloc) {

		$q = $this->db->prepare('DELETE FROM blocs WHERE id = :id');
		$q->bindValue(':id', $bloc->id());
		$res = $q->execute();

		return $res;

	}

}