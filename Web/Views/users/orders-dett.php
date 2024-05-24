<?= $this->extend(customOrDefaultViewFragment('layout/body')) ?>
<?= $this->section('content') ?>
<article>
    <div class="row row-user row-user">
        <div class="myIn">
            <header class="user-header">
                <?= h1(appLabel($titolo, $app->labels, true), 'user-title') ?>
            </header>
            <div class="user-module">
                <div class="user-module-main">
                    <?php if (isset($order_data) && $order_data) { ?>
                        <div class="order_dett">
                            <div class="order_dett_row">
                                <div class="order_dett_label">Numero ordine</div>
                                <div class="order_dett_value"><?= $order_data->id ?></div>
                            </div>
                            <div class="order_dett_row">
                                <div class="order_dett_label">Data</div>
                                <div class="order_dett_value"><?= humanData($order_data->created_at) ?></div>
                            </div>
                            <div class="order_dett_row">
                                <div class="order_dett_label">Tipo</div>
                                <div class="order_dett_value"><?= $order_data->order_status_label ?></div>
                            </div>
                            <div class="order_dett_row">
                                <div class="order_dett_label">Stato Pagamento</div>
                                <div class="order_dett_value"><?= $order_data->payment_type_label ?>/<?= $order_data->payment_status_label ?></div>
                            </div>
                            
                        </div>
                        <div class="order_dett_spedizioni">
                            <div class="order_dett_row order_dett_row_full">
                                <div class="order_dett_label">Spedizione <b><?= $order_data->spedizione_name ?></b></div>
                                <div class="order_dett_string">
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
                        </div>
                        <div class="order_dett_spedizioni">
                            <div class="order_dett_row order_dett_row_full">
                                <div class="order_dett_label">Fatturazione</div>
                                <div class="order_dett_string">
                                    <p>
                                        <?= $order_data->pay_name ?>
                                        <?= $order_data->pay_surname ?><br />
                                        <?= $order_data->pay_fiscal ?><br />
                                        <?= $order_data->pay_vat ?>
                                    </p>
                                    <p>
                                        <?= $order_data->pay_address ?>, <?= $order_data->pay_address_number ?><br />
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
                        <div class="order_dett_totali">
                            <div class="order_dett_row">
                                <div class="order_dett_label">Totale prodotti (iva inc.)</div>
                                <div class="order_dett_value">€ <?= $order_data->total ?></div>
                            </div>
                            <div class="order_dett_row">
                                <div class="order_dett_label">Spedizione</div>
                                <div class="order_dett_value">€ <?= $order_data->spese_spedizione ?></div>
                            </div>
                            <div class="order_dett_row">
                                <div class="order_dett_label">Totale</div>
                                <div class="order_dett_value">€ <?= $order_data->pay_total ?></div>
                            </div>
                        </div>




                        <?php if (isset($order_data->shop_order_items) && is_iterable($order_data->shop_order_items)) { ?>
                            <div class="lista_ordini_utente">
                                <table class="orders_list_table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Prodotto</th>
                                            <th>Quantità</th>
                                            <th>Prezzo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($order_data->shop_order_items as $order_item) { ?>

                                            <tr class="order_item">
                                                <td><?= $order_item->id ?></td>
                                                <td>
                                                    <?= $order_item->full_nome_prodotto ?>
                                                </td>
                                                <td>
                                                    <?= $order_item->qnt ?>
                                                </td>
                                                <td>
                                                    € <?= $order_item->prezzo ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="alert alert-info">Nessun dato presente</div>
                    <?php } ?>




                </div>
                <aside class="sidebar user_sidebar ">
                    <?= view(customOrDefaultViewFragment('users/components/sidebar', 'LcUsers')) ?>
                </aside>

            </div>
        </div>

</article>


<?= $this->endSection() ?>
<?= $this->section('footer_script') ?>
<style>
    .order_dett {
        display: grid;
        grid-template-columns: 1fr 1fr;
        justify-items: stretch;
        align-items: center;
        padding: .5rem 0 2rem 0;
    }

    .order_dett_totali {
        display: grid;
        grid-template-columns: 1fr;
        justify-items: stretch;
        align-items: center;
        padding: .5rem 0 2rem 0;
    }

    .order_dett_row {
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-between;
        align-items: center;
        padding: .3rem .5rem;
        margin: 0 1rem 1rem 0;
        border-bottom: #F5f5f5 1px solid;
    }
    .order_dett_row_full{
        display: block;
    }

    .order_dett_label {
        width: 50%;
    }

    .order_dett_value {
        width: 50%;
        font-weight: bold;

    }

    .orders_list_table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .orders_list_table tr th {
        background: #F5f5f5;
        border-left: 1px solid #FFF;
        padding: .3rem .5rem;
    }

    .orders_list_table tr td {
        background: #FFF;
        border-left: 1px solid #FFF;
        padding: .3rem .5rem;
        border-bottom: 1px solid #f5f5f5;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {



    });
</script>
<?= $this->endSection() ?>