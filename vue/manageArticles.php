<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Actualités</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style1.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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
    // function update(id, titre, contenu) {
    //     var tabArray = tab.split("*");
    //     document.getElementById('titre').value = titre;
    //     document.getElementById('contenu').value = contenu;
    //     document.getElementById('articleId').innerHTML = "Modifier compte " + id;
    //     const contact = document.getElementById('container');
    //     contact.classList.add('active');
    // }
    function addArticle() {
        // alert(`<input  type='text' id="uprenom" class="swal2-input" value="${titre}" Placeholder="Prénom">
        //   <input  type='text' id="unom" class="swal2-input" value="${contenu}" placeholder="Nom">
        //   <select name="profil" id="profil" class="swal2-input" value="me">
        //     <option > Medecin < /option> 
        //     <option > Secretaire < /option>
        //     </select>`);
        // swal("Oops", "Something went wrong!", "error")
        Swal.fire({
            title: `Ajout d'un nouveau article`,
            html: ` <input   id="swal-input1" class="swal2-input"  placeholder="titre" >` +
                `<textarea  id="swal-input2"   placeholder="contenu" rows="9" cols="50"></textarea>`,
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
                        todo: 'add',
                        titre: document.getElementById('swal-input1').value,
                        contenu: document.getElementById('swal-input2').value
                    },
                    success: function(data) {

                        if (data == 1) {
                            Swal.fire({
                                title: `L'article  a bien été ajouté`,
                                icon: 'success',
                                showCancelButton: false,
                                showConfirmButton: false,
                                closeOnCancel: true,
                                timer: 20000,
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
                ` <input   id="swal-input1" class="swal2-input"  placeholder="categorie" value="${categorie}">` +
                `<textarea  id="swal-input2"   placeholder="contenu" rows="9" cols="50">${contenu}</textarea>`,
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
                        contenu: document.getElementById('swal-input2').value
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
                    todo: 'delete',
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
    <div class="container">
        <?php require_once 'inc/entete.php'; ?>
        <?php
        require_once 'inc/menu.php';
        ?>
        <div id="contenu">
            <table class="table table-responsive">
                <tr>
                    <td>ID</td>
                    <td>titre</td>
                    <td>dateCreation</td>
                    <td>categorie</td>
                    <td>Contenu</td>
                    <td>Action</td>
                    <td> <button class="btb btn-dark" onclick="addArticle();">Nouveau article</button>
                        <button class="btb btn-dark">Nouveau categorie</button>
                    </td>
                </tr>
                <?php if (!empty($articles)) : print_r($categories);
                    $x = (array)$categories; ?>
                    <?php foreach ($articles as $article) : ?>
                        <tr>
                            <td><?= $article->id ?></td>
                            <td><?= $article->titre ?></td>
                            <td><?= $article->dateCreation ?></td>
                            <td><?= $article->libelle . " " . $article->categId ?></td>
                            <td>
                                <p><?= substr($article->contenu, 0, 30) . '...' ?></p>
                            </td>
                            <td>
                                <button class="btb btn-primary" onclick="updateArticle(<?= $article->id ?>,'<?= $article->titre ?>','<?= $article->contenu ?>','<?= $article->libelle ?>');">
                                    Modifier
                                </button>
                                <!-- </a> -->
                                <button class="btb btn-danger" onclick="deleteArticle(<?= $article->id ?>);">

                                    Supprimer</button>
                            </td>
                        </tr>
                    <?php endforeach ?>
            </table>
        <?php else : ?>
            <div class="message">Aucun article trouvé</div>
        <?php endif ?>
        </div>
        </table>

    </div>

</body>

</html>