<?php


require '../services.php';

session_start();

$username = $_SESSION["username"];
if (!isset($username)) {
    header("Location: form_login.php");
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../static/css/style.css">
  <link rel="stylesheet" href="../static/css/style_dp.css">
  <link rel="stylesheet" href="../static/css/user_log.css">

  <title>Liste des Livres</title>
</head>

<body>
  <div class="container">


    <div class="nav">
      <nav>
        <button class="btn-nav">
          <a href="../index.php">Acceuil</a>
        </button>
        ·
        <button class="btn-nav">
          <a href="contact.html">Contact</a>
        </button>
      </nav>
      <div class="user-container">
        <div class="username"><?php echo $username; ?></div>
        <a href="../logout.php" class="logout-btn">Déconnexion</a>
      </div>
    </div>

    <div class="header">
                <span id="logo">
                  <a href="collection.php">BookShelf</a>
                </span>
       
                <div class="page-title">
                    <a class="btn-back" href="collection.php">
                        🢨
                    </a>
                    <h3>Livre(s) prete(s)</h3>
                </div>
            </div>

  <main id="" style="align-items: center; justify-content: center;">
    <?php
    $user_collection = getLivrePrete($_SESSION['user_id']);
    $_count = count($user_collection);
    ?>

    
    <div class="section-result">
        
        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                <th scope="col">Titre</th>
                <th scope="col">Auteur</th>
                <th scope="col">Prete a</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($user_collection as $key => $item) {
                ?>
                <tr>
                    <td>
                        <?php
                        echo $item["titre"];
                        ?>
                            </td>
                    <td>
                        <?php
                        echo $item["auteur"];
                        ?>
                            </td>
                    <td>
                        <?php
                        echo $item["nom"];
                        // print_r($item);
                        ?>
                            </td>
                    <td>
                        <?php
                        echo $item["genre"];
                        ?>
                            </td>
                    
                    <td>
                    <a href="form_addBook.php?action=update&book=<?php echo $item["id"]; ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                    <a href="../deleteLoan.php?loan=<?php echo $item["id"]; ?>&book=<?php echo $item['id_livre']; ?>&next=here" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
                    </td>
                </tr>
                <?php
                }
                ?>
                
                <?php
                // }
                // } else {
                // echo '<tr><td colspan="6">Aucun résultat trouvé.</td></tr>';
                // }
                ?>
            </tbody>
        </table>
        
        <nav aria-label="Page navigation">
          <ul class="pagination ">
            <?php // if ($page > 1): ?>
              <li class="page-item">
                <a class="page-link" href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page - 1])); ?>" aria-label="Précédent">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
            <?php // endif; ?>
    
            <?php // for ($i = 1; $i <= $total_pages; $i++): ?>
              <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                <a class="page-link" href="?<?php echo http_build_query(array_merge($_GET, ['page' => $i])); ?>"><?php echo $i; ?> 1</a>
              </li>
              <li class="page-item <?php echo $i == $page ? '' : ''; ?>">
                <a class="page-link" href="?<?php echo http_build_query(array_merge($_GET, ['page' => $i])); ?>"><?php echo $i; ?> 2</a>
              </li>
            <?php // endfor; ?>
    
            <?php // if ($page < $total_pages): ?>
              <li class="page-item">
                <a class="page-link" href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page + 1])); ?>" aria-label="Suivant">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            <?php // endif; ?>
          </ul>
        </nav> 

    </div>    
            

  </main>


  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
