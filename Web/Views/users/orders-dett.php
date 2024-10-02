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
                <?php if (isset($order_data) && $order_data) { ?>
                    <div class="lcuser_order">
                        <div class="lcuser_order_row">
                            <div class="lcuser_order_label">#</div>
                            <div class="lcuser_order_value"><?= $order_data->id ?></div>
                        </div>
                        <div class="lcuser_order_row">
                            <div class="lcuser_order_label">Data</div>
                            <div class="lcuser_order_value"><?= humanData($order_data->created_at) ?></div>
                        </div>
                        <div class="lcuser_order_row">
                            <div class="lcuser_order_label">Tipo</div>
                            <div class="lcuser_order_value"><?= $order_data->order_status_label ?></div>
                        </div>
                        <div class="lcuser_order_row">
                            <div class="lcuser_order_label">Stato Pagamento</div>
                            <div class="lcuser_order_value"><?= $order_data->payment_type_label ?>/<?= $order_data->payment_status_label ?></div>
                        </div>

                    </div>
                    <div class="lcuser_order_dati">
                        <div class="lcuser_order_dati_block">
                            <h6>Spedizione</h6>
                            <div class="lcuser_order_string">
                                <p>
                                    <?= $order_data->ship_name ?>
                                    <?= $order_data->ship_surname ?>
                                </p>
                                <p>
                                    <?= $order_data->ship_address ?>, <?= $order_data->ship_address_number ?><br />
                                    <?= $order_data->ship_zip ?> <?= $order_data->ship_city ?> (<?= $order_data->ship_district ?>) - <?= $order_data->ship_country ?>
                                </p>
                                <p>
                                    email: <?= $order_data->ship_email ?><br />
                                    <?= $order_data->ship_phone ?>
                                </p>
                                <p>
                                    <?= $order_data->ship_infos ?>
                                </p>
                            </div>
                        </div>
                        <div class="lcuser_order_dati_block">
                            <h6>Fatturazione</h6>
                            <div class="lcuser_order_string">
                                <p>
                                    <?= $order_data->pay_name ?> <?= $order_data->pay_surname ?>
                                    <?php if (isset($order_data->pay_fiscal) && trim($order_data->pay_fiscal) != '') { ?>
                                        <br /><?= $order_data->pay_fiscal ?>
                                    <?php } ?>
                                    <?php if (isset($order_data->pay_vat) && trim($order_data->pay_vat) != '') { ?>
                                        <br /><?= $order_data->pay_vat ?>
                                    <?php } ?>
                                </p>
                                <p>
                                    <?php if (isset($order_data->pay_address) && trim($order_data->pay_address) != '') { ?>
                                        <?= $order_data->pay_address ?>, <?= $order_data->pay_address_number ?><br />
                                    <?php } ?>
                                    <?= $order_data->pay_zip ?> <?= $order_data->pay_city ?> (<?= $order_data->pay_district ?>) - <?= $order_data->pay_country ?>
                                </p>
                                <p>
                                    email: <?= $order_data->pay_email ?><br />
                                    <?= $order_data->pay_phone ?>
                                </p>
                                <p>
                                    <?= $order_data->pay_infos ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="lcuser_order_dati">
                        <div class="lcuser_order_dati_block">
                            <h6>Totali</h6>
                            <div class="lcuser_order_totali">
                                <div class="lcuser_order_row">
                                    <div class="lcuser_order_label">Totale prodotti (iva inc.)</div>
                                    <div class="lcuser_order_value">€ <?= $order_data->total ?></div>
                                </div>
                                <div class="lcuser_order_row">
                                    <div class="lcuser_order_label">Spedizione</div>
                                    <div class="lcuser_order_value">€ <?= $order_data->spese_spedizione ?></div>
                                </div>
                                <div class="lcuser_order_row">
                                    <div class="lcuser_order_label">Totale</div>
                                    <div class="lcuser_order_value">€ <?= $order_data->pay_total ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if (isset($order_data->shop_order_items) && is_array($order_data->shop_order_items) && count($order_data->shop_order_items) > 0) { ?>
                        <section class="lcuser_order_items_list">
                            <h6>Prodotti</h6>
                            <div class="lcuser_order_items_list_rows">
                                <?php $conta_row = 0 ?>
                                <div class="lcuser_order_items_list_row lcuser_order_items_list_row_head">
                                    <div>Prodotto</div>
                                    <div>Quantità</div>
                                    <div>Prezzo</div>
                                </div>
                                <?php foreach ($order_data->shop_order_items as $order_item) { ?>
                                    <div class="lcuser_order_items_list_row <?= ($conta_row % 2 == 0) ? 'even' : 'odd' ?>">
                                        <div><?= $order_item->full_nome_prodotto ?></div>
                                        <div><?= $order_item->qnt ?></div>
                                        <div>€ <?= $order_item->prezzo ?></div>
                                    </div>
                                    <?php $conta_row++ ?>
                                <?php } ?>
                            </div>
                        </section>
                    <?php } else { ?>
                        <div class="user-module-main">
                            <?= h6('Nessun prodotto trovato') ?>
                        </div>
                    <?php } ?>

                <?php } else { ?>
                    <div class="alert alert-info">Nessun dato presente</div>
                <?php } ?>




            </div>
            <?= view(customOrDefaultViewFragment('users/components/sidebar', 'LcUsers')) ?>

        </div>
    </div>

</article>


<?= $this->endSection() ?>
<?= $this->section('footer_script') ?>
<style>

</style>
<script type="text/javascript">
    $(document).ready(function() {



    });
</script>
<?= $this->endSection() ?>