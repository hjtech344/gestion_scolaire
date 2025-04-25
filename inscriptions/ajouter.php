<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestion ecole</title>
        <link rel="stylesheet" href="../assets/css/bootstrap.css">

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
                <li>
                    <a class="d-flex align-items-center" href="../index.php">
                        <i class="fa fa-tachometer-alt"></i>
                        <span>Acceuil</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items-center" href="../eleves/index.php">
                        <i class="ri-group-line"></i>
                        <span>Eleves</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items-center" href="../classes/index.php">
                        <i class="ri-school-line"></i>
                        <span>Classes</span>
                    </a>
                </li>
                <li class="active">
                    <a class="d-flex align-items-center" href="../inscriptions/index.php">
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
                    <h2>Inscriptions</h2>
                </div>

                <div class="user-info d-flex align-items-center justify-content-between">
                    <div class="search-box d-flex align-items-center">
                        <i class="fa-solid fa-search"></i>
                        <input type="search" placeholder="Search">
                    </div>
                    <img src="../assets/images/user.png" alt="user">
                </div>
            </div>
            <!-- End Header nav -->

            <!-- section add student -->
                <div class="student-form my-5">
                    <h3 class="title fs-6 fw-light">
                        Veuillez remplir tous les champs du formulaire pour realiser une inscription
                    </h3>
                    <p class="title fw-semibold mb-4">
                        Nb : Tous les champs avec un asterique(<span class="text-danger">*</span>) sont requis
                    </p>

                    <!-- Section pour le travail backend -->
                        <?php
                            // Appelle de la base de donnée
                            require "../config/config.php";

                            if(isset($_POST['inscrire'])){
                                if(isset($_POST['eleve_id']) AND !empty($_POST['eleve_id'])
                                   AND isset($_POST['classe_id']) AND !empty($_POST['classe_id'])
                                   AND isset($_POST['date_inscription']) AND !empty($_POST['date_inscription'])
                                ){
                                    $eleve_id         = htmlspecialchars($_POST['eleve_id']);
                                    $classe_id        = htmlspecialchars($_POST['classe_id']);
                                    $date_inscription = htmlspecialchars($_POST['date_inscription']);

                                    // verifier si l'inscription existe deja
                                    $verifier_inscriptions = $PDO->prepare(
                                       "SELECT COUNT(*) 
                                        FROM `inscriptions`
                                        WHERE eleve_id = ? AND classe_id = ?
                                       "  
                                    );
                                    $verifier_inscriptions->execute([$eleve_id, $classe_id]);
                                    
                                    if($verifier_inscriptions->fetchColumn()){
                                       $warning_messages[] = "cette inscription est déjà effectué !";
                                    }else{
                                       $addInscription = $PDO->prepare(
                                           "INSERT INTO `inscriptions`(`eleve_id`, `classe_id`, `date_inscription`)
                                            VALUES(?,?,?)
                                           "  
                                        );
                                        $addInscription->execute([$eleve_id, $classe_id, $date_inscription]);
                                        $success_messages[] = "L'inscription a été reussi !";
                                    }
                                    

                                }else{
                                    ?>
                                        <div class="alert alert-danger text-center" role="alert">
                                          Tous les champs sont obligatoire a remplir !
                                        </div>
                                    <?php
                                }
                            }  
                        ?>
                    <!-- Fin section pour le travail backend -->
                    <div class="form-wrapper">
                        <form method="POST" action="" class="form-group">
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <label for="eleve_id" class="form-label">
                                        <span class="text-danger me-1">*</span>Élève
                                    </label>
                                    <select name="eleve_id" class="form-select" aria-label="Default select example">
                                        <option selected>Veuillez choisir un élève</option>
                                        <?php 
                                            $eleves = $PDO->prepare(
                                              "SELECT eleve_id, eleve_nom, eleve_prenom 
                                               FROM `eleves`
                                              "
                                            );
                                            $eleves->execute();
                                            
                                            if($eleves->rowCount() > 0){
                                                while($data = $eleves->fetch(PDO::FETCH_ASSOC)){
                                                    $eleve_id     = $data['eleve_id'];
                                                    $eleve_nom    = $data['eleve_nom'];
                                                    $eleve_prenom = $data['eleve_prenom'];
                                                 ?>
                                                    <option value="<?= $eleve_id ?>">
                                                      <?= $eleve_nom ?> <?= $eleve_prenom ?>
                                                    </option>
                                                <?php }
                                            }else{
                                              echo "Oup's il n'y a pas encore d'élèves pour l'instant";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label for="eleve_id" class="form-label">
                                        <span class="text-danger me-1">*</span>Classe
                                    </label>
                                    <select name="classe_id" class="form-select" aria-label="Default select example">
                                        <option selected>Veuillez choisir une classe</option>
                                        <?php
                                            $classes = $PDO->prepare(
                                               "SELECT * FROM `classes`"   
                                            );
                                            $classes->execute();
                                            
                                            if($classes->rowCount() > 0){
                                                while($data = $classes->fetch(PDO::FETCH_ASSOC)){
                                                    $classe_id  = $data['classe_id'];
                                                    $classe_nom = $data['classe_nom'];
                                                 ?>
                                                    <option value="<?= $classe_id ?>">
                                                      <?= $classe_nom ?>
                                                    </option>
                                                <?php }
                                            }else{
                                               echo "Oup's il n'y a pas encore de classes pour l'instant";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="nom_eleve" class="form-label"> 
                                        <span class="text-danger me-1">*</span>
                                        Date de l'inscription
                                    </label>
                                    <input type="datetime-local" name="date_inscription" 
                                       id="" class="form-control"
                                       placeholder="entrer la date de naissance de l'élève"
                                    > 
                                </div>
                            </div>

                            <div class="send d-flex justify-content-end mt-5">
                                <button type="submit" name="inscrire" class="btn btn-dark">
                                    Inscrire
                                </button>
                            </div>
                        </form>
                    </div>
                   
                </div>
            <!-- End section add student -->

        </div>
        <!-- Rigth section -->

        <!-- Link sweet alert -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" 
         integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
         crossorigin="anonymous" referrerpolicy="no-referrer">
        </script>

        <?php require '../components/alert.php';  ?>
        <!-- End Link sweet alert -->

        <script src="../assets/js/bootstrap.js" text="application/js"></script>
        <script src="../assets/js/bootstrap.bundle.min.js" text="application/js"></script>
    </body>
</html>




