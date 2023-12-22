<?= $this->extend($base_view_folder . 'layout/body') ?>
<?= $this->section('content') ?>
<article>
    <div class="row row-form row-form-signup">
        <div class="myIn">
            <div class="user-dashboard-header">
                <?= h2(appLabel('Dashboard', $app->labels, true), 'user-dashboard-title') ?>
            </div>
            <div class="user-dashboard-module">
                <div class="user-dashboard-form-cnt">
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
                            <div class="form-field">
                                <label>Località</label>
                                <input type="text" name="city" value="<?= getReq('city') ?: $user_data->city ?>" />
                            </div>
                            <div class="form-field">
                                <label>Cap</label>
                                <input type="text" name="cap" value="<?= getReq('cap') ?: $user_data->cap ?>" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-field">
                                <label>Via/Piazza</label>
                                <input type="text" name="address" value="<?= getReq('address') ?: $user_data->address ?>" />
                            </div>
                            <div class="form-field">
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