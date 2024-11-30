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
                    <h3><?= $entity->name  ?> <?= $entity->surname ?></h3>
                <?php } else { ?>
                    <h3>Crea nuovo prodotto</h3>
                <?php } ?>
               
            </div>
        </div>
        <div class="d-flex align-items-center ">
            <div>
                <button type="submit" name="save" value="save" class="btn bottone_salva btn-primary"><span class="oi oi-check"></span>Salva</button>
            </div>
        </div>
    </div>

    <div class="row form-row">
        <div class="col-12 col-lg-9 scheda_body">
            <div class="first-row">
                <div class="row">
                    
                    <?= view('Lc5\Cms\Views\form-cmp/text', ['item' => ['label' => 'Modello', 'name' => 'modello', 'value' => $entity->modello, 'placeholder' => 'Nome modello']]) ?>
                </div>
                <div class="row form-row row-colore">
                    <?= view('Lc5\Cms\Views\form-cmp/select-search', ['item' => ['label' => 'Tipo', 'input_class' => 'select-tags-colore', 'name' => 'colore', 'value' => (isset($entity->colore)) ? $entity->colore : null,  'sources' => $entity->variations_list]]) ?>
                    <?= view('Lc5\Cms\Views\form-cmp/select-search', ['item' => ['label' => 'Misura', 'input_class' => 'select-tags-misura', 'name' => 'misura', 'value' => (isset($entity->misura)) ? $entity->misura : null,  'sources' => $entity->sizes_list]]) ?>
                </div>
                <div class="row">
                    <?= view('Lc5\Cms\Views\form-cmp/text', ['item' => ['label' => 'Stile', 'name' => 'stile', 'value' => $entity->stile, 'placeholder' => '']]) ?>
                </div>
                <div class="row">
                    <?= view('Lc5\Cms\Views\form-cmp/html-editor', ['item' => ['label' => 'Descrizione', 'name' => 'testo', 'value' => (isset($entity->testo)) ? $entity->testo : '', 'placeholder' => '...']]) ?>
                </div>
                <div class="row">
                    <?= view('Lc5\Cms\Views\form-cmp/html-editor', ['item' => ['label' => 'Scheda tecnica', 'name' => 'scheda_tecnica', 'value' => (isset($entity->scheda_tecnica)) ? $entity->scheda_tecnica : '', 'placeholder' => '...']]) ?>
                </div>
                <div class="row">
                    <?= view('Lc5\Cms\Views\form-cmp/img-gallery', ['item' => ['label' => 'Gallery', 'name' => 'gallery', 'value' => (isset($entity->gallery)) ? $entity->gallery : '{}',  'gallery_obj' => (isset($entity->gallery_obj)) ? $entity->gallery_obj : []]]) ?>
                </div>
                
            </div>

        </div>
        <div class="scheda-sb margin-top-0">
            <div class="row">
                <div class="col-12">
                    <div class="bg-light rounded">
                        <?php if (!isset($entity->parent_entity)) { ?>
                            <div class="row">
                                <?= view('Lc5\Cms\Views\form-cmp/readonly', ['item' => ['label' => 'Nome', 'value' => $entity->nome, 'name' => 'nome',  'width' => 'col-12', 'placeholder' => '', 'if_active_name' => 'nome',  'enabled' => (($entity->id) ? TRUE : FALSE)]]) ?>
                                <?= view('Lc5\Cms\Views\form-cmp/readonly', ['item' => ['label' => 'Guid', 'value' => $entity->guid, 'width' => 'col-12', 'placeholder' => '', 'if_active_name' => 'guid',  'enabled' => (($entity->id) ? TRUE : FALSE)]]) ?>
                                <?php /*
                                <?= view('Lc5\Cms\Views\form-cmp/readonly', ['item' => ['label' => 'Guid', 'value' => $entity->guid,  'placeholder' => '']]) ?>
                                */ ?>

                            </div>
                        <?php } ?>
                        <div class="row">
                            <?= view('Lc5\Cms\Views\form-cmp/select', ['item' => ['label' => 'Public', 'name' => 'public', 'input_class' => 'public', 'value' => $entity->public, 'width' => 'col-md-12', 'sources' => $bool_values, 'no_empty' => true]]); ?>
                            <?= view('Lc5\Cms\Views\form-cmp/text', ['item' => ['label' => 'Barcode', 'name' => 'barcode', 'value' => $entity->barcode, 'placeholder' => '']]) ?>
                            <?= view('Lc5\Cms\Views\form-cmp/text', ['item' => ['label' => 'SKU', 'name' => 'sku', 'value' => $entity->sku, 'placeholder' => '']]) ?>
                           
                        </div>
                        <div class="row">
                            <?= view('Lc5\Cms\Views\form-cmp/img-single', ['item' => ['label' => 'Copertina', 'name' => 'main_img_id', 'value' => $entity->main_img_id, 'src' => $entity->main_img_thumb]]) ?>
                        </div>
                        <?php if (trim(env("custom.shop_products.has_alt_image")) && env("custom.shop_products.has_alt_image") == true) { ?>
                            <div class="row">
                                <?= view('Lc5\Cms\Views\form-cmp/img-single', ['item' => ['label' => 'Alternativa', 'name' => 'alt_img_id', 'value' => $entity->alt_img_id, 'src' => $entity->alt_img_thumb]]) ?>
                            </div>
                        <?php } ?>
                        <div class="row">
                            <hr />
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