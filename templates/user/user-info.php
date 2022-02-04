<?php
use App\Database\Database;
use App\Database\Entities\Shop;
use App\SecurityManager;
$user = SecurityManager :: getUser();
?>
<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-12 col-lg-6">
        <h1 class="ms-3 my-3">I tuoi dati</h1>
        <div class="card px-4 pt-5 pb-3">
            <form class="mb-3" method="POST" action="/user/update">
                <div class="mb-3">
                    <label for="input-name" class="form-label">Nome</label>
                    <input id="input-name" name="name" type="text" class="form-control" 
                          <?php  if(!is_null($user)) {echo("placeholder=".$user->getFirstName());}
                           if (isset($template['name'])) echo "value=\"${template['name']}\"" ?> />
                </div>
                <div class="mb-3">
                    <label for="input-lastname" class="form-label">Cognome</label>
                    <input id="input-lastname" name="lastname" type="text" class="form-control" 
                    <?php  if(!is_null($user)) {echo("placeholder=".$user->getLastName());}
                             if (isset($template['lastname'])) echo "value=\"${template['lastname']}\"" ?> />
                </div>
                <div class="mb-3">
                    <label for="input-email" class="form-label">Email</label>
                    <input id="input-email" name="email" type="email" class="form-control"
                            <?php if(!is_null($user)) {echo("placeholder=".$user->getEmail());} if (isset($template['email'])) echo "value=\"${template['email']}\"" ?> />
                </div>
                <div class="mb-3">
                    <label for="input-password" class="form-label">Password</label>
                    <input id="input-password" name="password" type="password" class="form-control" placeholder="Password"/>
                </div>
                <button type="submit" class="btn btn-primary">Salva modifiche</button>
            </form>
    </div>
    <div class="col-lg-3"></div>
</div>