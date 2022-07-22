<?php
require_once 'controleur/Controller.php';

$controller = new Controller();
// print_r($_GET);
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
		// $_SESSION['profil'] = 'editeur';
		// // echo $_SESSION['profil'];
		if (isset($_GET['todo'])) {
			// index.php?todo=update&id
			if ($_GET['todo'] == 'update') {
				// echo 'fi la';
				// index.php?todo=update&id
				// on maj withh index
				echo  $controller->UpdateArticle($_GET['id'], $_GET['titre'], $_GET['contenu']);
			}else if($_GET['todo'] == 'add') {
				// echo 'fi la';
				// index.php?todo=update&id
				// on maj withh index
				echo  $controller->addArticle($_GET['titre'], $_GET['contenu']);
			}
			 else {
				// del with index
				// echo 'delapa';
				echo  $controller->DeleteArticle($_GET['id']);
			}
		} else {
			$controller->ManageArticles();
		}

		// Users();
	} else {
		echo 'admin';
		$_SESSION['profil'] = 'admin';
	}
} elseif (isset($_SESSION['profil'])) {
	// 	echo $_SESSION['profil'];
	// 	if ($_GET['profil'] == 'editeur') {
	// 		$_SESSION['profil'] = 'editeur';
	// 		// echo $_SESSION['profil'];
	// 		if (isset($_GET['todo'])) {
	// 			// index.php?todo=update&id
	// 			if ($_GET['todo'] == 'update') {
	// 				// index.php?todo=update&id
	// 				// on maj withh index
	// 				echo 'updatepae';
	// 			} else {
	// 				// del with index
	// 				echo 'delapa';
	// 			}
	// 		} else {
	// 			$controller->ManageArticles();
	// 		}
	// 	}
	// } else {
	$controller->showAccueil();
	// echo 'nono';
	// echo $_SESSION['profil'];
}
// if (isset($_SESSION['profil'])) {
// 	echo $_SESSION['profil'];
// 	if ($_SESSION['profil'] == 'editeur') {
// 		echo 'momla';
// 	}
// }
