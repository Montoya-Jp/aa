<?php
// On démarre une session
session_start();

// On inclut la connexion à la base
require_once('connect.php');

$sql = 'SELECT * FROM `liste` WHERE `actif` =1 ';

// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('close.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des produits</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

    <script src="javascript.js">

    </script>

</head>

<body>
    <?php include('./component/header.php') ?>

    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                if (!empty($_SESSION['erreur'])) {
                    echo '<div class="alert alert-danger" role="alert">
                                ' . $_SESSION['erreur'] . '
                            </div>';
                    $_SESSION['erreur'] = "";
                }
                ?>
                <?php
                if (!empty($_SESSION['message'])) {
                    echo '<div class="alert alert-success" role="alert">
                                ' . $_SESSION['message'] . '
                            </div>';
                    $_SESSION['message'] = "";
                }
                ?>
                <h1>Liste des produits</h1>



                <div class="container-items">
                    <?php
                    // On boucle sur la variable result
                    foreach ($result as $produit) { ?>
                        <div class="item">


                            <a href="edit.php?id=<?= $produit['id'] ?>">Edition</a>


                            <div class="flip-box" oneclick=box>
                                <div class="flip-box-inner">
                                    <div class="flip-box-front">
                                        <img src="<?= $produit['image'] ?>" width="15%" style="width:300px;height:200px">
                                    </div>
                                    <div class="flip-box-back">
                                        <button width:100%></button>
                                        <h2><?= $produit['produit'] ?><br>
                                        </h2>
                                        <p><?= $produit['prix'] ?>$<br></p>
                                        <p><?= $produit['nombre'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                </div>
            </section>
        </div>
    </main>
</body>

</html>