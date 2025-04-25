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
                <li class="active">
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
                    <h2>Élèves</h2>
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
                    <!-- Section pour le travail backend -->
                    <?php 
                        // Appelle a la base de donnée
                        require "../config/config.php";
                        
                        if(isset($_GET['edit'])){
                            $eleve_id            = $_GET['edit'];
                            $selectEleveToUpdate = $PDO->prepare(
                               "SELECT * FROM `eleves` WHERE eleve_id = ?"  
                            );
                            $selectEleveToUpdate->execute([$eleve_id]);

                            $data              = $selectEleveToUpdate->fetch(PDO::FETCH_ASSOC);
                            $eleve_nom         = $data['eleve_nom'];
                            $eleve_prenom      = $data['eleve_prenom'];
                            $date_de_naissance = $data['date_de_naissance'];
                            
                            if(isset($_POST['modifier'])){
                                if(isset($_POST['nom']) AND !empty($_POST['nom'])
                                   AND isset($_POST['prenom']) AND !empty($_POST['prenom'])
                                   AND isset($_POST['date_de_naissance']) AND !empty($_POST['date_de_naissance'])
                                ){  
                                    $nom               = htmlspecialchars($_POST['nom']);
                                    $prenom            = htmlspecialchars($_POST['prenom']); 
                                    $date_de_naissance = htmlspecialchars($_POST['date_de_naissance']);
                                    
                                    $updatedEleve = $PDO->prepare(
                                       "UPDATE `eleves` SET eleve_nom = ?, eleve_prenom = ?, date_de_naissance = ?
                                        WHERE eleve_id = $eleve_id
                                       " 
                                    );

                                    $updatedEleve->execute([$nom, $prenom, $date_de_naissance]);
                                    $success_messages[] = "L'élève #".$_GET['edit']." a été bien modifié avec success";
                                    // header("Location : index.php");
                                } 
                            }
                        }
                       
                        
                    
                    ?>
                    <!-- End section pour le travail backend -->

                    <h3 class="title fs-6 fw-light">
                        Veuillez remplir tous les champs du formulaire pour modifier 
                        l'élève : <span class="fs-5 fw-semibold text-danger">N<sup>O</sup> <?= $_GET['edit'] ?></span>
                    </h3>
                    <p class="title fw-semibold mb-4">
                        Nb : Tous les champs avec un asterique(<span class="text-danger">*</span>)sont requis
                    </p>
                    
                    <div class="form-wrapper">
                        <form action="" method="post" class="form-group">
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <label for="nom_eleve" class="form-label"> 
                                        <span class="text-danger me-1">*</span>
                                        Nom élève
                                    </label>
                                    <input type="text" name="nom" value="<?= $eleve_nom ?>"
                                       id="" class="form-control"
                                       placeholder="Entrer le nom de l'élève"
                                    > 
                                </div>
                                <div class="col-lg-6">
                                    <label for="prenom_eleve" class="form-label">
                                        <span class="text-danger me-1">*</span>
                                        Prénom élève
                                    </label>
                                    <input type="text" name="prenom" value="<?= $eleve_prenom ?>"
                                       id="" class="form-control"
                                       placeholder="Entrer le prénom de l'élève"
                                    > 
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="date_de_naissance" class="form-label"> 
                                        <span class="text-danger me-1">*</span>
                                        Date de naissance
                                    </label>
                                    <input type="date" name="date_de_naissance" value="<?= $date_de_naissance ?>"
                                       id="" class="form-control"
                                       placeholder="Entrer la date de naissance de l'élève"
                                    > 
                                </div>
                            </div>

                            <div class="send d-flex justify-content-end mt-5">
                                <button type="submit" name="modifier" href="" class="btn btn-dark">modifier</button>
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




