<div id="connecttoaccount" class="row register-form" style="display: none;">
        <div class="col-md-8 offset-md-2">
            <form class="custom-form" action='composent/database/login.php' method='POST'>
                <h1>Accéder à mes comptes</h1>
                <div class="form-row form-group">
                    <div class="col-sm-6 col-xl-12 offset-xl-0 input-column" style="text-align: center;">
                        <label for="email-input-field" style="text-align: center;">Email </label>
                        <input class="form-control" id='mailco' type='email' name='mail'>
                    </div>
                </div>
                <div class="form-row form-group" style="text-align: left;">
                    <div class="col-sm-4 col-xl-12 label-column" style="text-align: center;">
                        <label for="pawssword-input-field">Mot de passe</label>
                        <input class="form-control" type='password' name='pass'>
                    </div>
                </div>
                <button class="btn btn-light submit-button" type="submit">Se connecter</button>
            </form>
        </div>
</div>