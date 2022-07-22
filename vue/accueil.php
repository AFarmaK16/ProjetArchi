<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Actualités</title>
	<!-- <link rel="stylesheet" type="text/css" href="assets/css/style1.css"> -->


</head>
<!-- <style>
	#suiv {
		height: 50px;
		width: 50px;
		background: purple;
		border-radius: 50%;
		display: flex;
		justify-content: center;
		align-items: center;
		position: fixed;
		right: 200px;
		bottom: 20px;
		cursor: pointer;
	}

	#suiv p,
	#prec p {
		color: white;

	}

	#prec {
		height: 50px;
		width: 50px;
		background: black;
		border-radius: 50%;
		display: flex;
		justify-content: center;
		align-items: center;
		position: fixed;
		left: 200px;
		bottom: 20px;
		cursor: pointer;
	}
</style> -->

<body>
	<?php require_once 'inc/entete.php'; ?>

	<div id="contenu">
		<?php if (!empty($articles)) : $recentArticle = $articles[0]->id; ?>
			<?php foreach ($articles as $article) :

			?>
				<div class="article">
					<h1><a href="index.php?action=article&id=<?= $article->id ?>"><?= $article->titre ?></a></h1>
					<h6><?= $article->dateCreation ?></h6>
					<p><?= substr($article->contenu, 0, 300) . '...' ?></p>
				</div>
			<?php endforeach ?>
		<?php else : $recentArticle = 0; ?>
			<div class="message">Aucun article trouvé</div>
		<?php endif ?>
	</div>
	<!-- NAVIGATION BUTTONS -->
	<div>
		<div id='prec'>
			<a href="index.php?action=article&id=<?= $recentArticle - 1 ?>" onclick="javascript:history.back();">
				<p>&lt;&lt;prec</p>
			</a>

		</div>
		<div id='suiv'>
			<a href="index.php?action=article&id=<?= $recentArticle + 1 ?>" onclick="javascript:history.back();">
				<p>suiv&gt;&gt;</p>

			</a>

		</div>
		<H1>Articles a la <b>UNE</b></H1>
	</div>
	<!-- NAVIGATION BUTTONS -->
	<?php
	require_once 'inc/menu.php';
	?>
</body>

</html>