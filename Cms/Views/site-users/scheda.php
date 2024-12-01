<?= $this->extend('Lc5\Cms\Views\layout/body') ?>
<?= $this->section('content') ?>
<script>
    let count_rows = 0;
</script>
<form class="form save_after_proc" method="POST" action="">

    <?= user_mess($ui_mess, $ui_mess_type) ?>
    <div class="d-md-flex">
        <div class="d-flex align-items-center">
            <?= view('Lc5\Cms\Views\layout/components/back-btn') ?>
            <div class="titoli_scheda">
                <?php if ($entity->id) { ?>
                    <h3>Scheda utente</h3>
                <?php } else { ?>
                    <h3>Crea nuovo utente</h3>
                <?php } ?>

            </div>
        </div>
        <div class="d-flex align-items-center ">
            <div>
                <button type="submit" class="btn bottone_salva btn-primary"><span class="oi oi-check"></span>Salva</button>
            </div>
        </div>
    </div>

    <div class="row form-row">
        <div class="col-12 col-lg-9 scheda_body">

            <div class="row">
                <div class="row form-row">
                    <?= view('Lc5\Cms\Views\form-cmp/text', ['item' => ['label' => 'Nome', 'name' => 'name', 'value' => $entity->name]]) ?>
                    <?= view('Lc5\Cms\Views\form-cmp/text', ['item' => ['label' => 'Cognome', 'name' => 'surname', 'value' => $entity->surname]]) ?>
                </div>
                <div class="row form-row">
                    <?= view('Lc5\Cms\Views\form-cmp/text', ['item' => ['label' => 'Telefono', 'name' => 'tel_num', 'value' => $entity->tel_num]]) ?>
                    <?= view('Lc5\Cms\Views\form-cmp/text', ['item' => ['label' => 'Email', 'name' => 'email', 'value' => $entity->email]]) ?>
                </div>
                <div class="row form-row">
                    <h6><b>
                        Indirizzo
                </b></h6>
                </div>
                <div class="row form-row">
                    <?= view('Lc5\Cms\Views\form-cmp/text', ['item' => ['label' => 'Nazione', 'name' => 'country', 'value' => $entity->country]]) ?>
                    <?= view('Lc5\Cms\Views\form-cmp/text', ['item' => ['label' => 'Provincia', 'name' => 'district', 'value' => $entity->district]]) ?>
                    <?= view('Lc5\Cms\Views\form-cmp/text', ['item' => ['label' => 'Città', 'name' => 'city', 'value' => $entity->city]]) ?>
                </div>
                <div class="row form-row">
                    <?= view('Lc5\Cms\Views\form-cmp/text', ['item' => ['label' => 'Cap', 'name' => 'cap', 'value' => $entity->cap]]) ?>
                    <?= view('Lc5\Cms\Views\form-cmp/text', ['item' => ['label' => 'Indirizzo', 'name' => 'address', 'value' => $entity->address]]) ?>
                </div>
                    
                <div class="row form-row">
                    <h6><b>
                        Informazioni aggiuntive - dati di fatturazione
                </b></h6>
                </div>
                <div class="row form-row">
                    <?= view('Lc5\Cms\Views\form-cmp/text', ['item' => ['label' => 'Partita Iva', 'name' => 'piva', 'value' => $entity->piva]]) ?>
                    <?= view('Lc5\Cms\Views\form-cmp/text', ['item' => ['label' => 'Codice Fiscale', 'name' => 'cf', 'value' => $entity->cf]]) ?>
                </div>

            </div>

        </div>
        <div class="scheda-sb margin-top-0">
            <div class="row">
                <div class="col-12">
                    <div class="bg-light rounded">

                        <div class="row">
                            <?= view('Lc5\Cms\Views\form-cmp/select', ['item' => ['label' => 'Attivo', 'name' => 'status', 'input_class' => 'status', 'value' => $entity->status, 'width' => 'col-md-12', 'sources' => $bool_values, 'no_empty' => true]]); ?>
                            <?= view('Lc5\Cms\Views\form-cmp/select', ['item' => ['label' => 'Termini e condizioni', 'name' => 't_e_c', 'input_class' => 't_e_c', 'value' => $entity->t_e_c, 'width' => 'col-md-12', 'sources' => $bool_values, 'no_empty' => true]]); ?>
                            <?= view('Lc5\Cms\Views\form-cmp/select', ['item' => ['label' => 'Privacy', 'name' => 'privacy', 'input_class' => 'privacy', 'value' => $entity->privacy, 'width' => 'col-md-12', 'sources' => $bool_values, 'no_empty' => true]]); ?>

                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>

</form>

<?= $this->endSection() ?>
<?= $this->section('footer_script') ?>

<script type="text/javascript">
    $(document).ready(function() {
        // 
        $('.select-tags-tags').selectize({
            create: function(input, callback) {
                if (!input.length) return callback();
                $.ajax({
                    url: '<?= site_url(route_to('lc_shop_prod_tags_data_new'))  ?>',
                    type: 'POST',
                    data: {
                        nome: input
                    },
                    success: function(result) {
                        if (result) {
                            callback({
                                value: result.val,
                                text: input
                            });
                        }
                    }
                });
            }
        });
        $('.select-tags-colore').selectize({
            create: function(input, callback) {
                if (!input.length) return callback();
                $.ajax({
                    url: '<?= site_url(route_to('lc_shop_prod_colors_data_new'))  ?>',
                    type: 'POST',
                    data: {
                        nome: input
                    },
                    success: function(result) {
                        if (result) {
                            callback({
                                value: result.val,
                                text: input
                            });
                        }
                    }
                });
            }
        });
        $('.select-tags-misura').selectize({
            sortField: "text",
            // render: {
            //     option_create:function(data,escape){
            //         return'<div class="create">Crea nuova <strong>'+escape(data.input)+"</strong>&hellip;</div>"
            //     },
            // },
            create: function(input, callback) {
                if (!input.length) return callback();
                $.ajax({
                    url: '<?= site_url(route_to('lc_shop_prod_sizes_data_new'))  ?>',
                    type: 'POST',
                    data: {
                        nome: input
                    },
                    success: function(result) {
                        if (result) {
                            callback({
                                value: result.val,
                                text: input
                            });
                        }
                    }
                });
            }
        });



    });
</script>

<script type="text/html" id="custom_field_item_code-prodotti" style="display: none;">
    <?= view('Lc5\Cms\Views\part-cmp/custom-field-item', ['item' => ['keys_source' => $custom_fields_keys_prodotti]]) ?>
</script>

<script type="text/html" id="calcola-imponibile-modal" style="display: none;">
    <div class="modal fade" id="input-tools-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Utility scheda</h5>
                    <button type="button" class="btn-close close_modal" data-bs-dismiss="modal" aria-label="Close"><span class="oi oi-x"></span></button>
                </div>
                <div class="modal-body">
                    <div class="input-tools-cnt">
                        <div class="input-tool-item">
                            <label>Scorpora Iva</label>
                            <div class="input-tools-row input-tools-from">
                                <label>Prezzo Lordo<br />
                                    <input type="number" step="0.01" data-decimal="2" class="form-control scorpora_iva_from" placeholder="Prezzo Lordo">
                                </label>
                                <label>Aliquota Iva<br />
                                    <input type="number" step="0.01" data-decimal="2" class="form-control scorpora_iva_ali" style="width: 80px;" placeholder="aliquota" value="22">
                                </label>
                                <button type="button" class="user_tool user_tool-scorpora"><span class="oi oi-calculator"></span></button>
                            </div>
                            <div class="input-tools-row input-tools-result">
                                <div class="input-tools-result-label">Imponibile </div>
                                <input type="number" readonly="" class="form-control  readonly_enabled disabled scorpora_iva_result" placeholder="">
                            </div>
                        </div>

                        <div class="input-tool-item">
                            <label>Calcola ivato</label>
                            <div class="input-tools-row input-tools-from">
                                <label>Prezzo Imponibile<br />
                                    <input type="number" step="0.01" data-decimal="2" class="form-control calcola_ivato_from" placeholder="Prezzo Imponibile">
                                </label>
                                <label>Aliquota Iva<br />
                                    <input type="number" step="0.01" data-decimal="2" class="form-control calcola_ivato_ali" style="width: 80px;" placeholder="aliquota" value="22">
                                </label>
                                <button type="button" class="user_tool user_tool-calcola_ivato"><span class="oi oi-calculator"></span></button>
                            </div>
                            <div class="input-tools-row input-tools-result">
                                <div class="input-tools-result-label">Lordo </div>
                                <input type="number" readonly="" class="form-control  readonly_enabled disabled calcola_ivato_result" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>




<script language="javascript">
    //----------------------------------------------
    //----------------------------------------------

    var utilityIVA = {};

    var formatReturn = function(imponibile, aliquotaIVA, importoIVA, totale, retValNoCallback, callback) {
        var retObj = {
            imponibile: Number(imponibile),
            aliquotaIVA: Number(aliquotaIVA),
            importoIVA: Number(importoIVA),
            totale: Number(totale)
        };
        if (callback) {
            callback(null, retObj); //callback in format 'callback(err, data)'
        } else {
            return retValNoCallback;
        }
    };

    utilityIVA.scorporoIVA = function(totale, aliquotaIVA, callback) {
        return this.calcolaImponibile(totale, aliquotaIVA, callback);
    };
    utilityIVA.calcolaImponibile = function(totale, aliquotaIVA, callback) {
        if (aliquotaIVA == -100) {
            if (callback) {
                return callback(true, 'Error: division by zero');
            } else {
                return 'Error: division by zero';
            }
        }
        var imponibile = totale / ((100 + aliquotaIVA) / 100);
        var importoIVA = totale - imponibile;
        return formatReturn(imponibile, aliquotaIVA, importoIVA, totale, imponibile, callback);
    };

    utilityIVA.calcolaImportoIvato = function(imponibile, aliquotaIVA, callback) {
        var importoIVA = (imponibile * aliquotaIVA) / 100;
        var totale = Number(imponibile) + Number(importoIVA);
        return formatReturn(imponibile, aliquotaIVA, importoIVA, totale, totale, callback);
    };

    utilityIVA.calcolaAliquotaIVA = function(imponibile, totale, callback) {
        var importoIVA = totale - imponibile;
        if (imponibile == 0 || importoIVA == 0) {
            return formatReturn(imponibile, 0, importoIVA, totale, 0, callback);
        }
        var aliquotaIVA = /* Math.round( */ 100 / (imponibile / importoIVA) /* ) */ ;
        return formatReturn(imponibile, aliquotaIVA, importoIVA, totale, aliquotaIVA, callback);
    };

    utilityIVA.calcolaImponibileDaIVA = function(importoIVA, aliquotaIVA, callback) {
        if (aliquotaIVA == 0) {
            return formatReturn(0, aliquotaIVA, importoIVA, 0, 0, callback);
        }
        var imponibile = (importoIVA / aliquotaIVA) * 100;
        var totale = imponibile + importoIVA;
        return formatReturn(imponibile, aliquotaIVA, importoIVA, totale, imponibile, callback);
    };

    utilityIVA.calcolaTotaleDaIVA = function(importoIVA, aliquotaIVA, callback) {
        if (aliquotaIVA == 0) {
            return formatReturn(0, aliquotaIVA, importoIVA, 0, 0, callback);
        }
        var imponibile = (importoIVA / aliquotaIVA) * 100;
        var totale = imponibile + importoIVA;
        return formatReturn(imponibile, aliquotaIVA, importoIVA, totale, totale, callback);
    };

    //----------------------------------------------
    //----------------------------------------------
    //----------------------------------------------

    $(document).ready(function() {
        // 
        $('.form-field-price label').append(' <a href="#" meta-rel="calcola-imponibile-modal" class="openToolBtn"><i>Calcola</></a>');

        $('body').on('click', '.openToolBtn', function(e) {
            e.preventDefault();
            const modalToOpenTrgt = $(this).attr('meta-rel');
            var modal_html = $('#' + modalToOpenTrgt).text();
            let modal_obj = $(modal_html);
            $('body').append(modal_obj);
            // 
            $('.user_tool-scorpora').click(calcolaScorporoDaInput);
            $('.scorpora_iva_from').keypress(calcolaScorporoDaInputInvio);
            // 
            $('.user_tool-calcola_ivato').click(calcolaIvatoDaInput);
            $('.calcola_ivato_from').keypress(calcolaIvatoDaInputInvio);
        });


    });

    //----------------------------------------------
    //-- SCORPORA IVA
    //----------------------------------------------

    function calcolaScorporoDaInputInvio(e) {
        if (e.which == 13) {
            calcolaScorporoDaInput(e);
        }
    }

    function calcolaScorporoDaInput(e) {
        e.preventDefault();
        var scorpora_iva_from = $('.scorpora_iva_from').val();
        var scorpora_iva_ali = $('.scorpora_iva_ali').val();
        var scorpora_iva_result = $('.scorpora_iva_result');
        if (scorpora_iva_from) {
            utilityIVA.scorporoIVA(scorpora_iva_from, Number(scorpora_iva_ali), function(err, data) {
                const cImponibile = data.imponibile;
                if (cImponibile) {
                    scorpora_iva_result.val(cImponibile.toFixed(2));
                }
            });
        }
        return false;
    }

    //----------------------------------------------
    //-- CALCOLA IVATO
    //----------------------------------------------

    function calcolaIvatoDaInputInvio(e) {
        if (e.which == 13) {
            calcolaIvatoDaInput(e);
        }
    }

    function calcolaIvatoDaInput(e) {
        e.preventDefault();
        var calcola_ivato_from = $('.calcola_ivato_from').val();
        var calcola_ivato_ali = $('.calcola_ivato_ali').val();
        var calcola_ivato_result = $('.calcola_ivato_result');
        if (calcola_ivato_from) {
            utilityIVA.calcolaImportoIvato(calcola_ivato_from, Number(calcola_ivato_ali), function(err, data) {
                const cIvato = data.totale;
                if (cIvato) {
                    calcola_ivato_result.val(cIvato.toFixed(2));
                }
            });
        }
        return false;
    }
</script>
<style>
    .input-tools-cnt {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-around;
        padding: 1em;
    }

    .input-tool-item {
        padding: .8em .5em;
        margin: .8em .5em;
        background-color: #f8f9fa;
    }

    .input-tools-row {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        padding: .3em .2em;
    }

    .input-tools-row input {
        width: auto
    }

    .input-tools-from {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }

    .input-tools-result {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;

    }

    .input-tools-result-label {
        font-size: .7em;
        font-weight: bold;
        margin-right: .5em;
    }
</style>


<?= $this->endSection() ?>