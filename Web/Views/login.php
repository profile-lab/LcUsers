<?= $this->extend($base_view_folder . 'layout/body') ?>
<?= $this->section('content') ?>
<article>
    <div class="row row-form row-form-signup">
        <div class="myIn">
            <div class="login-signup-header">
                <?= h2(appLabel('Login', $app->labels, true), 'login-signup-title') ?>
            </div>
            <div class="login-signup-module">
                <div class="login-signup-form-cnt">
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
                </div>
                <div class="login-signup-altenative-cnt">
                    <?= h4(appLabel('Non sei ancora registrato?', $app->labels, true), 'login-signup-alternative-title') ?>
                    <?= cta((route_to('web_signup') . (($request->getGet('returnTo')) ? '?returnTo=' . urlencode($request->getGet('returnTo')) : '')), appLabel('Registrati adesso', $app->labels, true), 'login-signup-alternative-link') ?>
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