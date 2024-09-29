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
                        <div class="form-field">
                            <label>Nome</label>
                            <input type="text" name="name" value="<?= getReq('name') ?: $user_data->name ?>" />
                        </div>
                        <div class="form-field">
                            <label>Cognome</label>
                            <input type="text" name="surname" value="<?= getReq('surname') ?: $user_data->surname ?>" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-field">
                            <label>Stato</label>
                            <input type="text" name="country" value="<?= getReq('country') ?: $user_data->country ?>" />
                        </div>
                        <div class="form-field">
                            <label>Provincia</label>
                            <input type="text" name="district" value="<?= getReq('district') ?: $user_data->district ?>" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-field form-field-2-3">
                            <label>Località</label>
                            <input type="text" name="city" value="<?= getReq('city') ?: $user_data->city ?>" />
                        </div>
                        <div class="form-field form-field-1-3">
                            <label>Cap</label>
                            <input type="text" name="cap" value="<?= getReq('cap') ?: $user_data->cap ?>" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-field form-field-3-4">
                            <label>Via/Piazza</label>
                            <input type="text" name="address" value="<?= getReq('address') ?: $user_data->address ?>" />
                        </div>
                        <div class="form-field form-field-1-4">
                            <label>Civico</label>
                            <input type="text" name="street_number" value="<?= getReq('street_number') ?: $user_data->street_number ?>" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-field form-field_save_btn">
                            <button type="submit" name="action" value="save_account_data"><?= appLabel('Salva', $app->labels, true) ?></button>
                        </div>
                    </div>
                </form>




            </div>
            <?= view(customOrDefaultViewFragment('users/components/sidebar', 'LcUsers')) ?>
        </div>

</article>


<?= $this->endSection() ?>
<?= $this->section('footer_script') ?>

<script type="text/javascript">
    $(document).ready(function() {



    });
</script>
<?= $this->endSection() ?>