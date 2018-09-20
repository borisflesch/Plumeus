<?php

class ChoicesManager extends Manager {

	public function getUserStoryChoices(User $user, Story $story) {
		$q = $this->db->prepare('SELECT * FROM choices WHERE id_user = :id_user AND id_story = :id_story ORDER BY id ASC');
		$q->bindValue(':id_user', $user->id());
		$q->bindValue(':id_story', $story->id());
		$q->execute();

		if ($q->rowCount()) {
			$choices = [];
			while ($c = $q->fetch(PDO::FETCH_ASSOC)) {
				$choices[] = new Choice($c);
			}
			return $choices;
		}
		return false;
	}

	public function getUserStoryBlocChoice(User $user, Story $story, Bloc $bloc) {

		$q = $this->db->prepare('SELECT * FROM choices WHERE id_user = :id_user AND id_story = :id_story AND bloc_nbr = :bloc_nbr ORDER BY id ASC');
		$q->bindValue(':id_user', $user->id());
		$q->bindValue(':id_story', $story->id());
		$q->bindValue(':bloc_nbr', $bloc->bloc_number());
		$q->execute();

		if ($q->rowCount()) {
			return new Choice($q->fetch(PDO::FETCH_ASSOC));
		}
		return false;

	}

	public function create(Choice $choice) {
		$q = $this->db->prepare('INSERT INTO choices (id_user, id_story, bloc_nbr, next_bloc_nbr) VALUES (:id_user, :id_story, :bloc_nbr, :next_bloc_nbr)');
		$q->bindValue(':id_user', $choice->id_user());
		$q->bindValue(':id_story', $choice->id_story());
		$q->bindValue(':bloc_nbr', $choice->bloc_nbr());
		$q->bindValue(':next_bloc_nbr', $choice->next_bloc_nbr());
		$res = $q->execute();

		return $res;
	}

	public function update(Choice $choice) {
		$q = $this->db->prepare('UPDATE choices SET id_user = :id_user, id_story = :id_story, bloc_nbr = :bloc_nbr, next_bloc_nbr = :next_bloc_nbr WHERE id = :id');
		$q->bindValue(':id_user', $choice->id_user());
		$q->bindValue(':id_story', $choice->id_story());
		$q->bindValue(':bloc_nbr', $choice->bloc_nbr());
		$q->bindValue(':next_bloc_nbr', $choice->next_bloc_nbr());
		$q->bindValue(':id', $choice->id());
		$res = $q->execute();

		return $res;
	}

	public function deleteChoicesFromUserStory(User $user, Story $story) {
		$q = $this->db->prepare('DELETE FROM choices WHERE id_user = :id_user AND id_story = :id_story');
		$q->bindValue(':id_user', $user->id());
		$q->bindValue(':id_story', $story->id());
		$res = $q->execute();

		return $res;
	}

}