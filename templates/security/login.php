<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-12 col-lg-6">
        <h1 class="ms-3 my-3">Login</h1>
        <div class="card px-4 pt-5 pb-3">
            <form class="mb-3" method="POST" action="/login">
                <div class="mb-3">
                    <label for="input-email" class="form-label">Email</label>
                    <input id="input-email" name="email" type="email" class="form-control"
                           placeholder="Email"
                           required <?php if (isset($template['email'])) echo "value=\"${template['email']}\"" ?> />
                </div>
                <div class="mb-3">
                    <label for="input-password" class="form-label">Password</label>
                    <input id="input-password" name="password" type="password" class="form-control"
                           placeholder="Password" required/>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="remember-me" name="rememberMe">
                    <label class="form-check-label" for="remember-me">
                        Ricordami
                    </label>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
            <hr/>
            <div class="text-center mt-3 col-12">
                <h2>Non hai ancora un account?</h2>
                <a href="/registration" class="btn btn-primary">Registrati</a>
            </div>
        </div>
    </div>
    <div class="col-lg-3"></div>
</div>