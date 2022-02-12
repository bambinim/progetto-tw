<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-12 col-lg-6">
        <h1 class="ms-3 my-3">Registrazione</h1>
        <div class="card px-4 pt-5 pb-3">
            <form class="mb-3" method="POST" action="/registration">
                <div class="mb-3">
                    <label for="input-first-name" class="form-label">Nome</label>
                    <input id="input-first-name" name="firstName" type="text" class="form-control"
                           placeholder="Nome"
                           required <?php if (isset($template['firstName'])) echo "value=\"${template['firstName']}\"" ?> />
                </div>
                <div class="mb-3">
                    <label for="input-last-name" class="form-label">Cognome</label>
                    <input id="input-last-name" name="lastName" type="text" class="form-control"
                           placeholder="Cognome"
                           required <?php if (isset($template['lastName'])) echo "value=\"${template['lastName']}\"" ?> />
                </div>
                <div class="mb-3">
                    <label for="input-email" class="form-label">Email</label>
                    <input id="input-email" name="email" type="email" class="form-control"
                           placeholder="Email"
                           required <?php if (isset($template['email'])) echo "value=\"${template['email']}\"" ?> />
                </div>
                <div class="mb-3">
                    <label for="input-password" class="form-label">Password</label>
                    <input id="input-password" name="password" type="password" class="form-control"
                           placeholder="Password"
                           required <?php if (isset($template['password'])) echo "value=\"${template['password']}\"" ?> />
                </div>
                <div class="mb-3">
                    <label for="input-password2" class="form-label">Conferma Password</label>
                    <input id="input-password2" name="password2" type="password" class="form-control"
                           placeholder="Conferma Password"
                           required <?php if (isset($template['password2'])) echo "value=\"${template['password2']}\"" ?> />
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="" id="input-use-terms" name="acceptUseTerms"
                           required>
                    <label class="form-check-label" for="input-use-terms">
                        Accetto i termini e le condizioni di utilizzo
                    </label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="" id="input-policy-privacy"
                           name="acceptPrivacyPolicy" required>
                    <label class="form-check-label" for="input-policy-privacy">
                        Accetto le policy sulla privacy
                    </label>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Registrati</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-3"></div>
</div>