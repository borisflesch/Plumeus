<?php

class ReadingsManager extends Manager {

	public function getStoriesReadByUser(User $user) {
		$q = $this->db->prepare('SELECT stories.* FROM stories
								LEFT JOIN readings ON readings.id_story = stories.id
								WHERE readings.id_user = :id_user
								ORDER BY readings.id DESC');

		$q->bindValue(':id_user', $user->id());
		$q->execute();

		if ($q->rowCount()) {
			$stories = [];
			while ($story = $q->fetch(PDO::FETCH_ASSOC)) {
				$stories[] = new Story($story);
			}
			return $stories;
		}

		return false;
	}

	public function isUserReadingStory(User $user, Story $story) {
		$q = $this->db->prepare('SELECT * FROM readings WHERE id_user = :id_user AND id_story = :id_story');
		$q->bindValue(':id_user', $user->id());
		$q->bindValue(':id_story', $story->id());
		$q->execute();

		return $q->rowCount();
	}

	public function create(Reading $reading) {
		$q = $this->db->prepare('INSERT INTO readings (id_user, id_story) VALUES (:id_user, :id_story)');
		$q->bindValue(':id_user', $reading->id_user());
		$q->bindValue(':id_story', $reading->id_story());
		$res = $q->execute();

		return $res;
	}
}