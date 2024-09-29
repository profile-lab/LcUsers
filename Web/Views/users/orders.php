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
                    <?php if (isset($user_orders_list) && is_iterable($user_orders_list)) { ?>
                        <div class="lista_ordini_utente">
                            <table class="orders_list_table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Data</th>
                                        <th>Tipo</th>
                                        <th>Stato Pagamento</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($user_orders_list as $order) { ?>

                                        <tr class="order_row order_row_status_<?= $order->order_status ?>">
                                            <td><?= $order->id ?></td>

                                            <td><small><?= humanData($order->created_at) ?></small></td>
                                            <td>
                                                <?= $order->order_status_label ?>
                                            </td>
                                            <td>
                                                <small><?= $order->payment_type_label ?>/<?= $order->payment_status_label ?></small>
                                            </td>
                                            <td>
                                                <?php if ($order->payment_status != 'COMPLETED') { ?>
                                                    <a href="<?= route_to('web_shop_pay_now', $order->id) ?>" class="btn btn-primary btn-min">Paga</a>
                                                <?php } ?>
                                                <a href="<?= route_to('web_user_order_det', $order->id) ?>" class="btn btn-primary btn-min">Dettagli</a>
                                            </td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-info">Nessun ordine presente</div>
                    <?php } ?>




                </div>
                <?= view(customOrDefaultViewFragment('users/components/sidebar', 'LcUsers')) ?>

            </div>
        </div>

</article>


<?= $this->endSection() ?>
<?= $this->section('footer_script') ?>
<style>
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