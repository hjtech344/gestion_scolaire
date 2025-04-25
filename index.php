<?php
  require './config/config.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestion ecole</title>
        <link rel="stylesheet" href="./assets/css/bootstrap.css">

        <!-- Lien Font awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
         integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" 
         crossorigin="anonymous" referrerpolicy="no-referrer" 
        />
        <!-- Fin Lien Font awesome -->

        <!-- Lien remix-icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css" 
         integrity="sha512-kJlvECunwXftkPwyvHbclArO8wszgBGisiLeuDFwNM8ws+wKIw0sv1os3ClWZOcrEB2eRXULYUsm8OVRGJKwGA==" crossorigin="anonymous" 
         referrerpolicy="no-referrer" 
        />
        <!-- Lien remix-icon -->

    </head>
    <body>
        <!-- Sidebar -->
        <div class="sidebar position-sticky top-0 left-0 bottom-0 overflow-hidden">
            <div class="logo">IMTL</div>
            <ul class="menu position-relative p-0">
                <li class="active">
                    <a class="d-flex align-items-center" href="">
                        <i class="fa fa-tachometer-alt"></i>
                        <span>Acceuil</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items-center" href="./eleves/index.php">
                        <i class="ri-group-line"></i>
                        <span>Eleves</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items-center" href="./classes/index.php">
                        <i class="ri-school-line"></i>
                        <span>Classes</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items-center" href="./inscriptions/index.php">
                        <i class="ri-user-add-line"></i>
                        <span>Inscriptions</span>
                    </a>
                </li>
            </ul>
        </div>   
        <!-- End Sidebar -->

        <!-- Rigth section -->
        <div class="main-content position-relative w-100">
            <!-- Header nav -->
            <div class="header-wrapper d-flex align-items-center justify-content-between">
                <div class="header-title">
                    <span>Gestion ecole</span>
                    <h2>Acceuil</h2>
                </div>

                <div class="user-info d-flex align-items-center justify-content-between">
                    <div class="search-box d-flex align-items-center">
                        <i class="fa-solid fa-search"></i>
                        <input type="search" placeholder="Search">
                    </div>
                    <img src="./assets/images/user.png" alt="user">
                </div>
            </div>
            <!-- End Header nav -->

            <!-- Card Container -->
                <div class="card-container">
                    <h3 class="main-title mb-2">Today's data</h3>
                    <div class="card-wrapper d-flex justify-content-between flex-wrap">
                        <div class="row student-card d-flex justify-content-around bg-dark-subtle">
                            <div class="row d-flex justify-content-center align-items-center gap-3 flex-nowrap">
                                <div class="col-4 d-flex justify-content-center align-items-center 
                                   card-left bg-dark text-white rounded-circle"
                                >
                                <i role="button" class="fs-3 ri-group-line"></i>
                                </div>
 
                                <div class="col-8 d-flex align-items-center 
                                  card-right bg-light bg-transparent"
                                >
                                    <!-- Section travail pour le backend -->
                                    <?php
                                        // Appelle a la base de donnée
                                        require "./config/config.php";
                                        
                                        $countEleves = $PDO->prepare(
                                            "SELECT *
                                             FROM `eleves`
                                            "
                                        );
                                        $countEleves->execute();
                                        $totalEleves = $countEleves->rowCount();
                                    ?>
                                    <!-- Fin section travail pour le backend -->
                                    <span class="fw-semibold fs-5">
                                        <?= $totalEleves ?>
                                        <?= $totalClasses ?> 
                                        <?php 
                                            if($totalEleves > 1){
                                              ?>
                                              élèves
                                            <?php }else{
                                               ?>
                                                élève
                                            <?php }
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row student-card d-flex justify-content-around bg-info-subtle">
                            <div class="row d-flex justify-content-center align-items-center gap-3 flex-nowrap">
                                <div class="col-4 d-flex justify-content-center align-items-center 
                                   card-left bg-info text-white rounded-circle"
                                >
                                <i role="button" class="fs-3 ri-school-line"></i>
                                </div>
 
                                <div class="col-8 d-flex align-items-center 
                                  card-right bg-light bg-transparent"
                                >
                                   <!-- Section travail pour le backend -->
                                    <?php 
                                        $countClasses = $PDO->prepare(
                                            "SELECT * 
                                             FROM `classes`
                                            "  
                                        );
                                        $countClasses->execute();
                                        $totalClasses = $countClasses->rowCount();
                                    ?>
                                    <span class="fw-semibold fs-5">
                                        <?= $totalClasses ?> 
                                        <?php 
                                            if($totalClasses > 1){
                                              ?>
                                              classes
                                            <?php }else{
                                               ?>
                                               classe
                                            <?php }
                                        ?>
                                    </span>
                                    <!-- Fin section travail pour le backend -->
                                </div>
                            </div>
                        </div>

                        <div class="row student-card d-flex justify-content-around bg-success-subtle">
                            <div class="row d-flex justify-content-center align-items-center gap-3 flex-nowrap">
                                <div class="col-4 d-flex justify-content-center align-items-center 
                                   card-left bg-success text-white rounded-circle"
                                >
                                <i role="button" class="fs-3 ri-user-add-line"></i>
                                </div>
 
                                <div class="col-8 d-flex align-items-center 
                                  card-right bg-light bg-transparent"
                                >
                                    <!-- Section travail pour le backend -->
                                    <?php 
                                        $countInscrits = $PDO->prepare(
                                           "SELECT * 
                                            FROM `inscriptions`
                                           "
                                        );
                                        $countInscrits->execute();
                                        $totalInscrits = $countInscrits->rowCount();
                                    ?>
                                    <!-- Fin section travail pour le backend -->
                                    <span class="fw-semibold fs-5">
                                      <?= $totalInscrits ?>
                                        <?php 
                                            if($totalInscrits > 1){
                                              ?>
                                              inscrits
                                            <?php }else{
                                               ?>
                                               inscrit
                                            <?php }
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- End Card Container -->

            <!-- Table recents register -->
                <div class="table-recent-register">
                    <h3 class="main-title">Recents register</h3>
                    
                    <div class="table-container w-100">
                        <table>
                            <thead class="table-dark">
                                <tr>
                                    <th>#ID</th>
                                    <th>élèves</th>
                                    <th>classes</th>
                                    <th>date d'inscription</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $inscriptions = $PDO->prepare(
                                      "SELECT * 
                                       FROM `inscriptions`
                                       ORDER BY id desc
                                       LIMIT 5
                                      "
                                    );
                                    $inscriptions->execute();

                                    if($inscriptions->rowCount() >0){
                                        while($data = $inscriptions->fetch(PDO::FETCH_ASSOC)){
                                           $id               = $data['id'];
                                           $eleve_id         = $data['eleve_id'];
                                           $classe__id       = $data['classe_id'];
                                           $date_inscription = $data['date_inscription'];

                                            if($eleve_id){
                                                $eleves = $PDO->prepare(
                                                  "SELECT eleve_nom, eleve_prenom
                                                   FROM `eleves` 
                                                   WHERE eleve_id = ?
                                                  "
                                                );

                                                $eleves->execute([$eleve_id]);

                                                while($dataEleves = $eleves->fetch(PDO::FETCH_ASSOC)){
                                                   $eleve_nom    = $dataEleves['eleve_nom'];
                                                   $eleve_prenom = $dataEleves['eleve_prenom'];
                                                }
                                            }

                                            if($classe__id){
                                                $classes = $PDO->prepare(
                                                   "SELECT * 
                                                    FROM `classes`
                                                    WHERE classe_id = ? 
                                                   "
                                                );
                                                $classes->execute([$classe__id]);

                                                while($dataClasses = $classes->fetch(PDO::FETCH_ASSOC)){
                                                    $classe_nom = $dataClasses['classe_nom']; 
                                                }
                                            }
                 
                                           ?>

                                            <tr>
                                                <td><?= $id ?></td>
                                                <td><?= $eleve_nom ?> <?= $eleve_prenom ?></td>
                                                <td><?= $classe_nom ?></td>
                                                <td><?= $date_inscription ?></td>
                                            </tr>
                                                                 
                                        <?php }
                                    }else{
                                        ?>
                                            <span class="py-4 text-secondary fs-5 fw-semibold">
                                              Oup's la liste des incriptions recent est vide !
                                            </span>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <!-- End Table recents register -->
        </div>
        <!-- Rigth section -->

        <script src="./assets/js/bootstrap.js" text="application/js"></script>
        <script src="./assets/js/bootstrap.bundle.min.js" text="application/js"></script>
    </body>
</html>




