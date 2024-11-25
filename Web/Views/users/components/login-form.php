<div class="lcusers-login-form-cnt">
    <?= h4(langLabel('Utente registrato'), 'lcusers-login-form-title') ?>
    <?= h5(langLabel('Usa le tue credeziali per accedere.'), 'lcusers-login-form-title') ?>
    <form method="post" class="lcusers-login-form" action="#loginform" id="loginform">
        <?= getServerMessage() ?>
        <?= csrf_field() ?>
        <div class="form-row">
            <div class="form-field">
                <label for="email">Email </label>
                <input type="email" name="email" id="email" value="<?= getReq('email') ?>" />
            </div>
        </div>
        <div class="form-row">
            <div class="form-field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" value="<?= getReq('password') ?>" />
            </div>
        </div>
        <div class="form-row">
            <div class="form-field form-field_sign_up_btn">
                <button type="submit" name="action" value="login"><?= appLabel('Accedi', $app->labels, true) ?></button>
            </div>
        </div>
    </form>
</div>