<form method="post" class="login-signup-form" action="#loginform" id="loginform">
    <?= getServerMessage() ?>
    <?php /*
    <?php if (isset($form_result) && isset($form_result->user_mess)) { ?>
    <div class="form-mess form-mess-<?= $form_result->user_mess->type ?>">
        <?= h5($form_result->user_mess->title) ?>
        <?= h6(isset($form_result->user_mess->subtitle) ? $form_result->user_mess->subtitle : null) ?>
        <div class="form-mess-content"><?= $form_result->user_mess->content ?></div>
    </div>
    <?php } ?>
    */ ?>
    <?= csrf_field() ?>
    <div class="form-row">
        <div class="form-field">
            <label for="email">Email </label>
            <input autocomplete="new-email" type="email" name="email" id="email" value="<?= getReq('email') ?>" />
        </div>
    </div>
    <div class="form-row">
        <div class="form-field">
            <label for="password">Password</label>
            <input autocomplete="new-password" type="password" name="password" id="password" value="<?= getReq('password') ?>" />
        </div>
    </div>
    <div class="form-row">
        <div class="form-field form-field_sign_up_btn">
            <button type="submit" name="action" value="login"><?= appLabel('Entra', $app->labels, true) ?></button>
        </div>
    </div>
</form>