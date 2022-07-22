<?php

/**
 * Classe métier représentant un article
 */
class Article
{
	public $id;
	public $titre;
	public $contenu;
	public $categorie;
	public $dateCreation;
	public $dateModification;

	// private $bdd;

	// public function __construct()
	// {
	// 	$this->bdd = ConnexionManager::getInstance();
	// }

	public static function getList()
	{
		$bdd = ConnexionManager::getInstance();
		// $data = $bdd->query('SELECT * FROM Article ORDER BY id DESC limit 2');
		$data = $bdd->query("SELECT article.id,titre,dateCreation,contenu,libelle,categorie.id as categId FROM `article` ,`categorie` where article.categorie= categorie.id ORDER BY id ASC");
		// $data = $bdd->query('SELECT * FROM Article,Categorie WHERE Article.categorie= Categorie.id ORDER BY id ASC');
		// $data = $bdd->query('SELECT * FROM Article ORDER BY id ASC');

		// $data = $bdd->query('SELECT * FROM Article ORDER BY dateModification DESC');
		$articles = $data->fetchAll(PDO::FETCH_CLASS, 'Article');
		$data->closeCursor();
		return $articles;
	}
	public static function getRecentArticle()
	{
		$bdd = ConnexionManager::getInstance();
		// $data = $bdd->query('SELECT * FROM Article ORDER BY id DESC limit 2');
		$data = $bdd->query('SELECT * FROM Article ORDER BY dateCreation DESC,id DESC limit 2');

		// $data = $bdd->query('SELECT * FROM Article ORDER BY dateModification DESC');
		$articles = $data->fetchAll(PDO::FETCH_CLASS, 'Article');
		$data->closeCursor();
		return $articles;
	}


	public static function getById($id)
	{
		$bdd = ConnexionManager::getInstance();
		$data = $bdd->query('SELECT * FROM Article WHERE id = ' . $id);
		$article = $data->fetch(PDO::FETCH_OBJ);
		$data->closeCursor();
		return $article;
	}

	public static function getByCategoryId($id)
	{
		$bdd = ConnexionManager::getInstance();
		$data = $bdd->query('SELECT * FROM Article WHERE categorie = ' . $id);
		$articles = $data->fetchAll(PDO::FETCH_CLASS, 'Article');
		$data->closeCursor();
		return $articles;
	}
	// ADD ARTICLE
	public static function addArticle($titre, $contenu)
	{
		$bdd = ConnexionManager::getInstance();
		// $sql = "UPDATE article SET titre= 'hey'  WHERE id = 1";
		$update = $bdd->prepare("INSERT INTO article(titre,contenu,dateCreation) VALUES (:titre,:contenu,:dateCreation)");
		// $update = $bdd->prepare('UPDATE utilisateurs SET NomUtilisateur = :newSName, PrenomUtilisateur = :newFName, MdpUtilisateur = :newPass WHERE NomUtilisateur = :oldSName AND PrenomUtilisateur = :oldFName AND MdpUtilisateur = :oldPass') or die(print_r($bdd->errorInfo()));


		if ($update->execute(array(
			'titre' => $titre,
			'contenu' => $contenu,
			'dateCreation' => date('Y-m-d H:i:s')
		))) {
			return true;
		}

		return false;
	}
	// UPDATE ARTICLE
	public static function updateArticle($id, $titre, $contenu)
	{
		$bdd = ConnexionManager::getInstance();
		// $sql = "UPDATE article SET titre= 'hey'  WHERE id = 1";
		$update = $bdd->prepare("UPDATE article SET titre=:titre , contenu=:contenu,dateCreation=:dateCreation  WHERE id =:id");
		// $update = $bdd->prepare('UPDATE utilisateurs SET NomUtilisateur = :newSName, PrenomUtilisateur = :newFName, MdpUtilisateur = :newPass WHERE NomUtilisateur = :oldSName AND PrenomUtilisateur = :oldFName AND MdpUtilisateur = :oldPass') or die(print_r($bdd->errorInfo()));


		if ($update->execute(array(
			'titre' => $titre,
			'contenu' => $contenu,
			'dateCreation' => date('Y-m-d H:i:s'),
			'id' => $id
		))) {
			return true;
		}

		return false;
	}
	//DELETE ARTICLE
	public static function deleteArticle($id)
	{
		$bdd = ConnexionManager::getInstance();
		$delete = $bdd->prepare("DELETE FROM article WHERE id =:id");
		if ($delete->execute(array(
			'id' => $id
		))) {
			return true;
		}

		return false;
	}
}
