<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Actualités</title>
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/style1.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <script src="lib/jquery/jquery.min.js"></script>

    <!-- <style>
        #container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            transition: 200ms ease-in-out;
            border: 1px solid black;
            z-index: 10;
            /* padding: 0; */
            padding-left: 30px;
            background-color: #212529;
            width: 700px;
            /*height: 400px; */
            max-width: 80%;
            background: linear-gradient(135deg, rgba(210, 180, 140, 1), rgba(241, 239, 231, 1));
            /* backdrop-filter: blur(10px); */
            background-repeat: no-repeat;
            -webkit-backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, .18);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, .37);
            color: #010101;

        }

        #container.active {
            transform: translate(-50%, -50%) scale(1);
        }
    </style> -->
</head>
<script>
    function addArticle() {
        Swal.fire({
            title: `Ajout d'un nouveau article`,
            html: ` <input   id="swal-input1" class="swal2-input"  placeholder="titre" >` +
                ` <input   id="swal-input2" class="swal2-input"  placeholder="categorie" >` +
                `<textarea  id="swal-input3"   placeholder="contenu" rows="9" cols="50"></textarea>`,
            timer: 200000,
            showCancelButton: true,
            showConfirmButton: true,
            closeOnCancel: true,
            confirmButtonText: "ajouter",
            cancelButtonText: "annuler",
        }).then((result) => {
            console.log(result);
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "index.php",
                    data: {
                        profil: 'editeur',
                        todo: 'addArticle',
                        titre: document.getElementById('swal-input1').value,
                        categorie: document.getElementById('swal-input2').value,
                        contenu: document.getElementById('swal-input3').value
                    },
                    success: function(data) {

                        if (data == 1) {
                            Swal.fire({
                                title: `L'article  a bien été ajouté`,
                                icon: 'success',
                                showCancelButton: false,
                                showConfirmButton: false,
                                closeOnCancel: true,
                                timer: 2000,
                                timerProgressBar: true,
                            }).then(function() {
                                location.reload();
                            })
                        } else {
                            Swal.fire({
                                title: data,
                                icon: 'error',
                                showCancelButton: false,
                                showConfirmButton: false,
                                closeOnCancel: true,
                                // timer: 2000,
                                timerProgressBar: true,
                            })
                        }
                    }
                })
            }
        })



    }

    function updateArticle(id, titre, contenu, categorie) {
        // alert(id + " list=" + listCateg + " " + titre);
        // console.log(listCateg);
        Swal.fire({
            title: `Modification de l'article #${id} de la categorie ${categorie}`,
            html: ` <input   id="swal-input1" class="swal2-input"  placeholder="titre" value="${titre}">` +
                ` <input   id="swal-input2" class="swal2-input"  placeholder="${categorie}">` +
                `<textarea  id="swal-input3"   placeholder="contenu" rows="9" cols="50">${contenu}</textarea>`,
            // timer: 200000,
            showCancelButton: true,
            showConfirmButton: true,
            closeOnCancel: true,
            confirmButtonText: "Modifier",
        }).then((result) => {
            console.log(result);
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "index.php",
                    data: {
                        profil: 'editeur',
                        todo: 'update',
                        id: id,
                        titre: document.getElementById('swal-input1').value,
                        categorie: document.getElementById('swal-input2').value,
                        contenu: document.getElementById('swal-input3').value
                    },
                    success: function(data) {

                        if (data == 1) {
                            Swal.fire({
                                title: `L'article #${id} a bien été modifié`,
                                icon: 'success',
                                showCancelButton: false,
                                showConfirmButton: false,
                                closeOnCancel: true,
                                timer: 2000,
                                timerProgressBar: true,
                            }).then(function() {
                                location.reload();
                            })
                        } else {
                            Swal.fire({
                                title: data,
                                icon: 'error',
                                showCancelButton: false,
                                showConfirmButton: false,
                                closeOnCancel: true,
                                timer: 2000,
                                timerProgressBar: true,
                            })
                        }
                    }
                })
            }
        })



    }

    function deleteArticle(id) {
        Swal.fire({
            title: `Suppression de l'article #${id}`,
            timer: 1000,
            showCancelButton: false,
            showConfirmButton: false,
            closeOnCancel: false,
            // confirmButtonText: "Supprimer",
        }).then(function() {
            $.ajax({
                type: "GET",
                url: "index.php",
                data: {
                    profil: 'editeur',
                    todo: 'deleteArticle',
                    id: id
                },
                success: function(data) {

                    if (data == 1) {
                        Swal.fire({
                            title: `Suppression de l'article #${id} effectue avec succes`,
                            icon: 'success',
                            showCancelButton: false,
                            showConfirmButton: false,
                            closeOnCancel: true,
                            timer: 2000,
                            timerProgressBar: true,
                        }).then(function() {
                            location.reload();
                        })
                    } else {
                        Swal.fire({
                            // title: data,
                            title: "Erreur lors de la suppression de l'article #${id}",
                            icon: 'error',
                            showCancelButton: false,
                            showConfirmButton: false,
                            closeOnCancel: true,
                            timer: 2000,
                            timerProgressBar: true,
                        })
                    }
                }
            })
        })
        // })



    }

    function addCategorie() {
        Swal.fire({
            title: `Ajouter une nouvelle categorie`,
            html: ` <input   id="swal-input1" class="swal2-input"  placeholder="libelle" >`,
            // timer: 200000,
            showCancelButton: true,
            showConfirmButton: true,
            closeOnCancel: true,
            confirmButtonText: "ajouter",
            cancelButtonText: "annuler",
        }).then((result) => {
            console.log(result);
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "index.php",
                    data: {
                        profil: 'editeur',
                        todo: 'addCateg',
                        categorie: document.getElementById('swal-input1').value
                    },
                    success: function(data) {

                        if (data == 1) {
                            Swal.fire({
                                title: `Nouvelle categorie ajoute avec succes`,
                                icon: 'success',
                                showCancelButton: false,
                                showConfirmButton: false,
                                closeOnCancel: true,
                                timer: 2000,
                                timerProgressBar: true,
                            }).then(function() {
                                location.reload();
                            })
                        } else {
                            Swal.fire({
                                title: data,
                                icon: 'error',
                                showCancelButton: false,
                                showConfirmButton: false,
                                closeOnCancel: true,
                                // timer: 2000,
                                timerProgressBar: true,
                            })
                        }
                    }
                })
            }
        })



    }

    function updateCategorie(id, categorie) {
        // alert(id + " list=" + listCateg + " " + titre);
        // console.log(listCateg);
        Swal.fire({
            title: `Modification de la categorie #${id}`,
            html: ` <input   id="swal-input1" class="swal2-input"  placeholder="titre" value="${categorie}">`,
            // timer: 200000,
            showCancelButton: true,
            showConfirmButton: true,
            closeOnCancel: true,
            confirmButtonText: "Modifier",
        }).then((result) => {
            console.log(result);
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "index.php",
                    data: {
                        profil: 'editeur',
                        todo: 'updateCateg',
                        id: id,
                        categorie: document.getElementById('swal-input1').value,
                    },
                    success: function(data) {

                        if (data == 1) {
                            Swal.fire({
                                title: `La categorie #${id} a bien été modifié`,
                                icon: 'success',
                                showCancelButton: false,
                                showConfirmButton: false,
                                closeOnCancel: true,
                                timer: 2000,
                                timerProgressBar: true,
                            }).then(function() {
                                location.reload();
                            })
                        } else {
                            Swal.fire({
                                title: data,
                                icon: 'error',
                                showCancelButton: false,
                                showConfirmButton: false,
                                closeOnCancel: true,
                                // timer: 2000,
                                timerProgressBar: true,
                            })
                        }
                    }
                })
            }
        })



    }

    function deleteCategorie(id) {
        Swal.fire({
            title: `Suppression de la categorie #${id}`,
            timer: 1000,
            showCancelButton: false,
            showConfirmButton: false,
            closeOnCancel: false,
            // confirmButtonText: "Supprimer",
        }).then(function() {
            $.ajax({
                type: "GET",
                url: "index.php",
                data: {
                    profil: 'editeur',
                    todo: 'deleteCateg',
                    id: id
                },
                success: function(data) {

                    if (data == 1) {
                        Swal.fire({
                            title: `Suppression de l'article #${id} effectue avec succes`,
                            icon: 'success',
                            showCancelButton: false,
                            showConfirmButton: false,
                            closeOnCancel: true,
                            timer: 2000,
                            timerProgressBar: true,
                        }).then(function() {
                            location.reload();
                        })
                    } else {
                        Swal.fire({
                            // title: data,
                            title: "Erreur lors de la suppression de l'article #${id}",
                            icon: 'error',
                            showCancelButton: false,
                            showConfirmButton: false,
                            closeOnCancel: true,
                            timer: 2000,
                            timerProgressBar: true,
                        })
                    }
                }
            })
        })
        // })



    }
</script>

<body>
    <div>
        <?php require_once 'inc/entete.php'; ?>
        <?php
        require_once 'inc/menu.php';
        ?>
        <div class="container">
            <h4>Gerer les articles</h4>

            <table class="table table-responsive">
                <tr>
                    <td>ID</td>
                    <td>titre</td>
                    <td>dateCreation</td>
                    <td>categorie</td>
                    <td>Contenu</td>
                    <td>Action</td>
                    <td> <button class="btn btn-dark" onclick="addArticle();">Nouveau article</button>
                        <button class="btn btn-dark" onclick="addCategorie();">Nouvelle categorie</button>
                    </td>
                </tr>
                <?php if (!empty($articles)) : print_r($categories);
                    $x = (array)$categories; ?>
                    <?php foreach ($articles as $article) : ?>
                        <tr>
                            <td><?= $article->id ?></td>
                            <td><?= $article->titre ?></td>
                            <td><?= $article->dateCreation ?></td>
                            <td><?= $article->libelle . " id= " . $article->categId ?></td>
                            <td>
                                <p><?= substr($article->contenu, 0, 30) . '...' ?></p>
                            </td>
                            <td>
                                <i class='material-icons ed' onclick="updateArticle(<?= $article->id ?>,'<?= $article->titre ?>','<?= $article->contenu ?>','<?= $article->libelle ?>');" style=' cursor: pointer;' id='c$i'>edit</i>
                                <i class='material-icons ed' onclick="deleteArticle(<?= $article->id ?>);" style=' cursor: pointer;' id='c$i'>delete</i>
                            </td>
                        </tr>
                    <?php endforeach ?>
            </table>
        <?php else : ?>
            <div class="message">Aucun article trouvé</div>
        <?php endif ?>
        </div>
        <!-- CATEGORIE TABLE -->
        <div class="container">
            <h4>Gerer les categorie</h4>

            <table class="table table-responsive">
                <tr>
                    <td>ID</td>
                    <td>libelle</td>
                    <td>Action</td>
                    <td>
                        <button class="btb btn-dark" onclick="addCategorie();">Nouvelle categorie</button>
                    </td>
                </tr>
                <?php if (!empty($categories)) : ?>
                    <?php foreach ($categories as $categorie) : ?>
                        <tr>
                            <td><?= $categorie->id ?></td>
                            <td><?= $categorie->libelle ?></td>

                            <td>
                                <i class='material-icons ed' onclick="updateCategorie(<?= $categorie->id ?>,'<?= $categorie->libelle ?>');" style=' cursor: pointer;' id='c$i'>edit</i>
                                <i class='material-icons ed' onclick="deleteCategorie(<?= $categorie->id ?>);" style=' cursor: pointer;' id='c$i'>delete</i>
                            </td>
                        </tr>
                    <?php endforeach ?>
            </table>
        <?php else : ?>
            <div class="message">Aucun article trouvé</div>
        <?php endif ?>
        </div>
    </div>

</body>

</html>