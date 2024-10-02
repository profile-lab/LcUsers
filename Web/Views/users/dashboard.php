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
    <div class="row lcusers-content lcusers-content-dashboard">
        <div class="myIn lcusers-flex">
            <div class="lcusers-profile-form-cnt">
                <div class="user-module-main">
                    <?= h4($user_welcome, 'user-welcome-mess') ?>
                </div>
                <?php if (isset($latest_user_orders)) { ?>
                    <?php if (is_array($latest_user_orders) && count($latest_user_orders) > 0) { ?>
                        <div class="user-module-main">
                            <h6>I tuoi ultimi ordini</h6>
                            <?= view(customOrDefaultViewFragment('shop/components/user-orders', 'LcShop')) ?>
                        </div>
                    <?php } else { ?>
                        <div class="user-module-main">
                            <?= h4($no_orders, 'user-welcome-mess') ?>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <?= view(customOrDefaultViewFragment('users/components/sidebar', 'LcUsers')) ?>
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