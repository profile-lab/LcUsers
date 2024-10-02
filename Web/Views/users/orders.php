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
    <div class="row lcusers-content lcusers-content-orders">
        <div class="myIn lcusers-flex">
            <div class="lcusers-profile-form-cnt">
                <div class="user-module-main">
                    <?php if (isset($user_orders_list) && is_iterable($user_orders_list)) { ?>
                        <?= view(customOrDefaultViewFragment('shop/components/user-orders', 'LcShop')) ?>

                    <?php } else { ?>
                        <div class="alert alert-info">Nessun ordine presente</div>
                    <?php } ?>




                </div>

            </div>
            <?= view(customOrDefaultViewFragment('users/components/sidebar', 'LcUsers')) ?>
        </div>
    </div>


</article>


<?= $this->endSection() ?>
<?= $this->section('footer_script') ?>
<?= $this->endSection() ?>