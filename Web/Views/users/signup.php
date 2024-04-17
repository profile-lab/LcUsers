<?= $this->extend(customOrDefaultViewFragment('layout/body')) ?>
<?= $this->section('content') ?>
<article>
    <div class="row row-form row-form-signup">
        <div class="myIn">
            <div class="login-signup-header">
                <?= h2(appLabel('Registrati', $app->labels, true), 'login-signup-title') ?>
            </div>
            <div class="login-signup-module">
                <div class="login-signup-form-cnt">
                    <form method="post" class="login-signup-form" action="#signupform" id="signupform">
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
                                <label for="new_password">Password</label>
                                <input autocomplete="new-password" type="password" name="new_password" id="new_password" value="<?= getReq('new_password') ?>" />
                            </div>
                            <div class="form-field">
                                <label for="confirm_new_password">Conferma Password</label>
                                <input autocomplete="confirm_new_password-2" type="password" name="confirm_new_password" id="confirm_new_password" value="<?= getReq('confirm_new_password') ?>" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-field form-field_checkbox">
                                <label class="label_checkbox" for="t_e_c"><input type="checkbox" name="t_e_c" id="t_e_c" value="1" <?= (getReq('t_e_c')) ? 'checked' : '' ?> /> <span>Ho letto, compreso e accettato i termini e condizioni e <a href="<?= site_url('privacy-policy') ?>">l'informativa privacy</a> relativa al trattamento dei miei dati personali (obbligatorio)</span></label>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-field form-field_sign_up_btn">
                                <button type="submit" name="action" value="signup"><?= appLabel('Registrati', $app->labels, true) ?></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="login-signup-altenative-cnt">
                    <?= h4(appLabel('Sei già registrato?', $app->labels, true), 'login-signup-alternative-title') ?>
                    <?= cta(route_to('web_login'), appLabel('Accedi', $app->labels, true), 'login-signup-alternative-link') ?>
                </div>
            </div>
        </div>

</article>


<?= $this->endSection() ?>
<?= $this->section('footer_script') ?>

<script type="text/javascript">
    $(document).ready(function() {



    });
</script>
<?= $this->endSection() ?>