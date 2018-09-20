<?php

class StoriesManager extends Manager {

	/**
	 * Récupère une story en fonction de son id
	 * @param  int   $id   Id de la story à récupérer
	 * @return Story array Retourne un objet Story ou false si inexistant
	 */
	public function getStory($id) {
		$q = $this->db->prepare('SELECT * FROM stories WHERE id = :id');
		$q->bindValue(':id', $id);
		$q->execute();

		if($q->rowCount() == 1) {
			return new Story($q->fetch(PDO::FETCH_ASSOC));
		}
		return false;
	}



	/**
	 * Récupère toutes les stories triées par date de création décroissante
	 * @return array Retourne un tableau d'objets Story
	 */
	public function getStories() {
		$q = $this->db->query('SELECT * FROM stories ORDER BY datetimepost DESC');
		$stories = [];
		if($q->rowCount()) {
			while($s = $q->fetch(PDO::FETCH_ASSOC)) {
				$stories[] = new Story($s);
			}
			return $stories;
		}
		return false;
	}


	public function getSortedStories($category = false, $sort = 'time', $page = 1) {
		$bindValues = [];

		if ($sort == 'readings') {
			$sql = 'SELECT stories.*, count(readings.id) read_nbr FROM stories
					LEFT JOIN readings ON readings.id_story = stories.id';
		} else {
			$sql = 'SELECT * FROM stories';
		}

		$sql .= ' WHERE stories.status = 1';
		
		if ($category) {
			$sql .= ' AND category = :category';
			$bindValues[] = [':category', $category->id()];
		}
		if ($sort == 'readings') {
			$sql .= ' GROUP BY stories.id
					ORDER BY read_nbr DESC';
		} else {
			$sql .= ' ORDER BY datetimepost DESC';
		}

		$start = ($page-1)*System::STORIES_PER_PAGE;

		$sql .= ' LIMIT '.$start.', '.System::STORIES_PER_PAGE;

		$q = $this->db->prepare($sql);
		foreach ($bindValues as $b) {
			$q->bindValue($b[0], $b[1]);
		}
		$q->execute();

		//$storiesNumber = $qNoLimit->rowCount();


		/*$sql .= ' LIMIT '.$start.', '.System::STORIES_PER_PAGE;

		$qLimit = $this->db->prepare($sql);
		foreach ($bindValues as $b) {
			$qLimit->bindValue($b[0], $b[1]);
		}
		$qLimit->execute();	*/


		if($q->rowCount()) {
			$stories = [];
			while($s = $q->fetch(PDO::FETCH_ASSOC)) {
				$stories[] = new Story($s);
			}
			return $stories;
		}
		return false;
	}

	public function getStoriesCreatedByUser(User $user) {
		$q = $this->db->prepare('SELECT * FROM stories WHERE id_author = :id_author ORDER BY datetimeedit DESC');
		$q->bindValue(':id_author', $user->id());
		$q->execute();

		if ($q->rowCount()) {
			$stories = [];
			while($s = $q->fetch(PDO::FETCH_ASSOC)) {
				$stories[] = new Story($s);
			}
			return $stories;
		}
		return false;
	}

	/**
	 * [addStory description]
	 * @param Story $story [description]
	 */
	public function addStory(Story $story) {
		$q = $this->db->prepare('INSERT INTO stories (id_author, title, description, category, layout, status, datetimepost, datetimeedit, image_format) VALUES (:id_author, :title, :description, :category, :layout, :status, NOW(), NOW(), :image_format)');
		$q->bindValue(':id_author', $story->id_author());
		$q->bindValue(':title', $story->title());
		$q->bindValue(':description', $story->description());
		$q->bindValue(':category', $story->category());
		$q->bindValue(':layout', $story->layout());
		$q->bindValue(':status', $story->status());
		$q->bindValue(':image_format', $story->image_format());
		$res = $q->execute();

		return $res;
	}


	public function update(Story $story) {
		$q = $this->db->prepare('UPDATE stories SET id_author = :id_author, title = :title, description = :description, category = :category, layout = :layout, status = :status, datetimeedit = NOW(), image_format = :image_format WHERE id = :id');
		$q->bindValue(':id_author', $story->id_author());
		$q->bindValue(':title', $story->title());
		$q->bindValue(':description', $story->description());
		$q->bindValue(':category', $story->category());
		$q->bindValue(':layout', $story->layout());
		$q->bindValue(':status', $story->status());
		$q->bindValue(':image_format', $story->image_format());
		$q->bindValue(':id', $story->id());
		$res = $q->execute();

		return $res;
	}
}