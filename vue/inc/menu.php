<div id="menu">
	<ul>
		<li><a href="index.php">Accueil</a></li>
		<li><a href="index.php?profil=editeur">Editeur</a></li>
        <li><a href="index.php?profil=administrateur">Administrateur</a></li>
		<?php foreach ($categories as $categorie): ?>
			<li><a href="index.php?action=categorie&id=<?= $categorie->id ?>"><?= $categorie->libelle ?></a></li>
		<?php endforeach ?>
	</ul>
</div>