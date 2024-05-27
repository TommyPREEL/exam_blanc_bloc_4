<?php
    session_start();
    $token = $_SESSION['token'];
    require_once './composent/hidden/config.php';
    require_once "./composent/database/connect.php";
    require_once "./composent/database/accountscript.php";
    list($key , $keya, $firstnameencode, $typeencode, $keyb, $lastnameencode, $usernameencode) = explode("@",$_SESSION['token']);
            if (!base64_decode($typeencode) == "banker") {
                header("location:./index.php");
            }
            else {
                $testtoken = "SELECT * FROM token WHERE id = '$token' AND `type` = 'banker'";
                $reponse = $conn->query($testtoken);
                if ($reponse->num_rows > 0) {
                    while($row = $reponse->fetch_assoc()) {
                        $nowts = time() + 7200;
                        if ($nowts < $row['expiredat']){$bankerid = $row['idbanker'];
                        $time = $nowts;}
                        else {
                            $_SESSION['token'] = null;
                            $_SESSION['error'] = "Le token pour votre session est expiré, veuillez vous reconnecter";
                            header("location:./index.php");}
                    }
                }
                else{header("location:./logout.php");}
            }
    ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>0Bank - DASHBOARD Banquier</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
        <link rel="stylesheet" href="assets/footer.css">
        <link rel="stylesheet" href="assets/primary.css">
    </head>
    <body>
        <?php
            if (isset($_SESSION['error'])){require_once "./composent/template/ealerts.php";}
            if (isset($_SESSION['success'])){require_once "./composent/template/salerts.php";}
            require_once "./composent/template/header.php";
            $waitingclient = calc($conn, "requestnc", "idbanker = $bankerid AND validate = 0", "validate");
            $waitingclientab = calc($conn, "requestnc", "validate = 0", "validate");
            $clientvalid = calc($conn, "requestnc", "idbanker = $bankerid AND validate = 1", "validate");
            $nowm = date("m");
            $now = ("2021-".date("m")."-01");
            $onemonth = ("2021-".date("m")."-01");
            $clientmonth = calc($conn, "requestnc", "made BETWEEN '$now' AND ADDDATE('$now', INTERVAL 1 MONTH)", "validate");
            $totalclient = calc($conn, "requestnc", null, "validate");
            $validtoday = calc($conn, "requestnc", "idbanker = $bankerid AND validate = 1 AND valitime = NOW()", "validate");
            $benefat = calc($conn, "requestben", "idbanker = $bankerid AND validate = 0", "validate");
            $benefatall = calc($conn, "requestben", "validate = 0", "validate");
            $waitingbye = calc($conn, "requestnc", "idbanker = $bankerid AND askdelete = 1 AND `delete` = 0", "askdelete");
            $looseclient = calc($conn, "requestnc", "idbanker = $bankerid AND `delete` = 1", "`delete`");
            $todo = $waitingclient+$benefat+$waitingbye;
            if (!isset($waitingclient)){return false;}
            if (!isset($clientvalid)){return false;}

            ?>
        <main>
            <div id="wrapper" >
                <div class="d-flex flex-column" id="content-wrapper" style="background: #ffffff77;">
                    <div id="content">
                        <div class="container-fluid">
                            <div class="d-sm-flex justify-content-between align-items-center mb-4">
                                <h3 class="text-dark mb-0">TABLEAU DE BORD : BANQUIER</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-xl-3 mb-4">
                                    <div class="card shadow border-left-primary py-2">
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>NOUVEAU&nbsp;Client ce mois - ci</span></div>
                                                    <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $clientmonth; ?></span></div>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3 mb-4">
                                    <div class="card shadow border-left-success py-2">
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Client total</span></div>
                                                    <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $totalclient; ?></span></div>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-child fa-2x text-gray-300"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3 mb-4">
                                    <div class="card shadow border-left-info py-2">
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col-xl-9 mr-2">
                                                    <div class="text-uppercase text-info font-weight-bold text-xs mb-1"><span>A faire</span></div>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">
                                                            <div class="text-dark font-weight-bold h5 mb-0 mr-3"><span><?php echo $todo; ?></span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto col-xl-2"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3 mb-4">
                                    <div class="card shadow border-left-warning py-2">
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col-xl-10 mr-2">
                                                    <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>nouveau client</span></div>
                                                    <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $waitingclient; ?></span></div>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-male fa-2x text-gray-300"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-xl-4">
                                    <div class="card shadow mb-4">
                                        <div class="card-header d-flex justify-content-between align-items-center"><i class="far fa-user fa-2x text-gray-300"></i>
                                            <h6 class="text-primary font-weight-bold m-0">Clients</h6>
                                            <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                                <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in">
                                                    <p class="text-center dropdown-header">Clients</p><a class="dropdown-item" href="#">&nbsp;Voir les clients</a>
                                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#">Close</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-area"><canvas data-bss-chart="{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Validé aujourd'hui&quot;,&quot;A valider&quot;,&quot;Ancien client&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:[&quot;#4e73df&quot;,&quot;#1cc88a&quot;,&quot;#36b9cc&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;<?php echo $validtoday; ?>&quot;,&quot;<?php echo $waitingclient; ?>&quot;,&quot;<?php echo $clientvalid; ?>&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false},&quot;title&quot;:{}}}"></canvas></div>
                                            <div class="text-center small mt-4"><span class="mr-2"><i class="fas fa-circle text-primary"></i>&nbsp;Nouveau validé</span><span class="mr-2"><i class="fas fa-circle text-success"></i>&nbsp;Nouveau à valider</span><span class="mr-2"><i class="fas fa-circle text-info"></i>&nbsp;Ancien Client</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-xl-4">
                                    <div class="card shadow mb-4">
                                        <div class="card-header d-flex justify-content-between align-items-center"><i class="far fa-plus-square fa-2x text-gray-300"></i>
                                            <a href="./waitingclient.php"><h6 class="text-primary font-weight-bold m-0">Client à valider</h6></a>
                                            <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                                <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in">
                                                    <p class="text-center dropdown-header">Client en attente</p><a class="dropdown-item" href="./waitingclient.php">&nbsp;Voir les clients</a>
                                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#">Close</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Client à valider (tous banquier)</span></div>
                                                    <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $waitingclientab; ?></span></div>
                                                </div>
                                            </div>
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Client à valider (Personnel)</span></div>
                                                    <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $waitingclient; ?></span></div>
                                                </div>
                                            </div>
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Client validé aujourd'hui</span></div>
                                                    <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $validtoday; ?></span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-xl-4">
                                    <div class="card shadow mb-4">
                                        <div class="card-header d-flex justify-content-between align-items-center"><i class="far fa-money-bill-alt fa-2x text-gray-300"></i>
                                            <h6 class="text-primary font-weight-bold m-0">Bénéficiaire en attente</h6>
                                            <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                                <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in">
                                                    <p class="text-center dropdown-header">Bénéficiaire</p><a class="dropdown-item" href="./waitingbenef.php">Demandes</a>
                                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#">Close</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>En attente de validation ( Total )</span></div>
                                                    <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $benefatall; ?></span></div>
                                                </div>
                                            </div>
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>En attente de validation ( Personnel )</span></div>
                                                    <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $benefat; ?></span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-header d-flex justify-content-between align-items-center" style="height: 30px;color: rgb(133,135,150);background: rgba(248,249,252,0);border-style: none;border-top-style: none;border-right-style: none;border-bottom-style: none;border-left-style: none;"></div>
                                        <div class="card-header d-flex justify-content-between align-items-center"><i class="far fa-window-close fa-2x text-gray-300"></i>
                                            <h6 class="text-primary font-weight-bold m-0">Suppression de compte</h6>
                                            <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                                <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in">
                                                    <p class="text-center dropdown-header">Suppression en attente</p><a class="dropdown-item" href="./waitingdelete.php">Demandes en cours</a>
                                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#">Close</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span style="color: var(--red);">Demande en attente</span></div>
                                                    <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $waitingbye; ?></span></div>
                                                </div>
                                            </div>
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span style="color: var(--red);">Client Perdu</span></div>
                                                    <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $looseclient; ?></span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
            </div>
        </main> 
            
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
            <script src="./script.js"></script>
            <?php
            require_once "./composent/template/footer.php";
            $conn->close()
            ?>
    </body>
</html>

    