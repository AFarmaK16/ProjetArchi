<?php
// require_once 'modele/dao/ArticleDao.php';
// require_once 'modele/dao/CategorieDao.php';
require_once 'modele/Article.php';
require_once 'modele/Categorie.php';
require_once 'modele/ConnexionManager.php';

/**
 * Classe représentant notre controleur principal
 */
class Controller
{

	function __construct()
	{
	}

	public function showAccueil()
	{
		$articles = Article::getRecentArticle();
		$categories = Categorie::getList();

		require_once 'vue/accueil.php';
	}
	public function ManageArticles()
	{
		$articles = Article::getList();
		$categories = Categorie::getList();

		require_once 'vue/manageArticles.php';
	}
	public function UpdateArticle($id, $titre, $contenu)
	{
		$result = Article::updateArticle($id, $titre, $contenu);
		// $categories = Categorie::getList();
		return $result;
		// require_once 'vue/manageArticles.php';
	}
	public function DeleteArticle($id)
	{
		$result = Article::deleteArticle($id);
		// $categories = Categorie::getList();
		return $result;

		// require_once 'vue/manageArticles.php';
	}
	public function addArticle($titre, $contenu)
	{
		$result = Article::addArticle($titre, $contenu);
		// $categories = Categorie::getList();
		return $result;

		// require_once 'vue/manageArticles.php';
	}
	public function showArticle($id)
	{
		$article = Article::getById($id);
		$categories = Categorie::getList();

		require_once 'vue/article.php';
	}

	public function showCategorie($id)
	{
		$articles = Article::getByCategoryId($id);
		$categories = Categorie::getList();

		require_once 'vue/articleByCategorie.php';
	}
}
