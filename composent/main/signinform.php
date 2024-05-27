<div id="openaccount" class="row register-form" style="display: none;">
        <div class="col-md-8 offset-md-2">
            <form class="custom-form" enctype="multipart/form-data" action="composent/database/signin.php" method="POST">
                <h1>Ouvrir mon compte</h1>
                <div class="form-row form-group">
                    <div class="col-sm-4 col-xl-5 label-column" style="text-align: left;">
                        <label for="lastname">Nom</label>
                        <input class="form-control" name="lastname" type="text" required="required">
                        <label for="firstname">Prénom</label>
                        <input class="form-control" name="firstname" type="text" required="required"></div>
                    <div class="col-xl-5 offset-xl-2" style="text-align: left;">
                        <label for="born">Date de naissance</label>
                            <input name="born" type="date" class="form-control" required="required">
                        </div>
                </div>
                <div class="form-row form-group">
                    <div class="col-sm-4 col-xl-7 label-column" style="text-align: left;">
                        <label for="adre">Adresse</label>
                        <input class="form-control" name="adre" type="text" required="required">
                    </div>
                    <div class="col-xl-5 offset-xl-0" style="text-align: left;">
                        <label for="pcode">Code Postal</label>
                        <input class="form-control" name="pcode" type="number" required="required">
                    </div>
                </div>
                <div class="form-row form-group">
                    <div class="col-sm-4 col-xl-12 label-column" style="text-align: left;">
                        <label for="pi">Pièce identité<br></label>
                        <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                        <input class="form-control-file" name="pi" type="file" accept="image/png, image/jpeg, .pdf" required="required">
                    </div>
                </div>
                <div class="form-row form-group">
                    <div class="col-sm-6 col-xl-7 offset-xl-0 input-column" style="text-align: left;">
                        <label for="mail">Email </label>
                        <input class="form-control" name="mail" type="email" required="required">
                    </div>
                </div>
                <div class="form-row form-group" style="text-align: left;">
                    <div class="col-sm-4 col-xl-5 label-column" style="text-align: left;">
                        <label for="pass">Mot de passe</label>
                        <input class="form-control" name="pass" type="password" required="required">
                    </div>
                    <div class="col-xl-5 offset-xl-2">
                        <label for="passverif">Confirmer</label>
                        <input class="form-control" name="passverif" type="password" required="required">
                    </div>
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="cguvalid" type="checkbox" id="formCheck-1">
                    <label class="form-check-label" for="cguvalid" required="required">J'accepte les conditions générales de vente, disponible ici : <a href="cgv.php" target="_Blank">CGV</a></label>
                </div>
                <button class="btn btn-light submit-button" type="submit">Ouvrir mon compte</button>
            </form>
        </div>
</div>
