<header id="page-top">
<nav class="navbar navbar-light navbar-expand-md navigation-clean" style="padding: 0px;background: rgba(50,59,66,0.17);">
<div class="container">
<div><a class="navbar-brand" onclick="setPage('main');" href="#mainnoauth"></a><img src="assets/component/BankOn.png" style="width: 150px;"><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button></div>
<div class="collapse navbar-collapse" id="navcol-1">
<ul class="navbar-nav ml-auto" style="text-align: right;">
<?php 
    if ($_SERVER['REQUEST_URI'] != '/index.php'){
      if ($_SERVER['REQUEST_URI'] != '/'){
        ?>
        <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
        <?php
      }
    }
    ?>
    <li class="nav-item" id="nav-home" style="display: none;"><a class="nav-link" onclick="setPage('main');" href="#">Retour</a></li>
    <?php
    function noauth(){?>
                    <li class="nav-item"><a class="nav-link" onclick="setPage('sign');" href="#openaccount">Ouvrir mon compte</a></li>
                    <li class="nav-item"><a class="nav-link" onclick="setPage('log');" href="#connecttoaccount">Connexion</a></li>
                <?php
    };
      if (isset($_SESSION['token'])){ 
        list($key , $keya, $firstnameencode, $typeencode, $keyb, $lastnameencode, $usernameencode) = explode("@",$_SESSION['token']);
        if (base64_decode($typeencode) == "client") { ?>
                      <li class="nav-item"><a class="nav-link" href="./../../account.php">Mes comptes</a></li>
                      <li class="nav-item"><a class="nav-link" href="./../../virement.php">Virement&nbsp;</a></li>
                      <li class="nav-item dropdown show"><a class="dropdown-toggle nav-link" aria-expanded="true" data-toggle="dropdown" style="padding:10px;" href="#"><?php echo base64_decode($lastnameencode)." ".base64_decode($firstnameencode)?></a>
                          <div class="dropdown-menu show" style="background: rgba(255,255,255,0.45);"><a class="dropdown-item" href="logout.php">Se déconnecter<i class="fa fa-user-times" id="logouticon"></i></a></div>
                      </li>
                   <?php
        }
        elseif (base64_decode($typeencode) == "banker") {?>
                        <li class="nav-item"><a class="nav-link" href="./banker.php">Tableau de bord</a></li>
                        <li class="nav-item"><a class="nav-link" href="./waitingclient.php">Client en attente</a></li>
                        <li class="nav-item"><a class="nav-link" href="./waitingbenef.php">Bénéficiaire</a></li>
                        <li class="nav-item dropdown show"><a class="dropdown-toggle nav-link" aria-expanded="true" data-toggle="dropdown" style="padding:10px;" href="#"><?php echo base64_decode($lastnameencode)." ".base64_decode($firstnameencode)?></a>
                            <div class="dropdown-menu show" style="background: rgba(255,255,255,0.45);"><a class="dropdown-item" href="logout.php">Se déconnecter<i class="fa fa-user-times" id="logouticon"></i></a></div>
                        </li>
                    <?php
        }
        elseif (base64_decode($typeencode) == "waiting") {?>
                        <li class="nav-item"><h2 class="nav-link">Demande en cours de validation par nos services</h2></li>
                        <li class="nav-item dropdown show"><a class="dropdown-toggle nav-link" aria-expanded="true" data-toggle="dropdown" style="padding:10px;" href="#"><?php echo base64_decode($lastnameencode)." ".base64_decode($firstnameencode)?></a>
                            <div class="dropdown-menu show" style="background: rgba(255,255,255,0.45);"><a class="dropdown-item" href="logout.php">Se déconnecter<i class="fa fa-user-times" id="logouticon"></i></a></div>
                        </li>
                        <?php
        }
        else {
          noauth();
        }
      }else {
        noauth();
      }
    ?>
                  </ul>
              </div>
          </div>
        </nav>
<header>
