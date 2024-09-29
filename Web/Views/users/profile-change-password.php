<?= $this->extend(customOrDefaultViewFragment('layout/body')) ?>
<?= $this->section('content') ?>
<article>
    <section class="lcshop-header">
        <div class="myIn">
            <hgroup>
                <?= h1($titolo) ?>
            </hgroup>
        </div>
    </section>
    <div class="row lcusers-content lcusers-content-profile">
        <div class="myIn lcusers-flex">
            <div class="lcusers-profile-form-cnt">
                <form method="post">
                    <?= getServerMessage() ?>
                    <?= csrf_field() ?>
                    <div class="form-row">
                        <div class="form-field form-field-1-2">
                            <label>Vecchia password</label>
                            <input type="password" name="old_password" value="<?= getReq('old_password') ?: '' ?>" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-field">
                            <label for="new_password">Nuova Password</label>
                            <input autocomplete="new-password" type="password" name="new_password" id="new_password" value="<?= getReq('new_password') ?>" />
                        </div>
                        <div class="form-field">
                            <label for="confirm_new_password">Nuova Conferma Password</label>
                            <input autocomplete="confirm_new_password-2" type="password" name="confirm_new_password" id="confirm_new_password" value="<?= getReq('confirm_new_password') ?>" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-field form-field_save_btn">
                            <button type="submit" name="action" value="save_new_password"><?= appLabel('Salva', $app->labels, true) ?></button>
                        </div>
                    </div>
                </form>
            </div>
            <?= view(customOrDefaultViewFragment('users/components/sidebar', 'LcUsers')) ?>
        </div>
</article>
<?= $this->endSection() ?>
<?= $this->section('footer_script') ?>
<?= $this->endSection() ?>