<?php

class CategoriesManager extends Manager {

	/**
	 * Récupère une catégorie depuis son id
	 * @param  int      $id Id de la catégorie à récupérer
	 * @return Category     Retourne l'objet Category ou false si inexistante
	 */
	public function getCategory($id) {
		$q = $this->db->prepare('SELECT * FROM categories WHERE id = :id');
		$q->bindValue(':id', $id);
		$q->execute();

		if($q->rowCount() == 1) {
			return new Category($q->fetch(PDO::FETCH_ASSOC));
		}
		return false;
	}

	public function getCategoryBySlug($slug) {
		$q = $this->db->prepare('SELECT * FROM categories WHERE slug = :slug');
		$q->bindValue(':slug', $slug);
		$q->execute();

		if($q->rowCount() == 1) {
			return new Category($q->fetch(PDO::FETCH_ASSOC));
		}
		return false;
	}

	/**
	 * Récupère toutes les catégories dans la db par ordre alphabétique
	 * @return array Retourne un tableau d'objets Category
	 */
	public function getCategories() {
		$q = $this->db->query('SELECT * FROM categories ORDER BY name');

		if($q->rowCount()) {
			$categories = [];
			while($c = $q->fetch(PDO::FETCH_ASSOC)) {
				$categories[] = new Category($c);
			}
			return $categories;
		}
		return false;
	}

}