<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Affichage d'un article</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style1.css">

</head>

<body>
	<?php require_once 'inc/entete.php'; ?>
	<?php require_once 'inc/menu.php';  ?>
	<?php if (!empty($article)) :
		$id = $article->id;
	?>
		<div id="contenu">
			<h1><?= $article->titre ?></h1>
			<span>Publié le <?= $article->dateCreation ?></span>
			<p><?= $article->contenu ?></p>
		</div>
	<?php else :  $id = 0; ?>
		<div id="contenu">
			<h4>L'article demandé n'existe pas</h4>
		</div>
	<?php endif ?>
	<!-- NAVIGATION BUTTONS -->
	<div id="navigation">
		<div id='prec'>
			<a href="index.php?action=article&id=<?= $id - 1 ?>" onclick="javascript:history.back();">
				<p>&lt;&lt;prec</p>
			</a>
		</div>
		<div id='suiv'>
			<a href="index.php?action=article&id=<?= $id + 1 ?>" onclick="javascript:history.back();">
				<p>suiv&gt;&gt;</p>
			</a>
		</div>
		<h1 id="my">Articles a la <b>UNE</b></h1>
	</div>
	<!-- NAVIGATION BUTTONS -->
		
</body>

</html>