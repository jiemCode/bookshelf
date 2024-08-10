<?php
// include "db_conn.php";

// // Définir le nombre de résultats par page
// $results_per_page = 6; // Ajustez ce nombre selon vos besoins

// // Récupérer le numéro de page actuel depuis la requête GET
// $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
// $offset = ($page - 1) * $results_per_page;

// // Récupérer les filtres de recherche depuis la requête GET
// $titre = $_GET['titre'] ?? '';
// $auteur = $_GET['auteur'] ?? '';
// $genre = $_GET['genre'] ?? '';
// $annee_min = $_GET['annee_min'] ?? '';
// $annee_max = $_GET['annee_max'] ?? '';

// // Préparer la requête SQL avec les filtres
// $sql = "SELECT * FROM `Livres` WHERE 1=1";
// $params = [];
// $types = '';

// if ($titre) {
//     $sql .= " AND titre LIKE ?";
//     $params[] = "%$titre%";
//     $types .= 's';
// }
// if ($auteur) {
//     $sql .= " AND auteur LIKE ?";
//     $params[] = "%$auteur%";
//     $types .= 's';
// }
// if ($genre) {
//     $sql .= " AND genre LIKE ?";
//     $params[] = "%$genre%";
//     $types .= 's';
// }
// if ($annee_min) {
//     $sql .= " AND annee >= ?";
//     $params[] = $annee_min;
//     $types .= 'i';
// }
// if ($annee_max) {
//     $sql .= " AND annee <= ?";
//     $params[] = $annee_max;
//     $types .= 'i';
// }

// // Ajouter la pagination à la requête SQL
// $sql .= " LIMIT ? OFFSET ?";
// $params[] = $results_per_page;
// $params[] = $offset;
// $types .= 'ii';

// // Préparer et exécuter la requête SQL
// $stmt = $conn->prepare($sql);
// if ($types) {
//     $stmt->bind_param($types, ...$params);
// }
// $stmt->execute();
// $result = $stmt->get_result();

// // Calculer le nombre total de résultats pour la pagination
// $count_sql = "SELECT COUNT(*) AS total FROM `Livres` WHERE 1=1";
// $count_params = [];
// $count_types = '';

// if ($titre) {
//     $count_sql .= " AND titre LIKE ?";
//     $count_params[] = "%$titre%";
//     $count_types .= 's';
// }
// if ($auteur) {
//     $count_sql .= " AND auteur LIKE ?";
//     $count_params[] = "%$auteur%";
//     $count_types .= 's';
// }
// if ($genre) {
//     $count_sql .= " AND genre LIKE ?";
//     $count_params[] = "%$genre%";
//     $count_types .= 's';
// }
// if ($annee_min) {
//     $count_sql .= " AND annee >= ?";
//     $count_params[] = $annee_min;
//     $count_types .= 'i';
// }
// if ($annee_max) {
//     $count_sql .= " AND annee <= ?";
//     $count_params[] = $annee_max;
//     $count_types .= 'i';
// }

// $count_stmt = $conn->prepare($count_sql);
// if ($count_types) {
//     $count_stmt->bind_param($count_types, ...$count_params);
// }
// $count_stmt->execute();
// $count_result = $count_stmt->get_result();
// $total_rows = $count_result->fetch_assoc()['total'];
// $total_pages = ceil($total_rows / $results_per_page);

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

  <title>Liste des Livres</title>
</head>

<body>
  <div class="container">


    <div class="nav">
      <nav>
        <button class="btn-nav active-page">Acceuil</button>
        ·
        <button class="btn-nav">Contact</button>
      </nav>
      <div class="buttons">
        <a href="../logout.php"><button class="btn-register">
          Deconnexion</button>
        </a>
      </div>
    </div>

    <div class="header">
                <span id="logo">
                  BookShelf
                </span>
                <div class="action-buttons-bar">
                    <!-- <a href="form_addBook.php"> -->
                    <a href="search.php">
                        <button id="myButtons"> <span class="action-buttons-icon"> 📝</span> <span class="action-buttons-text">Ajouter un livre </span></button>
                    </a>
                    <a href="search.php">
                        <button> <span class="action-buttons-icon"> 🔍</span> <span class="action-buttons-text">Rechercher un livre </span></button>
                    </a>
                    <a href="#">
                        <button> <span class="action-buttons-icon"> ↗️</span> <span class="action-buttons-text">Preter un livre </span></button>
                    </a>
                </div>
                <div class="page-title">
                    <!-- <h3>Ma collection </h3> -->
                    <!-- <small> - 27 oeuvres</small> -->
                </div>
            </div>

  <main id="content">
    <?php
    // if (isset($_GET["msg"])) {
    //   $msg = htmlspecialchars($_GET["msg"]);
    //   echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    //   ' . $msg . '
    //   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    // </div>';
    // }
    ?>

    <div class="section-filter">
        <form class="filter-form" method="get">
            <label for="">Auteur</label>
            <input type="text" class="form-control" name="auteur" placeholder="Auteur" value="<?php 
            // echo htmlspecialchars($auteur); 
            ?>">
            <label for="">Genre</label>
            <input type="text" class="form-control" name="genre" placeholder="Genre" value="<?php 
            // echo htmlspecialchars($genre); 
            ?>">
            <label for="">Annee</label>
            <div class="year-input">
                    <input type="number" class="form-control" name="annee_min" placeholder="Année min" value="<?php 
                    // echo htmlspecialchars($annee_min); 
                    ?>">
                    <input type="number" class="form-control" name="annee_max" placeholder="Année max" value="<?php 
                    // echo htmlspecialchars($annee_max); 
                    ?>">
            </div>
            <div class="button">
                <button type="submit" class="btn btn-primary">Appliquer</button>
                <button type="reset" class="btn btn-secondary">Réinitialiser</button>
            </div>
        </form>
    </div>

    <div class="section-result">
        <div class="title-input">
            <!-- <div class=""> -->
                <input type="text" class="form-control" name="titre" placeholder="Titre" value="<?php 
                    // echo htmlspecialchars($titre); 
                ?>">
                <button type="submit" class="btn btn-primary">Rechercher</button>
                <button type="reset" class="btn btn-secondary">Réinitialiser</button>
        </div>
            
        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                <th scope="col">Titre</th>
                <th scope="col">Auteur</th>
                <th scope="col">Année</th>
                <th scope="col">Genre</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // if ($result->num_rows > 0) {
                // while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td>
                        La mort
                        <?php
                        //  echo htmlspecialchars($row["titre"]); 
                            ?>
                            </td>
                    <td>
                        Montaigne
                        <?php
                        //  echo htmlspecialchars($row["auteur"]); 
                            ?>
                            </td>
                    <td>
                        2024
                        <?php
                        //  echo htmlspecialchars($row["annee"]); 
                            ?>
                            </td>
                    <td>
                        Roman
                        <?php
                        //  echo htmlspecialchars($row["genre"]); 
                            ?>
                            </td>
                    <td>
                        Disponible
                        <?php
                        //  echo htmlspecialchars($row["status"]); 
                            ?>
                            </td>
                    <td>
                    <!-- <a href="edit.php?id=<?php echo urlencode($row["id"]); ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a> -->
                    <a href="" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                    <!-- <a href="delete.php?id=<?php echo urlencode($row["id"]); ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a> -->
                    <a href="" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        La mort
                        <?php
                        //  echo htmlspecialchars($row["titre"]); 
                            ?>
                            </td>
                    <td>
                        Montaigne
                        <?php
                        //  echo htmlspecialchars($row["auteur"]); 
                            ?>
                            </td>
                    <td>
                        2024
                        <?php
                        //  echo htmlspecialchars($row["annee"]); 
                            ?>
                            </td>
                    <td>
                        Roman
                        <?php
                        //  echo htmlspecialchars($row["genre"]); 
                            ?>
                            </td>
                    <td>
                        Disponible
                        <?php
                        //  echo htmlspecialchars($row["status"]); 
                            ?>
                            </td>
                    <td>
                    <!-- <a href="edit.php?id=<?php echo urlencode($row["id"]); ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a> -->
                    <a href="" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                    <!-- <a href="delete.php?id=<?php echo urlencode($row["id"]); ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a> -->
                    <a href="" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
                    </td>
                </tr>
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
