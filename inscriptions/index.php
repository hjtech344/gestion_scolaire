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

        <!-- Lien jquery -->
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <!-- Fin Lien jquery -->

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
                <div class="add-student d-flex justify-content-between mt-5 mb-4">
                    <h3 class="title">Listes des inscriptions</h3>
                    <div>
                       <a class="btn-add" href="ajouter.php">Register student</a>
                    </div>
                </div>
            <!-- End section add student -->

            <!-- Table List student's -->
                <div class="table-recent-register heigth overflow-auto">
                    <div class="add-student d-flex justify-content-between mb-2">
                        <h3 class="main-title">Listes des élèves inscrits</h3>
                        <form action="" method="POST">
                            <button class="btn btn-success btn-sm d-flex gap-2
                             align-items-center" type="submit" name="exporter">
                               <i class="fa-solid fa-upload"></i>exporter vers excel
                            </button>
                        </form>
                    </div>
                    <?php
                     //Appelle a la base de donnée
                     require "../config/config.php";   
                    ?>
                    <div class="table-container w-100">
                        <table>
                            <thead class="table-dark">
                                <tr>
                                    <th>#ID</th>
                                    <th>élèves</th>
                                    <th>classes</th>
                                    <th>date d'inscription</th>
                                    <th class="text-center">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $inscriptions = $PDO->prepare(
                                      "SELECT * FROM `inscriptions`"
                                    ); 
                                    $inscriptions->execute();

                                    if($inscriptions->rowCount() >0){
                                        while($data = $inscriptions->fetch(PDO::FETCH_ASSOC)){
                                           $inscriptions_to_export[] = $data;

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
                                
                                            
                                            if(isset($_POST['exporter'])){
                                                // $fields = ["ID", "ELEVE NOM ET PRENOM", "CLASSE NOM", "DATE INSCRIPTION"];
                                                // $filename = "inscriptions-". date("Y-m-d") . ".xls";

                                               
                                                // header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
                                                // header("Content-Disposition: attachment; filename=\"$filename\"");
    
                                                
                                                // $output = fopen("php://output", "w");

                                                // fputcsv($output, $fields, "\t");

                                                // foreach ($inscriptions_to_export as $row) {
                                                //     // echo "<pre>";
                                                //     //   var_dump($row);
                                                //     // echo "</pre>";
                                                //     fputcsv($output, $row, "\t");
                                                // }

                                                // fclose($output);
                                                // exit;     
                                            }
                                           ?>

                                            <tr>
                                                <td><?= $id ?></td>
                                                <td><?= $eleve_nom ?> <?= $eleve_prenom ?></td>
                                                <td><?= $classe_nom ?></td>
                                                <td><?= $date_inscription ?></td>
                                                <td>
                                                    <div class="d-flex gap-4 justify-content-center">
                                                        <!-- <div class="pencil bg-success-subtle d-flex 
                                                           align-items-center justify-content-center rounded-circle"
                                                        >
                                                           <a href=""><i class="fa-solid fa-pencil text-success"></i></a> 
                                                        </div> -->
                                            
                                                        <div class="trash bg-danger-subtle d-flex 
                                                           align-items-center justify-content-center rounded-circle"
                                                        >
                                                            <input type="hidden" class="inscription_id" value="<?= $id ?>">
                                                            <a href="javascript:void(0)">
                                                                <i class="btn-register-destroy-ajax fa-solid fa-trash text-danger"></i>
                                                            </a> 
                                                        </div> 
                                                    </div>
                                                </td>
                                            </tr>
                                                                 
                                        <?php }
                                    }else{
                                        ?>
                                            <span class="py-4 text-secondary fs-5 fw-semibold">
                                              Oup's il n'y a pas encore d'inscription pour l'instant !
                                            </span>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <!-- End Table List student's  -->
        </div>
        <!-- Rigth section -->

        <!-- Link sweet alert -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" 
              integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
              crossorigin="anonymous" referrerpolicy="no-referrer">
            </script>
        <!-- End Link sweet alert -->

        <script src="../assets/js/bootstrap.js" text="application/js"></script>
        <script src="../assets/js/bootstrap.bundle.min.js" text="application/js"></script>
    </body>
</html>


