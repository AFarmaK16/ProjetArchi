<?php
require_once 'controleur/Controller.php';

$controller = new Controller();
if (isset($_GET['action'])) {
	if (strtolower($_GET['action']) === 'article') {
		if (isset($_GET['id'])) {
			$controller->showArticle($_GET['id']);
		} else {
			$controller->ShowErrorPage();
		}
	} else if (strtolower($_GET['action']) === 'categorie') {
		if (isset($_GET['id'])) {
			$controller->showCategorie($_GET['id']);
		} else {
			$controller->ShowErrorPage();
		}
	} else {
		$controller->showAccueil();
	}
} else if (isset($_GET['profil'])) {
	if ($_GET['profil'] == 'editeur') {
		if (isset($_GET['todo'])) {
			if ($_GET['todo'] == 'update') {
				echo  $controller->UpdateArticle($_GET['id'], $_GET['titre'], $_GET['contenu'],$_GET['categorie']);
			} else if ($_GET['todo'] == 'addArticle') {
				echo  $controller->addArticle($_GET['titre'], $_GET['contenu'], $_GET['categorie']);
			}
			else if ($_GET['todo'] == 'addCateg') {
				echo  $controller->addCategorie($_GET['categorie']);
			}
			else if ($_GET['todo'] == 'updateCateg') {
				echo  $controller->updateCategorie($_GET['id'],$_GET['categorie']);
			} 
			else if ($_GET['todo'] == 'deleteCateg') {
				echo  $controller->deleteCategorie($_GET['id']);
			} 
			else {
				echo  $controller->DeleteArticle($_GET['id']);
			}
		} else {
			$controller->ManageArticles();
		}
	} else {
		echo 'admin';
		// $_SESSION['profil'] = 'admin';
	}
} else {
	$controller->showAccueil();
}
// if (isset($_SESSION['profil'])) {
// 	echo $_SESSION['profil'];
// 	if ($_SESSION['profil'] == 'editeur') {
// 		echo 'momla';
// 	}
// }
