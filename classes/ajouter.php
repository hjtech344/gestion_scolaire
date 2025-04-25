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
                <li class="active">
                    <a class="d-flex align-items-center" href="../classes/index.php">
                        <i class="ri-school-line"></i>
                        <span>Classes</span>
                    </a>
                </li>
                <li>
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
                    <h2>Classes</h2>
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
                        Veuillez remplir tous les champs du formulaire pour ajouter une classe
                    </h3>
                    <p class="title fw-semibold mb-4">
                        Nb : Tous les champs avec un asterique(<span class="text-danger">*</span>) sont requis
                    </p>

                    <!-- Section pour le travail backend -->
                    <?php 
                        // Applelle a la base de donnée
                        require "../config/config.php";
                        
                        if(isset($_POST['ajouter'])){
                            if(isset($_POST['classe_nom']) AND !empty($_POST['classe_nom'])){
                                $classe_nom = htmlspecialchars($_POST['classe_nom']);

                                $addClasse  = $PDO->prepare(
                                    "INSERT INTO `classes`(`classe_nom`)
                                     VALUES(?)
                                    "  
                                ); 
                                $addClasse->execute([$classe_nom]);
                                $success_messages[] = "La classe a été bien ajouté";
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
                                <div class="col-lg-12">
                                    <label for="eleve_id" class="form-label">
                                        <span class="text-danger me-1">*</span>
                                        Nom classe
                                    </label>
                                    <input type="text" name="classe_nom" 
                                       id="" class="form-control"
                                       placeholder="Entrer le nom de la classe"
                                    > 
                                </div>
                            </div>


                            <div class="send d-flex justify-content-end mt-5">
                                <button type="submit" name="ajouter" href="" class="btn btn-dark">
                                    Ajouter
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




