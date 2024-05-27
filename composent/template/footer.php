<footer id="page-bottom" class="footer-dark">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-3 item">
                <?php if(!isset($_SESSION['token'])){ ?>
                    <h3>Compte en ligne</h3>
                    <ul>
                        <li><a onclick="setPage('sign');" href="#openaccount">Ouvrir mon compte</a></li>
                        <li><a onclick="setPage('log');" href="#connecttoaccount">Me connecter</a></li>
                        <li><a onclick="setPage('banker');" href="#banker">Accès interne</a></li>
                    </ul> 
                    <?php }
                    else {
                        list($key , $keya, $firstnameencode, $typeencode, $keyb, $lastnameencode, $usernameencode) = explode("@",$_SESSION['token']);
                        if (base64_decode($typeencode) == 'client'){
                            echo '<h3>Compte en ligne</h3>
                            <ul>
                                <li><a href="./account.php">Voir mon compte</a></li>
                                <li><a href="./virement.php">Virement</a></li>
                                <li><a href="./deleteaccount.php">Supprimer mon compte</a></li>
                            </ul>';
                        }
                    } ?>
                </div>
                <div class="col-sm-6 col-md-3 item">
                    <h3>A propos</h3>
                    <ul><?php 
                    if ($_SERVER['REQUEST_URI'] != '/index.php'){
                        if ($_SERVER['REQUEST_URI'] != '/'){ ?>
                            <li><a href="/index.php">Notre Banque</a></li>
                            <?php
                        }
                    }
                        ?>
                        <li><a href="cgv.php">Condition Général de vente</a></li>
                        <li><a href="#">Condition tarifaire</a></li>
                    </ul>
                </div>
                <div class="col-md-6 item text">
                    <h3>Notre Banque</h3>
                    <p>Nous sommes une banque nouvelle dans le secteur de la banque en ligne, notre volonté viens des frais trop élevé de la concurrence, nous somme donc sans frais et financé par nos clients.</p>
                </div>
            </div>
            <p class="copyright">ZeroBank # Training Correct Product Fake © 2023 TEST</p>
        </div>
    </footer>